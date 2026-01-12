<?php
session_start();
require_once '../includes/db.php';
$cart_count = (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) ? array_sum($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Menu | Custom Creations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            --shadow-sm: 0 2px 12px rgba(0, 70, 67, 0.08);
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
            color: var(--text-dark);
            line-height: 1.7;
        }

        /* NAVBAR */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-sm);
            padding: 1.3rem 2.5rem;
            border-bottom: 1px solid rgba(0, 70, 67, 0.08);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.9rem;
            color: var(--cyprus);
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.5px;
            position: relative;
        }

        .logo span {
            color: var(--accent-gold);
        }

        .logo::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 45%;
            height: 3px;
            background: var(--gradient-accent);
            border-radius: 3px;
        }

        .nav-links {
            display: flex;
            gap: 3rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            color: var(--cyprus);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--cyprus);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-links a.active {
            color: var(--cyprus);
        }

        .nav-links a.active::after {
            width: 100%;
        }

        .cart-li {
            position: relative;
        }

        .cart-icon-link {
            font-size: 1.5rem !important;
            color: var(--cyprus) !important;
            padding: 0.6rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .cart-icon-link:hover {
            background: rgba(0, 70, 67, 0.08);
        }

        .badge {
            position: absolute;
            top: -3px;
            right: -8px;
            background: var(--accent-gold);
            color: white;
            font-size: 0.7rem;
            font-weight: 800;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(201, 169, 97, 0.4);
        }

        .cta-btn {
            background: var(--gradient-primary) !important;
            color: white !important;
            padding: 0.85rem 2.2rem;
            border-radius: 50px;
            font-weight: 700;
            box-shadow: 0 4px 20px rgba(0, 70, 67, 0.25);
            transition: all 0.3s ease;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(0, 70, 67, 0.35);
        }

        .cta-btn::after {
            display: none;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            border: none;
            background: none;
            padding: 5px;
        }

        .menu-toggle span {
            display: block;
            width: 28px;
            height: 3px;
            background: var(--cyprus);
            border-radius: 3px;
            transition: 0.3s;
        }

        /* HERO HEADER */
        .page-hero {
            background: var(--gradient-primary);
            padding: 5rem 2.5rem 3.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            color: white;
            margin: 0 0 1rem 0;
            font-weight: 800;
            position: relative;
            z-index: 1;
        }

        .page-hero p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.95);
            position: relative;
            z-index: 1;
            max-width: 650px;
            margin: 0 auto;
        }

        /* MENU CONTENT */
        .section {
            max-width: 1400px;
            margin: 5rem auto;
            padding: 0 2.5rem;
        }

        .category-header {
            font-family: 'Playfair Display', serif;
            color: var(--cyprus);
            border-left: 6px solid var(--accent-gold);
            padding-left: 1.8rem;
            margin: 4rem 0 2.5rem;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2.5rem;
        }

        .card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-accent);
            border-radius: 24px 24px 0 0;
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 16px 48px rgba(0, 70, 67, 0.18);
        }

        .card-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .card:hover .card-image {
            transform: scale(1.1);
        }

        .card-content {
            padding: 2rem;
        }

        .card h3 {
            color: var(--cyprus);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .price {
            color: var(--accent-gold);
            font-weight: 700;
            font-size: 1.4rem;
            margin: 1.2rem 0;
            font-family: 'Playfair Display', serif;
        }

        .btn-add {
            display: inline-block;
            background: var(--cyprus);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            margin-top: 1.2rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(0, 70, 67, 0.2);
        }

        .btn-add:hover {
            background: var(--cyprus-light);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 70, 67, 0.3);
        }

        /* TOAST NOTIFICATION */
        #cart-toast {
            display: none;
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: var(--cyprus);
            color: white;
            padding: 1.2rem 2rem;
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(0, 70, 67, 0.35);
            z-index: 1000;
            font-weight: 700;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from { transform: translateY(100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* FOOTER */
        footer {
            background: var(--cyprus-dark);
            color: rgba(255, 255, 255, 0.85);
            padding: 3rem 2.5rem;
            text-align: center;
            margin-top: 6rem;
        }

        footer p {
            margin: 0;
        }

        .no-image-placeholder {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, var(--sand-light), var(--sand-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(0, 70, 67, 0.2);
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                flex-direction: column;
                padding: 1.5rem;
                gap: 1rem;
                box-shadow: 0 10px 30px rgba(0, 70, 67, 0.15);
            }

            .nav-links.active {
                display: flex;
            }

            .menu-toggle {
                display: flex;
            }

            .page-hero h1 {
                font-size: 2.8rem;
            }

            .category-header {
                font-size: 2rem;
            }

            .grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .card-content {
                padding: 1.5rem;
            }

            .card h3 {
                font-size: 1.2rem;
            }

            .price {
                font-size: 1.2rem;
                margin: 0.8rem 0;
            }

            .btn-add {
                padding: 0.8rem 1.8rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .card-image, .no-image-placeholder {
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            nav {
                padding: 1rem 1.5rem;
            }

            .logo {
                font-size: 1.5rem;
            }

            .logo::after {
                bottom: -4px;
                height: 2px;
            }

            .nav-links {
                padding: 1.2rem;
                gap: 0.8rem;
            }

            .nav-links a {
                font-size: 0.9rem;
                padding: 0.5rem 0;
            }

            .cta-btn {
                padding: 0.7rem 1.8rem !important;
                font-size: 0.9rem !important;
            }

            .cart-icon-link {
                font-size: 1.3rem !important;
            }

            .badge {
                width: 18px;
                height: 18px;
                font-size: 0.65rem;
                top: -2px;
                right: -6px;
            }

            .section {
                padding: 0 1.5rem;
                margin: 3rem auto;
            }

            .grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .page-hero {
                padding: 3.5rem 1.5rem 2.5rem;
            }

            .page-hero h1 {
                font-size: 2rem;
            }

            .page-hero p {
                font-size: 1rem;
            }

            .category-header {
                font-size: 1.6rem;
                padding-left: 1rem;
                margin: 3rem 0 1.5rem;
                border-left-width: 4px;
            }

            .card {
                border-radius: 16px;
            }

            .card-image, .no-image-placeholder {
                height: 180px;
            }

            .no-image-placeholder {
                font-size: 2.5rem;
            }

            .card-content {
                padding: 1.2rem;
            }

            .card h3 {
                font-size: 1.1rem;
                margin-bottom: 0.6rem;
            }

            .price {
                font-size: 1.1rem;
                margin: 0.6rem 0;
            }

            .btn-add {
                padding: 0.7rem 1.5rem;
                font-size: 0.8rem;
                margin-top: 0.8rem;
            }

            #cart-toast {
                bottom: 20px;
                right: 20px;
                left: 20px;
                padding: 1rem 1.5rem;
                font-size: 0.9rem;
                text-align: center;
            }

            footer {
                padding: 2rem 1.5rem;
                margin-top: 4rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 360px) {
            .logo {
                font-size: 1.3rem;
            }

            .page-hero h1 {
                font-size: 1.7rem;
            }

            .category-header {
                font-size: 1.4rem;
            }

            .card h3 {
                font-size: 1rem;
            }

            .price {
                font-size: 1rem;
            }

            .btn-add {
                padding: 0.6rem 1.2rem;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>

<nav>
  <div class="nav-container">
    <a href="index.php" class="logo">Custom <span>Creations</span></a>
    
    <button class="menu-toggle" id="mobile-menu" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="menu.php" class="active">Menu</a></li>
      <li><a href="index.php#services">Services</a></li>
      <li><a href="index.php#work">Portfolio</a></li>
      <li class="cart-li">
          <a href="view_cart.php" class="cart-icon-link">
              <i class="fa-solid fa-cart-shopping"></i>
              <?php if($cart_count > 0): ?>
                <span class="badge"><?= $cart_count ?></span>
              <?php endif; ?>
          </a>
      </li>
      <li><a href="order.php" class="cta-btn">Custom Order</a></li>
    </ul>
  </div>
</nav>

<div class="page-hero">
    <h1>Our Menu</h1>
    <p>Handcrafted delights made fresh daily with premium ingredients</p>
</div>

<div class="section">
    <?php
    $cat_query = mysqli_query($conn, "SELECT DISTINCT category FROM products");
    while ($cat = mysqli_fetch_assoc($cat_query)):
        $current_cat = $cat['category'];
    ?>
        <h2 class="category-header"><?= $current_cat ?></h2>
        <div class="grid">
            <?php
            $stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
            $stmt->bind_param("s", $current_cat);
            $stmt->execute();
            $items = $stmt->get_result();
            while ($item = $items->fetch_assoc()):
            ?>
                <div class="card" id="product_<?= $item['id'] ?>">
                    <?php if(!empty($item['image']) && file_exists("../uploads/" . $item['image'])): ?>
                        <img src="../uploads/<?= htmlspecialchars($item['image']) ?>" 
                             alt="<?= htmlspecialchars($item['item_name']) ?>" 
                             class="card-image">
                    <?php else: ?>
                        <div class="no-image-placeholder">
                            <i class="fas fa-cake-candles"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-content">
                        <h3><?= htmlspecialchars($item['item_name']) ?></h3>
                        <p class="price">Rs. <?= number_format($item['price']) ?></p>
                        
                        <a href="view_cart.php?action=add&id=<?= $item['id'] ?>#product_<?= $item['id'] ?>" class="btn-add">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endwhile; ?>
</div>

<div id="cart-toast">
    <i class="fas fa-check-circle"></i> Item added to cart successfully!
</div>

<footer>
    <p>&copy; 2025 Custom Creations. All rights reserved.</p>
</footer>

<script>
// Check if URL has 'added=1'
const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('added')) {
    const toast = document.getElementById('cart-toast');
    
    toast.style.display = 'block';

    const newUrl = window.location.pathname + window.location.hash;
    window.history.replaceState({}, document.title, newUrl);

    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}

// Mobile menu toggle
const menuBtn = document.getElementById('mobile-menu');
const navLinks = document.querySelector('.nav-links');

if (menuBtn) {
    menuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}

document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('active');
    });
});
</script>

</body>
</html>