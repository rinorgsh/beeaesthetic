@extends('emails.layout')

@section('content')
    <h1>Bonjour {{ $order->customer_name }}</h1>
    
    <p>Bonne nouvelle ! Votre commande a été expédiée.</p>

    <div class="section">
        <h2 class="section-title">Numéro de suivi</h2>
        
        <div style="background: #fafafa; padding: 1.5rem; border-radius: 4px; text-align: center; margin: 1.5rem 0;">
            <span style="font-size: 1.3rem; font-weight: 400; color: #333; letter-spacing: 1px;">
                {{ $order->tracking_number }}
            </span>
        </div>
        
        <p style="font-size: 0.9rem; color: #999; text-align: center;">
            Utilisez ce numéro pour suivre votre colis
        </p>
    </div>

    <div class="section">
        <h2 class="section-title">Produits expédiés</h2>
        
        <ul class="product-list">
            @foreach($order->items as $item)
                @if($item->product->type === 'physical')
                    <li class="product-item">
                        {{ $item->product->name }} × {{ $item->quantity }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="section">
        <h2 class="section-title">Adresse de livraison</h2>
        
        <div class="address-block">
            <div class="address-line">{{ $order->shipping_name }}</div>
            <div class="address-line">{{ $order->shipping_address }}</div>
            <div class="address-line">{{ $order->shipping_postal_code }} {{ $order->shipping_city }}</div>
            <div class="address-line">{{ $order->shipping_country }}</div>
        </div>
    </div>

    <p>Votre colis devrait arriver dans les prochains jours.</p>

    <p>Belle journée,<br>L'équipe BEE AESTHETIC</p>
@endsection