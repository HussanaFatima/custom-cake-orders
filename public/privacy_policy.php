<?php
session_start();
require_once '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privacy Policy | Custom Creations</title>
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

            p {
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

        <h1>Privacy Policy</h1>
        <p class="last-updated">Last Updated: January 2025</p>

        <h2>1. Information We Collect</h2>
        <p>When you place an order with Custom Creations, we collect your name, phone number, email address, and delivery address. This information is essential to process your request and ensure timely delivery of your custom creations.</p>

        <h2>2. How We Use Your Data</h2>
        <p>Your personal information is used solely for order processing, delivery coordination, and communicating updates about your cake, balloon arrangement, or bouquet order. We may also use your contact information to send you important updates about our services.</p>

        <h2>3. Data Security</h2>
        <p>We take your privacy seriously and implement industry-standard security measures to protect your personal information. We do not share your data with third parties for marketing purposes. Payment details are processed through secure, encrypted gateways.</p>

        <h2>4. Your Rights</h2>
        <p>You have the right to request access to your personal data, request corrections, or request deletion of your information from our systems at any time.</p>

        <h2>5. Cookies and Tracking</h2>
        <p>Our website may use cookies to enhance your browsing experience. These cookies help us understand how you use our site and improve our services. You can control cookie settings through your browser preferences.</p>

        <h2>6. Contact Us</h2>
        <p>If you have any questions about how we handle your data or wish to exercise your privacy rights, please contact us at: <strong>privacy@customcreations.com</strong></p>
    </div>

    <footer>
        <p class="footer-logo">Custom <span>Creations</span></p>
        <p>&copy; 2025 Custom Creations. All rights reserved.</p>
    </footer>

</body>
</html>