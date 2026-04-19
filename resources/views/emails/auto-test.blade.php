<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f4f8;
            padding: 40px 20px;
        }

        .wrapper {
            max-width: 600px;
            margin: auto;
        }

        /* header */
        .header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 16px 16px 0 0;
            padding: 50px 40px;
            text-align: center;
        }
        .header h1 {
            color: white;
            font-size: 32px;
            letter-spacing: 1px;
        }
        .header p {
            color: rgba(255,255,255,0.85);
            font-size: 15px;
            margin-top: 8px;
        }
        .logo {
            font-size: 48px;
            margin-bottom: 15px;
        }

        /* body */
        .body {
            background: white;
            padding: 40px;
        }
        .welcome-text {
            font-size: 22px;
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .body p {
            color: #666;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        /* info box */
        .info-box {
            background: #f8f4ff;
            border-left: 4px solid #764ba2;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .info-box p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }
        .info-box strong {
            color: #764ba2;
        }

        /* button */
        .btn-wrapper { text-align: center; margin: 30px 0; }
        .btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            display: inline-block;
            letter-spacing: 0.5px;
        }

        /* features */
        .features {
            display: flex;
            gap: 15px;
            margin: 25px 0;
        }
        .feature {
            flex: 1;
            background: #f8f4ff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        .feature .icon { font-size: 28px; margin-bottom: 8px; }
        .feature p { font-size: 13px; color: #666; margin: 0; }
        .feature strong { color: #333; font-size: 14px; display: block; margin-bottom: 4px; }

        /* footer */
        .footer {
            background: #2d3748;
            border-radius: 0 0 16px 16px;
            padding: 30px 40px;
            text-align: center;
        }
        .footer p {
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            line-height: 1.8;
        }
        .footer a { color: #a78bfa; text-decoration: none; }
        .social { margin: 15px 0; }
        .social a {
            display: inline-block;
            background: rgba(255,255,255,0.1);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            margin: 4px;
            font-size: 13px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="wrapper">

    {{-- HEADER --}}
    <div class="header">
        <div class="logo">🛍️</div>
        <h1>Hallimart</h1>
        <p>Your premium shopping destination</p>
    </div>

    {{-- BODY --}}
    <div class="body">

        <p class="welcome-text">👋 Welcome to Hallimart!</p>

        <p>We're thrilled to have you with us. Your account is all set and ready to go. Start exploring thousands of products curated just for you.</p>

        {{-- info box --}}
        <div class="info-box">
            <p>📧 <strong>Email:</strong> {{ $email }}</p>
            <p>🕐 <strong>Sent At:</strong> {{ $sentAt }}</p>
            <p>🌐 <strong>Platform:</strong> Hallimart Web App</p>
        </div>

        <p>Here's what you can do with your account:</p>

        {{-- features --}}
        <div class="features">
            <div class="feature">
                <div class="icon">🛒</div>
                <strong>Shop</strong>
                <p>Browse thousands of products</p>
            </div>
            <div class="feature">
                <div class="icon">💳</div>
                <strong>Pay Securely</strong>
                <p>Multiple payment options</p>
            </div>
            <div class="feature">
                <div class="icon">🚚</div>
                <strong>Fast Delivery</strong>
                <p>Track orders in real time</p>
            </div>
        </div>

        {{-- CTA button --}}
        <div class="btn-wrapper">
            <a href="http://localhost:8000" class="btn">
                🚀 Start Shopping Now
            </a>
        </div>

        <p style="font-size:13px; color:#999; text-align:center;">
            If you didn't sign up for Hallimart, you can safely ignore this email.
        </p>

    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="social">
            <a href="#">📘 Facebook</a>
            <a href="#">📸 Instagram</a>
            <a href="#">🐦 Twitter</a>
        </div>
        <p>
            © {{ date('Y') }} Hallimart. All rights reserved.<br>
            <a href="#">Unsubscribe</a> · <a href="#">Privacy Policy</a> · <a href="#">Terms</a>
        </p>
    </div>

</div>
</body>
</html>