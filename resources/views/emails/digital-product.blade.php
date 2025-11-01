@extends('emails.layout')

@section('content')
    <h1>Bonjour {{ $order->customer_name }}</h1>
    
    <p>Merci pour votre achat !</p>
    
    <p>Vos produits sont disponibles immédiatement ci-dessous.</p>

    <div class="section">
        <h2 class="section-title">Vos téléchargements</h2>
        
        <ul class="product-list">
            @foreach($order->items as $item)
                @if($item->product->type === 'digital')
                    <li class="product-item">
                        <strong>{{ $item->product->name }}</strong>
                        <br>
                        <a href="{{ route('shop.download.item', $item->download_token) }}" class="download-link">
                            Télécharger maintenant
                        </a>
                        <br>
                        <small style="color: #999;">Jusqu'à 5 téléchargements disponibles</small>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <p>Belle journée,<br>L'équipe BEE AESTHETIC</p>
@endsection