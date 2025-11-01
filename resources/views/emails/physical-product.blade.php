@extends('emails.layout')

@section('content')
    <h1>Bonjour {{ $order->customer_name }}</h1>
    
    <p>Merci pour votre commande !</p>

    <div class="section">
        <h2 class="section-title">Produits commandés</h2>
        
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
            <div class="address-line">Tél : {{ $order->shipping_phone }}</div>
        </div>
    </div>

    <p>Votre commande sera préparée et expédiée sous 2-3 jours ouvrables.</p>
    <p>Vous recevrez un email avec le numéro de suivi dès l'expédition.</p>

    <p>Belle journée,<br>L'équipe BEE AESTHETIC</p>
@endsection