<?php
session_start();

if (isset($_GET['order_no'])) {
    $order_no = htmlspecialchars($_GET['order_no']);
} elseif (isset($_GET['ono'])) {
    $order_no = htmlspecialchars($_GET['ono']);
} else {
    $order_no = 'N/A';
}

$is_cart_order = (strpos($order_no, 'ORD-') !== false || is_numeric($order_no));

if ($is_cart_order && isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Custom Creations</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --cyprus: #004643;
            --cyprus-light: #006662;
            --sand-dune: #F0EDE5;
            --sand-light: #FAF8F4;
            --accent-gold: #C9A961;
            --white: #FFFFFF;
            --gradient-primary: linear-gradient(135deg, #004643 0%, #006662 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--sand-dune);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2rem;
        }

        .success-card {
            background: white;
            padding: 4rem 3rem;
            border-radius: 32px;
            box-shadow: 0 20px 60px rgba(0, 70, 67, 0.15);
            text-align: center;
            max-width: 550px;
            width: 100%;
            border-top: 6px solid var(--cyprus);
        }

        .icon {
            font-size: 5rem;
            margin-bottom: 2rem;
            color: var(--cyprus);
            animation: scaleIn 0.6s ease;
        }

        @keyframes scaleIn {
            from { transform: scale(0); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 3rem;
            margin: 0 0 1.5rem;
            font-weight: 800;
        }

        p {
            color: #555;
            line-height: 1.9;
            font-size: 1.15rem;
            margin-bottom: 2rem;
        }

        .order-number {
            background: var(--sand-light);
            color: var(--cyprus);
            padding: 1.5rem 2rem;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1.3rem;
            display: inline-block;
            margin: 2rem 0;
            border: 2px dashed var(--accent-gold);
            font-family: 'Playfair Display', serif;
        }

        .order-number i {
            color: var(--accent-gold);
            margin-right: 0.8rem;
        }

        .btn-home {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            text-decoration: none;
            padding: 1.3rem 3rem;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            box-shadow: 0 8px 24px rgba(0, 70, 67, 0.25);
            font-size: 1.05rem;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0, 70, 67, 0.35);
        }

        .btn-home i {
            margin-right: 0.8rem;
        }

        .wa-note {
            font-size: 0.98rem;
            color: #777;
            margin-top: 2rem;
            padding: 1.2rem;
            background: var(--sand-light);
            border-radius: 12px;
        }

        .wa-note i {
            color: #25D366;
            margin-right: 0.5rem;
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 3rem 2rem;
            }

            h1 {
                font-size: 2.2rem;
            }

            .icon {
                font-size: 4rem;
            }

            p {
                font-size: 1.05rem;
            }

            .order-number {
                font-size: 1.15rem;
                padding: 1.2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="icon">
            <?= $is_cart_order ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-sparkles"></i>' ?>
        </div>
        
        <h1><?= $is_cart_order ? 'Order Confirmed!' : 'Request Received!' ?></h1>
        
        <p>
            <?php if($is_cart_order): ?>
                We've successfully received your order! Your items are being prepared fresh in our kitchen with love and care.
            <?php else: ?>
                Thank you for your custom creation request. We've received your details and design vision.
            <?php endif; ?>
        </p>
        
        <div class="order-number">
            <i class="fas fa-receipt"></i>
            Order No: <?php echo $order_no; ?>
        </div>
        
        <p class="wa-note">
            <i class="fab fa-whatsapp"></i>
            Our team will contact you on WhatsApp shortly to confirm delivery details and timing.
        </p>
        
        <a href="index.php" class="btn-home">
            <i class="fas fa-home"></i> Return to Homepage
        </a>
    </div>
</body>
</html>