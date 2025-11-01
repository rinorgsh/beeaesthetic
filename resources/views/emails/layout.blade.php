<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background-color: #fafafa;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        .logo {
            font-size: 28px;
            font-weight: 300;
            color: #333;
            letter-spacing: 2px;
            margin: 0;
        }
        .content {
            padding: 40px 30px;
        }
        h1 {
            font-size: 24px;
            font-weight: 300;
            color: #333;
            margin: 0 0 20px 0;
            letter-spacing: 1px;
        }
        p {
            font-size: 15px;
            font-weight: 300;
            color: #666;
            line-height: 1.7;
            margin: 0 0 15px 0;
        }
        .section {
            margin: 30px 0;
            padding: 25px;
            background-color: #fafafa;
            border-left: 3px solid #b3a090;
        }
        .section-title {
            font-size: 16px;
            font-weight: 400;
            color: #555;
            margin: 0 0 15px 0;
            letter-spacing: 0.5px;
        }
        .product-list {
            list-style: none;
            padding: 0;
            margin: 15px 0;
        }
        .product-item {
            padding: 12px 0;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
            color: #666;
            font-weight: 300;
        }
        .product-item:last-child {
            border-bottom: none;
        }
        .download-link {
            display: inline-block;
            padding: 12px 30px;
            background-color: #333;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 0.5px;
            margin: 10px 0;
        }
        .address-block {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #e0e0e0;
            margin: 15px 0;
        }
        .address-line {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin: 5px 0;
            font-weight: 300;
        }
        .footer {
            background-color: #fafafa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        .footer-text {
            font-size: 13px;
            color: #999;
            line-height: 1.6;
            margin: 5px 0;
            font-weight: 300;
        }
        .order-number {
            font-size: 13px;
            color: #999;
            margin-top: 20px;
            font-weight: 300;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e0e0e0, transparent);
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 class="logo">BEE AESTHETIC</h1>
        </div>
        
        <div class="content">
            @yield('content')
            
            <div class="divider"></div>
            
            <p class="order-number">Numéro de commande : {{ $order->order_number }}</p>
        </div>
        
        <div class="footer">
            <p class="footer-text">Merci d'avoir choisi BEE AESTHETIC</p>
            <p class="footer-text">Questions ? Contactez-nous à contact@beeaesthetic.be</p>
        </div>
    </div>
</body>
</html>