<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Custom Creations | Artisan Cakes, Balloons & Bouquets</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Lato:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<meta name="description" content="Award-winning custom cakes, balloon arrangements, and bouquets handcrafted with artisan precision.">

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
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

html {
  scroll-behavior: smooth;
}

body {
  font-family: 'Lato', sans-serif;
  background: var(--sand-dune);
  color: var(--text-dark);
  line-height: 1.7;
  overflow-x: hidden;
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
  transition: color 0.3s ease;
  flex-shrink: 0;
}

.logo:hover {
  color: var(--cyprus-light);
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
  letter-spacing: 0.3px;
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

.cart-li {
  position: relative;
}

.cart-icon-link {
  font-size: 1.5rem !important;
  color: var(--cyprus) !important;
  position: relative;
  padding: 0.6rem;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.cart-icon-link:hover {
  background: rgba(0, 70, 67, 0.08);
  color: var(--cyprus-light) !important;
}

.cart-badge-count {
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

.mobile-menu-btn {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
  flex-direction: column;
  gap: 5px;
  padding: 5px;
  z-index: 101;
}

.mobile-menu-btn span {
  display: block;
  width: 28px;
  height: 3px;
  background: var(--cyprus);
  transition: 0.3s;
  border-radius: 3px;
}

.mobile-menu-btn.active span:nth-child(1) {
  transform: rotate(45deg) translate(7px, 7px);
}

.mobile-menu-btn.active span:nth-child(2) {
  opacity: 0;
}

.mobile-menu-btn.active span:nth-child(3) {
  transform: rotate(-45deg) translate(7px, -7px);
}

/* MOBILE NAVIGATION */
@media (max-width: 968px) {
  nav {
    padding: 1rem 1.5rem;
  }

  .logo {
    font-size: 1.5rem;
  }
  
  .mobile-menu-btn {
    display: flex;
  }
  
  .nav-links {
    position: fixed;
    top: 0;
    right: -100%;
    height: 100vh;
    width: 280px;
    background: white;
    flex-direction: column;
    gap: 0;
    padding: 5rem 0 2rem;
    box-shadow: -5px 0 20px rgba(0, 70, 67, 0.1);
    transition: right 0.4s ease;
    overflow-y: auto;
  }
  
  .nav-links.active {
    right: 0;
  }
  
  .nav-links li {
    width: 100%;
    border-bottom: 1px solid var(--sand-dark);
  }
  
  .nav-links a {
    display: block;
    padding: 1.2rem 2rem;
    font-size: 1rem;
  }

  .nav-links a::after {
    display: none;
  }
  
  .cta-btn {
    margin: 1rem 2rem;
    text-align: center;
    display: block;
  }

  .cart-li {
    padding: 1rem 2rem;
    display: flex;
    justify-content: center;
  }
}

/* HERO SECTION */
.hero {
  padding: 11rem 2.5rem 9rem;
  text-align: center;
  background: linear-gradient(135deg, var(--cyprus) 0%, var(--cyprus-light) 100%);
  position: relative;
  overflow: hidden;
}

.hero::before {
  content: '';
  position: absolute;
  top: -40%;
  right: -8%;
  width: 650px;
  height: 650px;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
  border-radius: 50%;
  animation: float 10s ease-in-out infinite;
}

.hero::after {
  content: '';
  position: absolute;
  bottom: -35%;
  left: -3%;
  width: 550px;
  height: 550px;
  background: radial-gradient(circle, rgba(201, 169, 97, 0.12) 0%, transparent 70%);
  border-radius: 50%;
  animation: float 12s ease-in-out infinite reverse;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(50px) rotate(5deg); }
}

.hero-content {
  position: relative;
  z-index: 1;
  max-width: 950px;
  margin: 0 auto;
}

.hero-badge {
  display: inline-block;
  background: rgba(255, 255, 255, 0.15);
  color: white;
  padding: 0.6rem 1.8rem;
  border-radius: 50px;
  font-size: 0.88rem;
  font-weight: 700;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  margin-bottom: 2.5rem;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.2);
}

.hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 5rem;
  color: white;
  margin: 0 0 2rem 0;
  line-height: 1.15;
  font-weight: 800;
  letter-spacing: -1.5px;
}

.hero h1 span {
  color: var(--accent-gold);
  position: relative;
  display: inline-block;
}

.hero p {
  font-size: 1.4rem;
  color: rgba(255, 255, 255, 0.95);
  margin: 0 0 3.5rem 0;
  font-weight: 400;
  line-height: 1.9;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.hero-cta {
  display: inline-block;
  padding: 1.4rem 3.8rem;
  background: white;
  color: var(--cyprus);
  text-decoration: none;
  border-radius: 50px;
  font-weight: 700;
  letter-spacing: 0.8px;
  font-size: 1.08rem;
  transition: all 0.4s ease;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
  position: relative;
  overflow: hidden;
}

.hero-cta::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(201, 169, 97, 0.2), transparent);
  transition: 0.6s;
}

.hero-cta:hover::before {
  left: 100%;
}

.hero-cta:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 50px rgba(0, 0, 0, 0.3);
  background: var(--accent-gold);
  color: white;
}

/* RESPONSIVE HERO */
@media (max-width: 968px) {
  .hero {
    padding: 8rem 2rem 7rem;
  }

  .hero-badge {
    font-size: 0.75rem;
    padding: 0.5rem 1.5rem;
    margin-bottom: 2rem;
  }

  .hero h1 {
    font-size: 3.5rem;
  }

  .hero p {
    font-size: 1.2rem;
  }

  .hero-cta {
    padding: 1.2rem 3rem;
    font-size: 1rem;
  }
}

@media (max-width: 600px) {
  .hero {
    padding: 6rem 1.5rem 5rem;
  }

  .hero h1 {
    font-size: 2.5rem;
    letter-spacing: -1px;
  }

  .hero p {
    font-size: 1.05rem;
    margin-bottom: 2.5rem;
  }

  .hero-cta {
    padding: 1rem 2.5rem;
    font-size: 0.95rem;
  }
}

/* SECTION STYLING */
.section {
  max-width: 1400px;
  margin: 7rem auto;
  padding: 0 2.5rem;
}

.section-title {
  text-align: center;
  font-family: 'Playfair Display', serif;
  font-size: 3.5rem;
  color: var(--cyprus);
  margin-bottom: 1.2rem;
  font-weight: 800;
  letter-spacing: -0.8px;
}

.section-subtitle {
  text-align: center;
  color: var(--text-light);
  font-size: 1.2rem;
  margin-bottom: 5rem;
  font-weight: 400;
}

/* RESPONSIVE SECTIONS */
@media (max-width: 968px) {
  .section {
    margin: 5rem auto;
    padding: 0 2rem;
  }

  .section-title {
    font-size: 2.5rem;
  }

  .section-subtitle {
    font-size: 1.1rem;
    margin-bottom: 3.5rem;
  }
}

@media (max-width: 600px) {
  .section {
    margin: 4rem auto;
    padding: 0 1.5rem;
  }

  .section-title {
    font-size: 2rem;
  }

  .section-subtitle {
    font-size: 1rem;
    margin-bottom: 2.5rem;
  }
}

/* CARDS */
.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
  gap: 3rem;
}

@media (max-width: 968px) {
  .cards {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2.5rem;
  }
}

@media (max-width: 600px) {
  .cards {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
}

.card {
  background: white;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: var(--shadow-md);
  transition: all 0.5s ease;
  position: relative;
}

.card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: var(--gradient-primary);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.5s ease;
  z-index: 1;
}

.card:hover::before {
  transform: scaleX(1);
}

.card:hover {
  transform: translateY(-18px);
  box-shadow: 0 20px 55px rgba(0, 70, 67, 0.22);
}

.card img {
  width: 100%;
  height: 300px;
  object-fit: cover;
  transition: transform 0.7s ease;
}

.card:hover img {
  transform: scale(1.1);
}

.card-content {
  padding: 2.8rem 2.2rem;
  text-align: center;
}

.card-content h3 {
  margin: 0;
  color: var(--cyprus);
  font-size: 1.75rem;
  font-weight: 700;
  font-family: 'Playfair Display', serif;
  margin-bottom: 1rem;
}

.card-content p {
  color: var(--text-light);
  font-size: 1.05rem;
  line-height: 1.8;
}

@media (max-width: 600px) {
  .card img {
    height: 250px;
  }

  .card-content {
    padding: 2rem 1.5rem;
  }

  .card-content h3 {
    font-size: 1.5rem;
  }

  .card-content p {
    font-size: 1rem;
  }
}

/* REVIEWS SECTION */
.reviews-container {
  background: white;
  padding: 6rem 5rem;
  border-radius: 36px;
  box-shadow: var(--shadow-lg);
}

.reviews-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 3rem;
  margin-top: 4rem;
}

@media (max-width: 968px) {
  .reviews-container {
    padding: 4rem 3rem;
    border-radius: 28px;
  }

  .reviews-grid {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2.5rem;
    margin-top: 3rem;
  }
}

@media (max-width: 600px) {
  .reviews-container {
    padding: 3rem 2rem;
    border-radius: 24px;
  }

  .reviews-grid {
    grid-template-columns: 1fr;
    gap: 2rem;
    margin-top: 2rem;
  }
}

.review {
  background: var(--sand-light);
  padding: 3rem;
  border-radius: 24px;
  border-left: 5px solid var(--accent-gold);
  position: relative;
  transition: all 0.4s ease;
}

.review:hover {
  transform: translateX(10px);
  box-shadow: var(--shadow-md);
}

.review-text {
  color: var(--text-dark);
  font-style: italic;
  margin: 0 0 2rem 0;
  font-size: 1.08rem;
  line-height: 1.9;
}

.review-author {
  color: var(--cyprus);
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 0.8rem;
  font-size: 1.05rem;
}

.review-author::before {
  content: '★★★★★';
  color: var(--accent-gold);
  font-size: 1rem;
}

@media (max-width: 600px) {
  .review {
    padding: 2rem 1.5rem;
  }

  .review-text {
    font-size: 1rem;
    margin-bottom: 1.5rem;
  }

  .review-author {
    font-size: 1rem;
  }

  .review-author::before {
    font-size: 0.9rem;
  }
}

/* CTA SECTION */
.cta {
  text-align: center;
  padding: 7rem 4rem;
  background: var(--gradient-primary);
  border-radius: 36px;
  margin-bottom: 5rem;
  box-shadow: 0 24px 60px rgba(0, 70, 67, 0.28);
  position: relative;
  overflow: hidden;
}

.cta::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  animation: rotate 25s linear infinite;
}

@keyframes rotate {
  to { transform: rotate(360deg); }
}

.cta h2 {
  font-family: 'Playfair Display', serif;
  font-size: 3.3rem;
  color: white;
  margin: 0 0 1.5rem 0;
  position: relative;
  z-index: 1;
}

.cta p {
  color: rgba(255, 255, 255, 0.95);
  font-size: 1.3rem;
  margin: 0 0 3rem 0;
  position: relative;
  z-index: 1;
}

.cta-button {
  display: inline-block;
  padding: 1.4rem 3.8rem;
  background: white;
  color: var(--cyprus);
  text-decoration: none;
  border-radius: 50px;
  font-weight: 700;
  letter-spacing: 0.8px;
  transition: all 0.4s ease;
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
  position: relative;
  z-index: 1;
  font-size: 1.05rem;
}

.cta-button:hover {
  background: var(--accent-gold);
  color: white;
  transform: translateY(-4px);
  box-shadow: 0 18px 45px rgba(0, 0, 0, 0.25);
}

@media (max-width: 968px) {
  .cta {
    padding: 5rem 3rem;
    border-radius: 28px;
    margin-bottom: 4rem;
  }

  .cta h2 {
    font-size: 2.5rem;
  }

  .cta p {
    font-size: 1.15rem;
    margin-bottom: 2.5rem;
  }

  .cta-button {
    padding: 1.2rem 3rem;
  }
}

@media (max-width: 600px) {
  .cta {
    padding: 3.5rem 2rem;
    border-radius: 24px;
  }

  .cta h2 {
    font-size: 2rem;
    line-height: 1.3;
  }

  .cta p {
    font-size: 1rem;
    margin-bottom: 2rem;
    line-height: 1.6;
  }

  .cta-button {
    padding: 1rem 2.5rem;
    font-size: 0.95rem;
  }
}

/* FOOTER */
footer {
  background: var(--cyprus-dark);
  color: rgba(255, 255, 255, 0.85);
  padding: 6rem 2.5rem 2.5rem;
  margin-top: 9rem;
}

.footer-container {
  max-width: 1400px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
  gap: 4rem;
  margin-bottom: 4rem;
}

.footer-section h3 {
  color: white;
  margin-bottom: 1.8rem;
  font-family: 'Playfair Display', serif;
  font-size: 1.5rem;
}

.footer-section p {
  line-height: 1.9;
  color: rgba(255,255,255,0.75);
}

.footer-section ul {
  list-style: none;
  line-height: 2.2;
}

.footer-section ul li {
  margin-bottom: 1rem;
}

.footer-section a {
  color: rgba(255, 255, 255, 0.75);
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-section a:hover {
  color: var(--accent-gold);
}

.social-links {
  display: flex;
  gap: 1.2rem;
  margin-top: 2rem;
}

.social-links a {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(201, 169, 97, 0.15);
  border-radius: 50%;
  color: var(--accent-gold);
  transition: all 0.3s ease;
}

.social-links a:hover {
  background: var(--accent-gold);
  color: var(--cyprus-dark);
  transform: translateY(-4px);
}

.footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, 0.12);
  padding-top: 2.5rem;
  text-align: center;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 1.5rem;
  align-items: center;
}

.footer-bottom > div {
  display: flex;
  gap: 1.5rem;
}

@media (max-width: 968px) {
  footer {
    padding: 4rem 2rem 2rem;
    margin-top: 6rem;
  }

  .footer-container {
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
  }

  .footer-section h3 {
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
  }
}

@media (max-width: 600px) {
  footer {
    padding: 3rem 1.5rem 2rem;
    margin-top: 4rem;
  }

  .footer-container {
    grid-template-columns: 1fr;
    gap: 2.5rem;
    margin-bottom: 2.5rem;
  }

  .footer-section h3 {
    font-size: 1.2rem;
  }

  .footer-section p,
  .footer-section ul {
    font-size: 0.95rem;
  }

  .social-links {
    gap: 1rem;
  }

  .social-links a {
    width: 44px;
    height: 44px;
  }

  .footer-bottom {
    flex-direction: column;
    gap: 1.5rem;
    font-size: 0.9rem;
  }

  .footer-bottom > div {
    flex-direction: column;
    gap: 1rem;
  }
}
</style>
</head>

<body>

<nav>
  <div class="nav-container">
    <a href="#home" class="logo">Custom <span>Creations</span></a>
    
    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>

    <ul class="nav-links" id="navLinks">
      <li><a href="index.php">Home</a></li>
      <li><a href="menu.php">Menu</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#work">Portfolio</a></li>
      <li><a href="#reviews">Reviews</a></li>
      
      <li class="cart-li">
        <a href="view_cart.php" class="cart-icon-link" aria-label="Shopping cart">
          <i class="fa-solid fa-cart-shopping"></i>
        </a>
      </li>

      <li><a href="order.php" class="cta-btn">Custom Order</a></li>
    </ul>
  </div>
</nav>

<section class="hero" id="home">
  <div class="hero-content">
    <div class="hero-badge">HANDCRAFTED EXCELLENCE</div>
    <h1>Custom <span>Cakes</span>, Balloons & Bouquets</h1>
    <p>Every creation is a masterpiece — designed with precision, crafted with passion, and created exclusively for you</p>
    <a href="order.php" class="hero-cta">Begin Your Journey</a>
  </div>
</section>

<section class="section" id="services">
  <h2 class="section-title">Our Craftsmanship</h2>
  <p class="section-subtitle">Where artistry meets culinary excellence</p>
  <div class="cards">
    <div class="card">
      <img src="assets\images\cake.jpg" alt="Custom Cakes">
      <div class="card-content">
        <h3>Custom Cakes</h3>
        <p>Meticulously designed cakes that blend exquisite flavors with stunning visual artistry</p>
      </div>
    </div>

    <div class="card">
      <img src="assets\images\ballon.jpg" alt="Luxury Balloon Arrangements">
      <div class="card-content">
        <h3>Balloon Artistry</h3>
        <p>Sophisticated arrangements that transform spaces into unforgettable experiences</p>
      </div>
    </div>

    <div class="card">
      <img src="assets\images\bouqet.jpg" alt="Bespoke Bouquets">
      <div class="card-content">
        <h3>Bespoke Bouquets</h3>
        <p>Timeless floral compositions curated with premium blooms and artistic vision</p>
      </div>
    </div>
  </div>
</section>

<section class="section" id="work">
  <h2 class="section-title">Featured Creations</h2>
  <p class="section-subtitle">Each piece tells a unique story</p>
  <div class="cards">
    <div class="card">
      <img src="assets\images\work1.jpg" alt="Premium Cake Design">
    </div>
    <div class="card">
      <img src="assets\images\work2.jpg" alt="cake Creation">
    </div>
    <div class="card">
      <img src="assets\images\work3.jpg" alt="Signature Masterpiece">
    </div>
  </div>
</section>

<section class="section" id="reviews">
  <div class="reviews-container">
    <h2 class="section-title">Client Testimonials</h2>
    <div class="reviews-grid">
      <div class="review">
        <p class="review-text">"An absolute masterpiece. The attention to detail and flavor complexity exceeded our highest expectations."</p>
        <div class="review-author">Sarah M.</div>
      </div>
      <div class="review">
        <p class="review-text">"Professionalism and artistry combined. They brought our vision to life with remarkable precision."</p>
        <div class="review-author">Emily R.</div>
      </div>
      <div class="review">
        <p class="review-text">"Exceptional service from concept to delivery. Every interaction reflected their commitment to excellence."</p>
        <div class="review-author">Jessica P.</div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="cta">
    <h2>Ready to Create Magic?</h2>
    <p>Let's collaborate to bring your vision to life with unparalleled craftsmanship</p>
    <a href="order.php" class="cta-button">Commission Your Piece</a>
  </div>
</section>

<footer>
  <div class="footer-container">
    <div class="footer-section">
      <h3>Custom Creations</h3>
      <p>
        Custom cakes, balloon artistry, and bespoke bouquets crafted with uncompromising excellence.
      </p>
      <div class="social-links">
        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
        <a href="#" title="Pinterest"><i class="fab fa-pinterest"></i></a>
      </div>
    </div>

    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#services">Services</a></li>
        <li><a href="#work">Portfolio</a></li>
        <li><a href="#reviews">Testimonials</a></li>
        <li><a href="order.php">Place Order</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Contact</h3>
      <p>
        📧 hello@customcreations.com<br>
        📱 +92 345 76586543<br>
        📍 123 Design Street<br>
        Rawalpindi, Pakistan
      </p>
    </div>

    <div class="footer-section">
      <h3>Atelier Hours</h3>
      <ul>
        <li>Monday - Friday: 10am - 6pm</li>
        <li>Saturday: 11am - 5pm</li>
        <li>Sunday: Closed</li>
        <li style="margin-top: 1.5rem; color: var(--accent-gold);">48 hours advance notice required</li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Custom Creations. All rights reserved.</p>
    <div>
      <a href="privacy_policy.php">Privacy Policy</a>
      <a href="terms_of_services.php">Terms of Service</a>
    </div>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const navLinks = document.getElementById('navLinks');
  
  mobileMenuBtn.addEventListener('click', function() {
    mobileMenuBtn.classList.toggle('active');
    navLinks.classList.toggle('active');
  });
  
  // Close menu when clicking on a link
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function() {
      mobileMenuBtn.classList.remove('active');
      navLinks.classList.remove('active');
    });
  });

  // Close menu when clicking outside
  document.addEventListener('click', function(event) {
    const isClickInsideNav = navLinks.contains(event.target);
    const isClickOnButton = mobileMenuBtn.contains(event.target);
    
    if (!isClickInsideNav && !isClickOnButton && navLinks.classList.contains('active')) {
      mobileMenuBtn.classList.remove('active');
      navLinks.classList.remove('active');
    }
  });
});
</script>

</body>
</html>