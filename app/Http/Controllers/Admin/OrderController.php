<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\ShippingConfirmation;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class OrderController extends Controller
{
    // Liste des commandes
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $query = Order::with('items.product')
            ->where('status', 'completed')
            ->latest();

        // Filtre par type
        if ($filter === 'physical') {
            $query->whereHas('items.product', function($q) {
                $q->where('type', 'physical');
            });
        } elseif ($filter === 'digital') {
            $query->whereHas('items.product', function($q) {
                $q->where('type', 'digital');
            })->whereDoesntHave('items.product', function($q) {
                $q->where('type', 'physical');
            });
        } elseif ($filter === 'to_ship') {
            $query->whereHas('items.product', function($q) {
                $q->where('type', 'physical');
            })->whereNull('shipped_at');
        }

        $orders = $query->paginate(20);

        return Inertia::render('Admin/Orders/Index', [
            'orders' => $orders,
            'filter' => $filter
        ]);
    }

    // Détail d'une commande
    public function show(Order $order)
    {
        $order->load('items.product');

        return Inertia::render('Admin/Orders/Show', [
            'order' => $order
        ]);
    }

    // Marquer comme expédiée
    public function markAsShipped(Request $request, Order $order)
{
    $request->validate([
        'tracking_number' => 'required|string|max:255'
    ]);

    $order->update([
        'tracking_number' => $request->tracking_number,
        'shipped_at' => now()
    ]);

    // ✅ Envoyer l'email de confirmation d'expédition
    Mail::to($order->customer_email)->send(new ShippingConfirmation($order));

    return redirect()->back()->with('success', 'Commande marquée comme expédiée et email envoyé !');
}

    private function sendShippingEmail(Order $order)
    {
        try {
            \Mail::raw(
                "Bonjour {$order->customer_name},\n\n" .
                "Bonne nouvelle ! Votre commande a été expédiée 📦\n\n" .
                "Numéro de suivi : {$order->tracking_number}\n" .
                "Vous pouvez suivre votre colis sur le site du transporteur.\n\n" .
                "Belle journée,\n" .
                "L'équipe BEE AESTHETIC\n\n" .
                "---\n" .
                "Numéro de commande : {$order->order_number}",
                function ($message) use ($order) {
                    $message->to($order->customer_email)
                        ->subject('📦 Votre commande BEE AESTHETIC a été expédiée !');
                }
            );
        } catch (\Exception $e) {
            \Log::error('Failed to send shipping email', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}