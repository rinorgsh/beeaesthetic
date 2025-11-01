<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 2px solid #b3a090;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 2px;
            color: #333;
        }
        h1 {
            color: #333;
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 20px;
        }
        .intro {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        .products {
            background: #f8f8f8;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .product-item {
            background: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 3px solid #7b1fa2;
        }
        .product-item:last-child {
            margin-bottom: 0;
        }
        .product-name {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
        }
        .shipping-box {
            background: #f3e5f5;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #7b1fa2;
        }
        .shipping-address {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">BEE AESTHETIC</div>
    </div>

    <h1>Commande confirmée !</h1>
    
    <p class="intro">
        Bonjour {{ $order->customer_name }},<br><br>
        Nous avons bien reçu votre commande et nous la préparons avec soin. Vous recevrez un email de confirmation d'expédition avec un numéro de suivi dès que votre colis sera parti.
    </p>

    <div class="products">
        <h2 style="font-size: 18px; font-weight: 400; margin-bottom: 20px;">Votre commande</h2>
        
        @foreach($order->items as $item)
            @if($item->product->type === 'physical')
                <div class="product-item">
                    <div class="product-name">{{ $item->product->name }}</div>
                    <div style="color: #666; font-size: 14px;">
                        Quantité : {{ $item->quantity }} × {{ number_format($item->price, 2, ',', ' ') }} €
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="shipping-box">
        <strong>📦 Adresse de livraison</strong>
        <div class="shipping-address">
            {{ $order->shipping_name }}<br>
            {{ $order->shipping_address }}<br>
            {{ $order->shipping_postal_code }} {{ $order->shipping_city }}<br>
            {{ $order->shipping_country }}<br>
            <br>
            Tél : {{ $order->shipping_phone }}
        </div>
        <p style="margin-top: 15px; font-size: 14px;">
            <strong>Délai de livraison estimé :</strong> 2-3 jours ouvrés
        </p>
    </div>

    <div style="background: #e8f5e9; padding: 20px; border-radius: 8px; margin: 20px 0;">
        <strong>💰 Récapitulatif</strong><br>
        <div style="margin-top: 10px;">
            Sous-total : {{ number_format($order->amount - ($order->shipping_cost ?? 0), 2, ',', ' ') }} €<br>
            @if($order->shipping_cost > 0)
                Frais de livraison : {{ number_format($order->shipping_cost, 2, ',', ' ') }} €<br>
            @endif
            <strong>Total : {{ number_format($order->amount, 2, ',', ' ') }} €</strong>
        </div>
    </div>

    <p style="font-size: 14px; color: #999; margin-top: 20px;">
        Numéro de commande : <strong>{{ $order->order_number }}</strong>
    </p>

    <div class="footer">
        <p>Merci de votre confiance ✨</p>
        <p>L'équipe BEE AESTHETIC</p>
        <p style="font-size: 12px; margin-top: 20px;">
            <a href="{{ url('/') }}" style="color: #999;">www.beeaesthetic.com</a>
        </p>
    </div>
</body>
</html>