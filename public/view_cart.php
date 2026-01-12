<?php
session_start();
require_once '../includes/db.php';

// Add / Increase Quantity
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $id = $_GET['id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    
    if (isset($_GET['from']) && $_GET['from'] == 'cart') {
        header("Location: view_cart.php");
    } else {
        header("Location: menu.php?added=1#product_" . $id);
    }
    exit();
}

// Decrease Quantity
if (isset($_GET['action']) && $_GET['action'] == 'decrease') {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]--;
        if ($_SESSION['cart'][$id] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: view_cart.php");
    exit();
}

// Remove Item
if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header("Location: view_cart.php");
    exit();
}

$grand_total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | Custom Creations</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Lato:wght@300;400;600;700&display=swap" rel="stylesheet">
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
            --text-light: #5A5A5A;
            --white: #FFFFFF;
            
            --gradient-primary: linear-gradient(135deg, #004643 0%, #006662 100%);
            --gradient-accent: linear-gradient(135deg, #C9A961 0%, #D4B973 100%);
            --shadow-md: 0 4px 24px rgba(0, 70, 67, 0.12);
            --shadow-lg: 0 8px 40px rgba(0, 70, 67, 0.16);
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
        }

        .cart-wrapper {
            max-width: 1000px;
            margin: auto;
            background: white;
            border-radius: 32px;
            padding: 3.5rem;
            box-shadow: var(--shadow-lg);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 3rem;
            margin-bottom: 2.5rem;
            text-align: center;
            font-weight: 800;
        }

        h1 i {
            color: var(--accent-gold);
            margin-right: 1rem;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2rem 0;
            border-bottom: 2px solid var(--sand-dark);
            gap: 2rem;
        }

        .item-info {
            flex: 2;
        }

        .item-info h3 {
            color: var(--cyprus);
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .item-info small {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .item-qty {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            justify-content: center;
        }

        .qty-btn {
            background: var(--sand-dune);
            border: 2px solid var(--sand-dark);
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            text-decoration: none;
            color: var(--cyprus);
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: var(--cyprus);
            color: white;
            border-color: var(--cyprus);
            transform: translateY(-2px);
        }

        .item-qty span {
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--cyprus);
            min-width: 40px;
            text-align: center;
        }

        .item-price {
            flex: 1;
            text-align: right;
            font-weight: 700;
            color: var(--accent-gold);
            font-size: 1.5rem;
            font-family: 'Playfair Display', serif;
        }

        .remove-btn {
            color: #e74c3c;
            text-decoration: none;
            font-size: 1.8rem;
            margin-left: 1.5rem;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 8px;
        }

        .remove-btn:hover {
            background: rgba(231, 76, 60, 0.1);
            transform: scale(1.1);
        }

        .total-box {
            margin-top: 3rem;
            padding-top: 2.5rem;
            border-top: 3px solid var(--cyprus);
        }

        .total-box h2 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 2.2rem;
            text-align: right;
            margin-bottom: 2rem;
        }

        .total-box h2 span {
            color: var(--accent-gold);
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .back-link {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .back-link:hover {
            color: var(--cyprus);
        }

        .checkout-btn {
            background: var(--gradient-primary);
            color: white;
            padding: 1.3rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0, 70, 67, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(0, 70, 67, 0.35);
        }

        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
        }

        .empty-state i {
            font-size: 5rem;
            color: var(--sand-dark);
            margin-bottom: 2rem;
        }

        .empty-state h3 {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
        }

        @media (max-width: 768px) {
            .cart-wrapper {
                padding: 2.5rem 2rem;
            }

            h1 {
                font-size: 2.2rem;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .item-info,
            .item-qty,
            .item-price {
                width: 100%;
            }

            .item-qty {
                justify-content: flex-start;
            }

            .item-price {
                text-align: left;
            }

            .action-buttons {
                flex-direction: column;
            }

            .checkout-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1.5rem 1rem;
            }

            .cart-wrapper {
                padding: 2rem 1.5rem;
                border-radius: 24px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .cart-item {
                padding: 1.5rem 0;
            }

            .item-info h3 {
                font-size: 1.2rem;
            }

            .total-box h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<div class="cart-wrapper">
    <h1><i class="fa-solid fa-cart-shopping"></i> My Cart</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $id => $qty): 
            $id = mysqli_real_escape_string($conn, $id);
            $res = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
            $product = mysqli_fetch_assoc($res);
            $subtotal = $product['price'] * $qty;
            $grand_total += $subtotal;
        ?>
            <div class="cart-item">
                <div class="item-info">
                    <h3><?= htmlspecialchars($product['item_name']) ?></h3>
                    <small><?= $product['category'] ?></small>
                </div>
                
                <div class="item-qty">
                    <a href="view_cart.php?action=decrease&id=<?= $id ?>" class="qty-btn">−</a>
                    <span><?= $qty ?></span>
                    <a href="view_cart.php?action=add&id=<?= $id ?>&from=cart" class="qty-btn">+</a>
                </div>

                <div class="item-price">
                    Rs. <?= number_format($subtotal) ?>
                </div>

                <a href="view_cart.php?action=remove&id=<?= $id ?>" class="remove-btn" title="Remove Item">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        <?php endforeach; ?>

        <div class="total-box">
            <h2>Total: <span>Rs. <?= number_format($grand_total) ?></span></h2>
            <div class="action-buttons">
                <a href="menu.php" class="back-link">
                    <i class="fas fa-arrow-left"></i> Continue Shopping
                </a>
                <a href="checkout.php" class="checkout-btn">
                    Proceed to Checkout <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-shopping-bag"></i>
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added anything to your cart yet</p>
            <a href="menu.php" class="checkout-btn">
                <i class="fas fa-store"></i> Browse Menu
            </a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>