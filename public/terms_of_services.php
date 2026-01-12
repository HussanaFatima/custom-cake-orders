<?php
session_start();
require_once '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Terms of Service | Custom Creations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --cyprus: #004643;
            --cyprus-light: #006662;
            --cyprus-dark: #003330;
            --sand-dune: #F0EDE5;
            --sand-light: #FAF8F4;
            --accent-gold: #C9A961;
            --text-dark: #2C2C2C;
            --text-light: #5A5A5A;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            background: var(--sand-dune);
            color: var(--text-dark);
            line-height: 1.8;
        }

        .container {
            max-width: 900px;
            margin: 5rem auto 4rem;
            background: white;
            padding: 4rem 3.5rem;
            border-radius: 28px;
            box-shadow: 0 8px 40px rgba(0, 70, 67, 0.12);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 2.5rem;
            text-decoration: none;
            color: var(--cyprus);
            font-weight: 700;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .back-link:hover {
            color: var(--cyprus-light);
            transform: translateX(-5px);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            border-bottom: 4px solid var(--accent-gold);
            padding-bottom: 1.2rem;
            margin-bottom: 2rem;
            font-size: 3rem;
            font-weight: 800;
        }

        .last-updated {
            font-style: italic;
            color: var(--text-light);
            margin-bottom: 3rem;
            font-size: 0.95rem;
        }

        h2 {
            color: var(--cyprus);
            margin: 3rem 0 1.5rem;
            font-size: 1.8rem;
            font-weight: 700;
            border-left: 5px solid var(--accent-gold);
            padding-left: 1.5rem;
        }

        p {
            margin-bottom: 1.5rem;
            font-size: 1.05rem;
            line-height: 1.9;
        }

        ul {
            margin: 1.5rem 0 2rem 2rem;
            line-height: 2;
        }

        ul li {
            margin-bottom: 0.8rem;
            font-size: 1.05rem;
        }

        strong {
            color: var(--cyprus);
            font-weight: 700;
        }

        footer {
            background: var(--cyprus-dark);
            color: rgba(255, 255, 255, 0.85);
            padding: 3rem 2rem;
            text-align: center;
            margin-top: 4rem;
        }

        footer p {
            margin: 0.5rem 0;
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
        }

        .footer-logo span {
            color: var(--accent-gold);
        }

        @media (max-width: 768px) {
            .container {
                margin: 3rem auto;
                padding: 3rem 2rem;
                border-radius: 24px;
            }

            h1 {
                font-size: 2.2rem;
            }

            h2 {
                font-size: 1.5rem;
                margin: 2.5rem 0 1.2rem;
            }

            p, ul li {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                margin: 2rem 1rem;
                padding: 2.5rem 1.5rem;
            }

            h1 {
                font-size: 1.9rem;
            }

            h2 {
                font-size: 1.3rem;
                padding-left: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>

        <h1>Terms of Service</h1>
        <p class="last-updated">Effective Date: January 01, 2025</p>

        <p>Welcome to <strong>Custom Creations</strong>. By placing an order on our website or through our services, you agree to comply with and be bound by the following terms and conditions of use.</p>

        <h2>1. Ordering & Customization</h2>
        <p>All standard orders must be placed at least 48 hours in advance. Highly customized designs and large orders require a minimum of 1 week advance notice. We reserve the right to refuse orders that exceed our production capacity or fall outside our service parameters.</p>

        <h2>2. Payment Terms</h2>
        <p>For custom creation orders, a 50% advance payment may be required to secure your booking. Full payment must be completed before or at the time of delivery/pickup. We accept cash on delivery, bank transfers, and major digital payment methods.</p>

        <h2>3. Cancellation & Refunds</h2>
        <ul>
            <li>Cancellations made 48 hours or more before the scheduled delivery date will receive a full refund.</li>
            <li>Cancellations made within 24-48 hours are subject to a 50% cancellation fee, as preparation has already begun.</li>
            <li>Cancellations made less than 24 hours before delivery or after the product has been dispatched will not be eligible for refunds.</li>
            <li>No refunds will be issued for "change of mind" after the product has been delivered and accepted.</li>
        </ul>

        <h2>4. Delivery & Pickup</h2>
        <p>We take extreme care in transporting our products to maintain their quality and presentation. However, once a product is handed over to the customer (in case of pickup) or delivered to the specified address, Custom Creations is not responsible for any subsequent damage due to improper handling, storage, or environmental conditions.</p>

        <h2>5. Allergies & Ingredients</h2>
        <p>While we take precautions to accommodate dietary requirements, our kitchen handles common allergens including nuts, dairy, gluten, and eggs. It is the customer's responsibility to inform us of any severe allergies or dietary restrictions at the time of ordering. We cannot guarantee 100% allergen-free environments.</p>

        <h2>6. Product Variations</h2>
        <p>Custom creations are handcrafted and may have slight variations from reference images. We strive to match your vision as closely as possible while maintaining our artistic standards and quality.</p>

        <h2>7. Intellectual Property</h2>
        <p>All designs, images, and content on our website are the property of Custom Creations. Unauthorized reproduction or use of our designs is prohibited.</p>

        <h2>8. Changes to Terms</h2>
        <p>Custom Creations reserves the right to modify these terms and conditions at any time without prior notice. Continued use of our services constitutes acceptance of any changes.</p>
    </div>

    <footer>
        <p class="footer-logo">Custom <span>Creations</span></p>
        <p>&copy; 2025 Custom Creations. All rights reserved.</p>
    </footer>

</body>
</html>