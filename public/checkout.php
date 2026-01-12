<?php
session_start();
require_once '../includes/db.php';
if (empty($_SESSION['cart'])) { 
    header("Location: menu.php"); 
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout | Custom Creations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --cyprus: #004643;
            --cyprus-light: #006662;
            --cyprus-dark: #003330;
            --sand-dune: #F0EDE5;
            --sand-dark: #E5DFD4;
            --sand-light: #FAF8F4;
            --accent-gold: #C9A961;
            --text-dark: #2C2C2C;
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
            padding: 3rem 1.5rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkout-wrapper {
            width: 100%;
            max-width: 600px;
        }

        .checkout-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .checkout-header h1 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 3rem;
            margin-bottom: 0.8rem;
            font-weight: 800;
        }

        .checkout-header p {
            color: #666;
            font-size: 1.1rem;
        }

        .checkout-box {
            background: white;
            padding: 3.5rem;
            border-radius: 28px;
            box-shadow: 0 8px 40px rgba(0, 70, 67, 0.15);
        }

        .form-section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid var(--sand-dark);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .section-title i {
            color: var(--accent-gold);
        }

        .form-group {
            margin-bottom: 1.8rem;
        }

        label {
            display: block;
            font-weight: 700;
            color: var(--cyprus);
            margin-bottom: 0.8rem;
            font-size: 0.95rem;
        }

        .required {
            color: var(--accent-gold);
        }

        input, select, textarea {
            width: 100%;
            padding: 1.1rem 1.4rem;
            border: 2px solid var(--sand-dark);
            border-radius: 14px;
            font-size: 1rem;
            font-family: 'Lato', sans-serif;
            transition: all 0.3s ease;
            background: var(--sand-light);
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--cyprus);
            box-shadow: 0 0 0 4px rgba(0, 70, 67, 0.08);
            background: white;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23004643' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.2rem center;
            cursor: pointer;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .delivery-note {
            background: linear-gradient(135deg, rgba(201, 169, 97, 0.1), rgba(212, 185, 115, 0.1));
            padding: 1rem 1.3rem;
            border-radius: 12px;
            font-size: 0.9rem;
            color: var(--cyprus);
            border-left: 4px solid var(--accent-gold);
            margin-top: 0.8rem;
        }

        .delivery-note i {
            color: var(--accent-gold);
            margin-right: 0.5rem;
        }

        .btn-confirm {
            width: 100%;
            padding: 1.4rem;
            background: linear-gradient(135deg, var(--cyprus), var(--cyprus-light));
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 8px 28px rgba(0, 70, 67, 0.28);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            margin-top: 2.5rem;
        }

        .btn-confirm:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(0, 70, 67, 0.38);
        }

        .btn-confirm:active {
            transform: translateY(0);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            color: var(--cyprus);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--cyprus-light);
            transform: translateX(-5px);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            body {
                padding: 2rem 1rem;
            }

            .checkout-header h1 {
                font-size: 2.3rem;
            }

            .checkout-box {
                padding: 2.5rem 2rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1.5rem 1rem;
            }

            .checkout-header h1 {
                font-size: 2rem;
            }

            .checkout-header p {
                font-size: 1rem;
            }

            .checkout-box {
                padding: 2rem 1.5rem;
                border-radius: 24px;
            }

            .section-title {
                font-size: 1.3rem;
            }

            input, select, textarea {
                padding: 1rem 1.2rem;
            }

            .btn-confirm {
                padding: 1.2rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="checkout-wrapper">
    <a href="view_cart.php" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Cart
    </a>

    <div class="checkout-header">
        <h1>Checkout</h1>
        <p>Just one step away from your delicious order</p>
    </div>

    <div class="checkout-box">
        <form action="place_order.php" method="POST">
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-user"></i> Personal Information
                </h3>
                
                <div class="form-group">
                    <label for="customer_name">
                        Full Name <span class="required">*</span>
                    </label>
                    <input type="text" 
                           id="customer_name"
                           name="customer_name" 
                           placeholder="Enter your full name" 
                           required
                           maxlength="60">
                </div>

                <div class="form-group">
                    <label for="whatsapp">
                        WhatsApp Number <span class="required">*</span>
                    </label>
                    <input type="tel" 
                           id="whatsapp"
                           name="whatsapp" 
                           placeholder="03XXXXXXXXX"
                           maxlength="11"
                           inputmode="numeric"
                           pattern="^03[0-9]{9}$"
                           required>
                    <div class="delivery-note">
                        <i class="fab fa-whatsapp"></i> We'll send order updates on WhatsApp
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-map-marker-alt"></i> Delivery Details
                </h3>
                
                <div class="form-group">
                    <label for="location">
                        Delivery Area <span class="required">*</span>
                    </label>
                    <select id="location" name="location" required>
                        <option value="">Select your area</option>
                        <option value="DHA - Rs. 200">DHA (Delivery: Rs. 200)</option>
                        <option value="Gulberg - Rs. 150">Gulberg (Delivery: Rs. 150)</option>
                        <option value="Bahria - Rs. 300">Bahria Town (Delivery: Rs. 300)</option>
                        <option value="Saddar - Rs. 100">Saddar (Delivery: Rs. 100)</option>
                        <option value="Rawalpindi - Rs. 150">Rawalpindi (Delivery: Rs. 150)</option>
                        <option value="Other - Rs. 250">Other Area (Delivery: Rs. 250)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">
                        Complete Address <span class="required">*</span>
                    </label>
                    <textarea id="address"
                              name="address" 
                              placeholder="House/Flat number, Street name, Landmark..." 
                              rows="3" 
                              required></textarea>
                    <div class="delivery-note">
                        <i class="fas fa-info-circle"></i> Please provide detailed address for smooth delivery
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-confirm">
                <i class="fas fa-check-circle"></i> Place Order Now
            </button>
        </form>
    </div>
</div>

<script>
// Allow numbers only for WhatsApp
document.getElementById("whatsapp").addEventListener("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "");
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const phone = document.getElementById('whatsapp').value;
    
    if (!/^03[0-9]{9}$/.test(phone)) {
        e.preventDefault();
        alert('Please enter a valid WhatsApp number starting with 03 (11 digits)');
        return false;
    }
});
</script>

</body>
</html>