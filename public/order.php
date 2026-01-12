<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Commission Your Masterpiece | Custom Creations</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Commission a bespoke creation - cakes, balloon artistry, or bouquets designed exclusively for you.">

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
  color: var(--text-dark);
  line-height: 1.7;
}

/* BACK BUTTON */
.back-button {
  position: fixed;
  top: 20px;
  left: 20px;
  z-index: 1000;
  background: white;
  color: var(--cyprus);
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  box-shadow: 0 4px 20px rgba(0, 70, 67, 0.2);
  transition: all 0.3s ease;
  font-size: 1.2rem;
}

.back-button:hover {
  background: var(--cyprus);
  color: white;
  transform: translateX(-5px);
}

/* HERO SECTION */
.hero {
  background: var(--gradient-primary);
  padding: 6rem 2rem 6rem;
  text-align: center;
  position: relative;
  overflow: hidden;
  margin-top: 0;
  margin-bottom: 2rem;
}

.hero::before {
  content: '';
  position: absolute;
  top: -40%;
  right: -15%;
  width: 550px;
  height: 550px;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.12) 0%, transparent 70%);
  border-radius: 50%;
  animation: float 10s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(40px); }
}

.hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2rem, 5vw, 4rem);
  color: white;
  margin: 0 0 1.5rem 0;
  font-weight: 800;
  position: relative;
  z-index: 1;
  letter-spacing: -1px;
}

.hero p {
  font-size: clamp(1rem, 2.5vw, 1.3rem);
  color: rgba(255, 255, 255, 0.95);
  position: relative;
  z-index: 1;
  max-width: 650px;
  margin: 0 auto;
  padding: 0 1rem;
}

/* FORM CONTAINER */
main {
  padding: 2rem 1rem 4rem;
}

.form-box {
  max-width: 850px;
  margin: -2.5rem auto 0;
  background: white;
  padding: clamp(2rem, 5vw, 4.5rem);
  border-radius: 28px;
  box-shadow: var(--shadow-lg);
  position: relative;
  z-index: 2;
}

.form-header {
  text-align: center;
  margin-bottom: 3rem;
}

.form-header h2 {
  font-family: 'Playfair Display', serif;
  color: var(--cyprus);
  font-size: clamp(1.8rem, 4vw, 2.5rem);
  margin-bottom: 0.8rem;
  font-weight: 700;
}

.form-header p {
  color: var(--text-light);
  font-size: clamp(0.95rem, 2vw, 1.08rem);
}

/* FORM STYLING */
.form-group {
  margin-bottom: 2rem;
}

label {
  font-weight: 700;
  display: block;
  color: var(--cyprus);
  margin-bottom: 0.9rem;
  font-size: 0.98rem;
  letter-spacing: 0.3px;
}

.required {
  color: var(--accent-gold);
}

input, select, textarea {
  width: 100%;
  padding: 1rem 1.2rem;
  border-radius: 14px;
  border: 2px solid var(--sand-dark);
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

textarea {
  min-height: 130px;
  resize: vertical;
}

select {
  cursor: pointer;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23004643' d='M10.293 3.293L6 7.586 1.707 3.293A1 1 0 00.293 4.707l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  padding-right: 2.5rem;
}

/* FILE INPUT */
input[type="file"] {
  padding: 0.8rem;
  cursor: pointer;
  background: white;
}

input[type="file"]::file-selector-button {
  padding: 0.6rem 1.5rem;
  border: none;
  background: var(--gradient-accent);
  color: var(--cyprus-dark);
  border-radius: 50px;
  cursor: pointer;
  font-weight: 700;
  margin-right: 1rem;
  transition: all 0.3s ease;
  font-size: 0.9rem;
}

input[type="file"]::file-selector-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 16px rgba(201, 169, 97, 0.3);
}

.note {
  font-size: 0.85rem;
  color: var(--text-light);
  margin-top: 0.5rem;
  font-style: italic;
  line-height: 1.5;
}

/* SUBMIT BUTTON */
.submit-btn {
  margin-top: 2.5rem;
  width: 100%;
  padding: 1.3rem;
  background: var(--gradient-primary);
  color: white;
  border: none;
  border-radius: 50px;
  font-size: clamp(1rem, 2vw, 1.15rem);
  font-weight: 700;
  cursor: pointer;
  transition: all 0.4s ease;
  box-shadow: 0 8px 28px rgba(0, 70, 67, 0.28);
  letter-spacing: 0.8px;
}

.submit-btn:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 36px rgba(0, 70, 67, 0.38);
}

.submit-btn:active {
  transform: translateY(0);
}

.submit-btn i {
  margin-right: 0.8rem;
}

/* FOOTER */
footer {
  background: var(--cyprus-dark);
  color: rgba(255, 255, 255, 0.85);
  padding: 3rem 1.5rem;
  text-align: center;
  margin-top: 4rem;
}

footer p {
  margin: 0.6rem 0;
  font-size: 1rem;
}

.footer-logo {
  font-family: 'Playfair Display', serif;
  font-size: 1.5rem;
  margin-bottom: 0.5rem;
}

.footer-logo span {
  color: var(--accent-gold);
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .back-button {
    width: 45px;
    height: 45px;
    top: 15px;
    left: 15px;
    font-size: 1.1rem;
  }

  .hero {
    padding: 5rem 1.5rem 3.5rem;
  }

  .form-box {
    margin-top: -2rem;
    border-radius: 24px;
  }

  .form-header {
    margin-bottom: 2rem;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  input, select, textarea {
    padding: 0.9rem 1rem;
    font-size: 16px; /* Prevents zoom on iOS */
  }

  textarea {
    min-height: 120px;
  }
}

@media (max-width: 480px) {
  .back-button {
    width: 40px;
    height: 40px;
    top: 12px;
    left: 12px;
    font-size: 1rem;
  }

  .hero {
    padding: 4.5rem 1rem 3rem;
  }

  .form-box {
    padding: 2rem 1.5rem;
    margin-top: -1.5rem;
    border-radius: 20px;
  }

  input[type="file"]::file-selector-button {
    padding: 0.5rem 1.2rem;
    font-size: 0.85rem;
    margin-right: 0.5rem;
  }

  .submit-btn {
    padding: 1.2rem;
    margin-top: 2rem;
  }

  footer {
    padding: 2.5rem 1rem;
  }
}

@media (max-width: 360px) {
  .form-box {
    padding: 1.5rem 1rem;
  }

  input[type="file"] {
    font-size: 0.85rem;
  }
}
</style>
</head>

<body>

<a href="index.php" class="back-button" title="Back to Home">
  <i class="fas fa-arrow-left"></i>
</a>

<section class="hero">
  <h1>Commission Your Masterpiece</h1>
  <p>Share your vision and let us craft a bespoke creation that exceeds your expectations</p>
</section>

<main>
  <div class="form-box">
    <div class="form-header">
      <h2>Custom Order Request</h2>
      <p>Every detail matters. Tell us about your dream creation.</p>
    </div>

    <form action="../order_submit.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

      <div class="form-group">
        <label for="name">Full Name <span class="required">*</span></label>
        <input type="text"
               id="name"
               name="name"
               maxlength="60"
               placeholder="Enter your full name"
               required>
      </div>

      <div class="form-group">
        <label for="whatsapp">WhatsApp Number <span class="required">*</span></label>
        <input type="tel"
               id="whatsapp"
               name="whatsapp"
               placeholder="03XXXXXXXXX"
               maxlength="11"
               inputmode="numeric"
               pattern="^03[0-9]{9}$"
               required>
        <div class="note">Format: 03XXXXXXXXX (11 digits starting with 03)</div>
      </div>

      <div class="form-group">
        <label for="category">Creation Category <span class="required">*</span></label>
        <select id="category" name="category" required>
          <option value="">Select your desired creation</option>
          <option value="Custom Cake">Custom Artisan Cake</option>
          <option value="Balloon Decoration">Balloon Artistry & Decoration</option>
          <option value="Custom Bouquet">Bespoke Floral Bouquet</option>
        </select>
      </div>

      <div class="form-group">
        <label for="details">Design Details & Specifications</label>
        <textarea id="details"
                  name="details"
                  placeholder="Describe your vision: size, flavors, colors, theme, occasion, special requirements..."></textarea>
        <div class="note">The more details you provide, the better we can bring your vision to life</div>
      </div>

      <div class="form-group">
        <label for="image">Reference Image (Optional)</label>
        <input type="file"
               id="image"
               name="image"
               accept="image/jpeg, image/png">
        <div class="note">Upload inspiration images (Max 2MB, JPG/PNG only)</div>
      </div>

      <div class="form-group">
        <label for="event_date">Event Date (Optional)</label>
        <input type="date"
               id="event_date"
               name="event_date">
        <div class="note">When do you need your creation? (48 hours advance notice required)</div>
      </div>

      <button type="submit" class="submit-btn">
        <i class="fas fa-paper-plane"></i> Submit Your Commission
      </button>
    </form>
  </div>
</main>

<footer>
  <p class="footer-logo">Custom <span>Creations</span></p>
  <p>&copy; 2025 Custom Creations. All rights reserved.</p>
</footer>

<script>
// Allow numbers only while typing
document.getElementById("whatsapp").addEventListener("input", function () {
  this.value = this.value.replace(/[^0-9]/g, "");
});

function validateForm() {
  const name = document.getElementById("name").value.trim();
  const phone = document.getElementById("whatsapp").value.trim();
  const category = document.getElementById("category").value;

  if (name === "" || phone === "" || category === "") {
    alert("Please fill all required fields (marked with *)");
    return false;
  }

  if (!/^03[0-9]{9}$/.test(phone)) {
    alert("WhatsApp number must be exactly 11 digits and start with 03.\nExample: 03001234567");
    return false;
  }

  const fileInput = document.getElementById("image");
  if (fileInput.files.length > 0) {
    const fileSize = fileInput.files[0].size / 1024 / 1024;
    if (fileSize > 2) {
      alert("Image file size must be under 2MB. Please choose a smaller file.");
      return false;
    }
  }

  return true;
}

// Set minimum date to tomorrow
const dateInput = document.getElementById("event_date");
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 2);
dateInput.min = tomorrow.toISOString().split('T')[0];
</script>

</body>
</html>