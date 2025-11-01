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
            border-left: 3px solid #b3a090;
        }
        .product-item:last-child {
            margin-bottom: 0;
        }
        .product-name {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin-bottom: 10px;
        }
        .download-btn {
            display: inline-block;
            padding: 12px 30px;
            background: #333;
            color: white !important;
            text-decoration: none;
            border-radius: 50px;
            font-size: 14px;
            margin-top: 10px;
        }
        .info-box {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #1976d2;
        }
        .footer {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid #eee;
            color: #999;
            font-size: 14px;
        }
        .order-number {
            font-size: 14px;
            color: #999;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">BEE AESTHETIC</div>
    </div>

    <h1>Merci pour votre achat !</h1>
    
    <p class="intro">
        Bonjour {{ $order->customer_name }},<br><br>
        Votre commande a été confirmée et vos produits digitaux sont prêts à être téléchargés !
    </p>

    <div class="products">
        <h2 style="font-size: 18px; font-weight: 400; margin-bottom: 20px;">Vos téléchargements</h2>
        
        @foreach($order->items as $item)
            @if($item->product->type === 'digital')
                <div class="product-item">
                    <div class="product-name">{{ $item->product->name }}</div>
                    <div style="color: #666; font-size: 14px; margin-bottom: 10px;">
                        Quantité : {{ $item->quantity }}
                    </div>
                    <a href="{{ url('/download/token/' . $item->download_token) }}" class="download-btn">
                        📥 Télécharger maintenant
                    </a>
                </div>
            @endif
        @endforeach
    </div>

    <div class="info-box">
        <strong>💡 Important :</strong><br>
        • Les liens de téléchargement sont valables pendant <strong>30 jours</strong><br>
        • Vous pouvez télécharger chaque produit plusieurs fois<br>
        • Conservez cet email pour un accès facile à vos fichiers
    </div>

    <p class="order-number">
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