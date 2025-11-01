<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;  
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    // Page principale du shop
    public function index()
{
    $products = Product::where('is_active', true)
        ->latest()
        ->get();

    return inertia('Shop/Index', [
        'products' => $products
    ]);
}

    // Page de détail d'un produit
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return Inertia::render('Shop/ProductDetail', [
            'product' => $product
        ]);
    }

    // ✅ NOUVELLE MÉTHODE : Page du panier
    public function cart()
    {
        return Inertia::render('Shop/Cart');
    }

    // Téléchargement du produit après achat
    // Ancienne méthode (garde pour compatibilité)
public function download($token)
{
    // Essaie de trouver un OrderItem
    $orderItem = OrderItem::where('download_token', $token)->first();

    if ($orderItem) {
        return $this->downloadItem($orderItem);
    }

    // Sinon essaie l'ancien système (Order)
    $order = Order::where('download_token', $token)
        ->where('status', 'completed')
        ->first();

    if (!$order) {
        abort(404, 'Lien de téléchargement invalide.');
    }

    // Redirige vers le premier item
    $firstItem = $order->items()->first();
    if ($firstItem) {
        return $this->downloadItem($firstItem);
    }

    abort(404, 'Aucun produit trouvé.');
}

// ✅ Nouvelle méthode pour télécharger un item spécifique
public function downloadItem($token)
{
    try {
        $item = OrderItem::where('download_token', $token)
            ->with(['order', 'product'])
            ->firstOrFail();

        if ($item->order->status !== 'completed') {
            abort(403, 'Commande non payée.');
        }

        if ($item->download_count >= 5) {
            abort(403, 'Limite de téléchargements atteinte pour ce produit.');
        }

        if (!$item->product->file_path) {
            abort(404, 'Aucun fichier associé à ce produit.');
        }

        // ✅ CORRECTION ICI
        // Vérifie d'abord dans /private/, sinon dans /
        $filePath = storage_path('app/private/' . $item->product->file_path);
        
        if (!file_exists($filePath)) {
            // Essaie sans le préfixe private
            $filePath = storage_path('app/' . $item->product->file_path);
        }

        if (!file_exists($filePath)) {
            Log::error('Fichier introuvable', [
                'file_path' => $item->product->file_path,
                'tried_paths' => [
                    storage_path('app/private/' . $item->product->file_path),
                    storage_path('app/' . $item->product->file_path)
                ],
                'order_item_id' => $item->id
            ]);
            abort(404, 'Fichier introuvable.');
        }

        $item->increment('download_count');

        $fileName = $item->product->name . '.pdf';

        return response()->download($filePath, $fileName);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        abort(404, 'Lien de téléchargement invalide.');
    } catch (\Exception $e) {
        Log::error('Erreur téléchargement', [
            'token' => $token,
            'error' => $e->getMessage()
        ]);
        abort(500, 'Erreur lors du téléchargement.');
    }
}
public function downloadWithToken($token)
{
    // Trouve l'OrderItem avec ce token
    $orderItem = OrderItem::where('download_token', $token)
        ->with('product', 'order')
        ->first();

    if (!$orderItem) {
        abort(404, 'Lien de téléchargement invalide');
    }

    // Vérifier que le token n'a pas expiré
    if ($orderItem->token_expires_at && $orderItem->token_expires_at->isPast()) {
        abort(403, 'Ce lien de téléchargement a expiré. Connectez-vous pour télécharger depuis votre compte.');
    }

    // Vérifier que c'est bien un produit digital
    if ($orderItem->product->type !== 'digital') {
        abort(403, 'Ce produit n\'est pas téléchargeable');
    }

    // Vérifier que le produit a un fichier
    if (!$orderItem->product->file_path) {
        abort(404, 'Fichier introuvable');
    }

    // Vérifier que le fichier existe sur S3
    if (!Storage::disk('s3')->exists($orderItem->product->file_path)) {
        abort(404, 'Fichier introuvable sur le serveur');
    }

    // Incrémenter le compteur
    $orderItem->increment('download_count');

    // Générer une URL temporaire S3 (valide 1 heure)
    $temporaryUrl = Storage::disk('s3')->temporaryUrl(
        $orderItem->product->file_path,
        now()->addHour()
    );

    // Logger
    \Log::info('Product downloaded via token', [
        'order_id' => $orderItem->order_id,
        'product_id' => $orderItem->product_id,
        'download_count' => $orderItem->download_count,
    ]);

    // Rediriger vers l'URL S3
    return redirect($temporaryUrl);
}
}