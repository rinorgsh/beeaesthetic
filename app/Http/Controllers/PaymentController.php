<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;  // ✅ AJOUTE CETTE LIGNE
use App\Models\Purchase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Mail\DigitalProductPurchase;
use App\Mail\PhysicalProductPurchase;
use App\Mail\MixedProductPurchase;

class PaymentController extends Controller
{
    public function createCartCheckoutSession(Request $request)
{
    try {
        // ✅ Validation améliorée
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            // ✅ Champs d'adresse optionnels (seront requis si produits physiques)
            'shipping_name' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:500',
            'shipping_postal_code' => 'nullable|string|max:20',
            'shipping_city' => 'nullable|string|max:100',
            'shipping_country' => 'nullable|string|size:2',
            'shipping_phone' => 'nullable|string|max:20',
            'shipping_notes' => 'nullable|string|max:1000',
            'shipping_cost' => 'nullable|numeric|min:0'
        ]);

        // Récupère tous les produits du panier
        $productIds = collect($validated['items'])->pluck('id')->toArray();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // ✅ Vérifie si le panier contient des produits physiques
        $hasPhysicalProducts = false;
        foreach ($validated['items'] as $item) {
            $product = $products[$item['id']];
            if ($product->type === 'physical') {
                $hasPhysicalProducts = true;
                break;
            }
        }

        // ✅ Si produits physiques, l'adresse est obligatoire
        if ($hasPhysicalProducts) {
            $addressValidation = $request->validate([
                'shipping_name' => 'required|string|max:255',
                'shipping_address' => 'required|string|max:500',
                'shipping_postal_code' => 'required|string|max:20',
                'shipping_city' => 'required|string|max:100',
                'shipping_country' => 'required|string|size:2',
                'shipping_phone' => 'required|string|max:20',
            ]);
        }

        // Calcule le montant total
        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $product = $products[$item['id']];
            $quantity = $item['quantity'];
            $totalAmount += $product->price * $quantity;
        }

        // ✅ Ajoute les frais de port si produits physiques
        $shippingCost = $validated['shipping_cost'] ?? 0;
        $totalAmount += $shippingCost;

        // ✅ Crée la commande avec l'adresse
        $orderData = [
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'amount' => $totalAmount,
            'status' => 'pending'
        ];

        // ✅ Ajoute l'adresse si produits physiques
        if ($hasPhysicalProducts) {
            $orderData['shipping_name'] = $validated['shipping_name'];
            $orderData['shipping_address'] = $validated['shipping_address'];
            $orderData['shipping_postal_code'] = $validated['shipping_postal_code'];
            $orderData['shipping_city'] = $validated['shipping_city'];
            $orderData['shipping_country'] = $validated['shipping_country'];
            $orderData['shipping_phone'] = $validated['shipping_phone'];
            $orderData['shipping_notes'] = $validated['shipping_notes'] ?? null;
            $orderData['shipping_cost'] = $shippingCost;
        }

        $order = Order::create($orderData);

        // Crée un OrderItem pour CHAQUE produit du panier
        foreach ($validated['items'] as $item) {
            $product = $products[$item['id']];
            
            $orderItemData = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ];
        
            // ✅ Générer un token pour les produits digitaux
            if ($product->type === 'digital') {
                $orderItemData['download_token'] = \Str::random(64);
                $orderItemData['token_expires_at'] = now()->addDays(30); // Expire dans 30 jours
            }
        
            OrderItem::create($orderItemData);
        }
        

        // Configure Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Prépare les line_items pour Stripe
        $lineItems = [];

        foreach ($validated['items'] as $item) {
            $product = $products[$item['id']];
            
            $productData = [
                'name' => $product->name,
                'description' => $product->short_description ?? substr($product->description, 0, 100),
            ];

            if ($product->image && !empty($product->image)) {
                $imageUrl = url('storage/' . $product->image);
                if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                    $productData['images'] = [$imageUrl];
                }
            }

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => $productData,
                    'unit_amount' => (int)($product->price * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // ✅ Ajoute les frais de port comme ligne séparée si > 0
        if ($shippingCost > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => '📦 Frais de livraison',
                        'description' => 'Livraison vers ' . ($validated['shipping_country'] ?? 'BE'),
                    ],
                    'unit_amount' => (int)($shippingCost * 100),
                ],
                'quantity' => 1,
            ];
        }

        // Crée la session Stripe
        $sessionData = [
            'payment_method_types' => ['card', 'bancontact'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success', ['order' => $order->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('shop.cart') . '?canceled=1',
            'customer_email' => $validated['customer_email'],
            'metadata' => [
                'order_id' => $order->id,
            ],
            'locale' => 'auto',
        ];

        // ✅ Ajoute l'adresse de livraison dans Stripe si produits physiques
        if ($hasPhysicalProducts) {
            $sessionData['shipping_address_collection'] = [
                'allowed_countries' => ['BE', 'FR', 'NL', 'LU', 'DE'],
            ];
        }

        $session = Session::create($sessionData);

        return response()->json([
            'url' => $session->url,
            'session_id' => $session->id
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation error in cart checkout', [
            'errors' => $e->errors()
        ]);
        
        return response()->json([
            'message' => 'Données invalides',
            'errors' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        Log::error('Cart checkout error', [
            'message' => $e->getMessage()
        ]);
        
        if (isset($order)) {
            $order->delete();
        }
        
        return response()->json([
            'message' => 'Erreur: ' . $e->getMessage()
        ], 500);
    }
}

public function success(Request $request, Order $order)
{
    try {
        Stripe::setApiKey(config('services.stripe.secret'));
        
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            throw new \Exception('Session ID manquant');
        }

        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid' && $order->status === 'pending') {
            $order->update([
                'status' => 'completed',
                'stripe_payment_id' => $session->payment_intent,
                'completed_at' => now()
            ]);

            // ✅ NOUVEAU : Créer les Purchases pour les produits digitaux
            $this->createPurchasesForOrder($order);

            $this->sendDownloadEmail($order);
        }

        // Charge tous les items de la commande avec leurs produits
        $order->load('items.product');

        return inertia('Shop/Success', [
            'order' => $order,
            'items' => $order->items
        ]);

    } catch (\Exception $e) {
        Log::error('Payment success error', [
            'message' => $e->getMessage(),
            'order_id' => $order->id
        ]);

        return redirect()->route('shop.index')
            ->with('error', 'Erreur lors de la confirmation du paiement');
    }
}

// ✅ NOUVELLE MÉTHODE : Créer les purchases
private function createPurchasesForOrder(Order $order)
{
    // Charge les items si pas déjà chargés
    if (!$order->relationLoaded('items')) {
        $order->load('items.product');
    }

    // Pour chaque item digital, créer une Purchase
    foreach ($order->items as $item) {
        if ($item->product->type === 'digital') {
            // Vérifier si le client a un compte
            $user = \App\Models\User::where('email', $order->customer_email)->first();
            
            if ($user) {
                // Si l'utilisateur existe, créer une Purchase
                \App\Models\Purchase::firstOrCreate(
                    [
                        'user_id' => $user->id,
                        'product_id' => $item->product_id,
                    ],
                    [
                        'order_id' => $order->order_number,
                        'amount' => $item->price,
                        'download_count' => 0,
                        'max_downloads' => 10, // 10 téléchargements max
                        'expires_at' => now()->addYear(), // Expire dans 1 an
                    ]
                );
            }
        }
    }}

private function sendDownloadEmail(Order $order)
{
    try {
        // Charge les items si pas déjà chargés
        if (!$order->relationLoaded('items')) {
            $order->load('items.product');
        }

        // ✅ Vérifie si la commande contient des produits digitaux et/ou physiques
        $hasDigital = $order->hasDigitalProducts();
        $hasPhysical = $order->hasPhysicalProducts();

        // ✅ EMAIL POUR PRODUITS DIGITAUX UNIQUEMENT
        if ($hasDigital && !$hasPhysical) {
            $this->sendDigitalProductEmail($order);
        }
        // ✅ EMAIL POUR PRODUITS PHYSIQUES UNIQUEMENT
        elseif ($hasPhysical && !$hasDigital) {
            $this->sendPhysicalProductEmail($order);
        }
        // ✅ EMAIL MIXTE (Digital + Physique)
        else {
            $this->sendMixedProductEmail($order);
        }

        Log::info('Email sent', [
            'order_id' => $order->id,
            'email' => $order->customer_email,
            'type' => $hasDigital && $hasPhysical ? 'mixed' : ($hasDigital ? 'digital' : 'physical')
        ]);

    } catch (\Exception $e) {
        Log::error('Failed to send email', [
            'order_id' => $order->id,
            'error' => $e->getMessage()
        ]);
    }
}

private function sendDigitalProductEmail(Order $order)
{
    Mail::to($order->customer_email)->send(new DigitalProductPurchase($order));
}

private function sendPhysicalProductEmail(Order $order)
{
    Mail::to($order->customer_email)->send(new PhysicalProductPurchase($order));
}

private function sendMixedProductEmail(Order $order)
{
    Mail::to($order->customer_email)->send(new MixedProductPurchase($order));
}

    public function webhook(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $payload = $request->getContent();
            $sigHeader = $request->header('Stripe-Signature');
            $webhookSecret = config('services.stripe.webhook_secret');

            if (!$webhookSecret) {
                Log::warning('Webhook secret not configured');
                return response()->json(['status' => 'success']);
            }

            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $webhookSecret
            );

            if ($event->type === 'checkout.session.completed') {
                $session = $event->data->object;
                $orderId = $session->metadata->order_id ?? null;

                if ($orderId) {
                    $order = Order::find($orderId);
                    
                    if ($order && $order->status === 'pending') {
                        $order->update([
                            'status' => 'completed',
                            'stripe_payment_id' => $session->payment_intent,
                            'completed_at' => now()
                        ]);

                        $this->sendDownloadEmail($order);
                    }
                }
            }

            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Webhook error', [
                'message' => $e->getMessage()
            ]);
            
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}