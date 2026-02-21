<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waves Water Sports | Matabungkay, Lian, Batangas</title>

  <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body {
  font-family: 'Poppins', sans-serif;
  margin:0;
  overflow-x:hidden;
  /* Soft blue background to compliment the ocean theme */
  background: #f0f8ff; 
}

/* ===== HERO SECTION ===== */
.hero {
  height:100vh;
  background:
    linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.6)),
    url('<?= base_url("images/cover.png") ?>') center/cover no-repeat;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  color:white;
  position:relative;
  overflow: hidden;
}

@keyframes fadeIn {
  from {opacity:0; transform:translateY(30px);}
  to {opacity:1; transform:translateY(0);}
}

.hero-content {
  animation: fadeIn 1.5s ease;
  position: relative;
  z-index: 10;
}

.hero h1 {
  font-size:3.8rem;
  font-weight:700;
  letter-spacing:1px;
}

.hero p {
  font-size:1.2rem;
  margin-top:15px;
  opacity:0.9;
}

.small-caption {
  font-size: 0.75rem; /* Smallest readable font */
  opacity: 0.7;
  font-weight: 300;
  letter-spacing: 0.5px;
  margin-top: 10px;
}

/* Button */
.btn-ocean {
  background: linear-gradient(45deg,#48cae4,#0077b6);
  border:none;
  color:white;
  padding: 12px 60px; /* Wider button for a premium feel */
  font-size: 1.1rem;
  border-radius:50px;
  margin-top: 8px; /* Reduced from 30px to move it up */
  font-weight:600;
  transition:0.3s;
  position: relative;
  z-index: 11;
  text-decoration: none;
  display: inline-block;

}

.btn-ocean:hover {
  transform: scale(1.08);
  box-shadow:0 10px 25px rgba(0,140,200,0.5);
  color: white;
}

/* ===== ANIMATED WAVE SYSTEM ===== */
.wave-wrapper {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 150px;
  min-height: 100px;
  z-index: 1;
}

.waves {
  position: relative;
  width: 100%;
  height: 100%;
  margin-bottom: -7px;
}

.parallax > use {
  animation: move-forever 25s cubic-bezier(.55,.5,.45,.5) infinite;
}

.parallax > use:nth-child(1) { animation-delay: -2s; animation-duration: 7s; }
.parallax > use:nth-child(2) { animation-delay: -3s; animation-duration: 10s; }
.parallax > use:nth-child(3) { animation-delay: -4s; animation-duration: 13s; }
.parallax > use:nth-child(4) { animation-delay: -5s; animation-duration: 20s; }

@keyframes move-forever {
  0% { transform: translate3d(-90px, 0, 0); }
  100% { transform: translate3d(85px, 0, 0); }
}

/* ===== FEATURES SECTION ===== */
.features {
  padding:90px 0;
  background: linear-gradient(to bottom, #0a5872, #063d4f); 
  color: white;
}

.feature-box {
  background: rgba(255,255,255,0.95);
  padding:30px;
  border-radius:20px;
  transition:0.3s;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  color: #333;
  height: 100%;
}

.feature-box:hover {
  transform:translateY(-10px);
}

/* ===== ABOUT SECTION ===== */
/* ===== ABOUT SECTION (Mid-Deep Blue) ===== */
.about-section {
  padding: 90px 0;
  /* Transitional deep blue */
  background: linear-gradient(to bottom, #063d4f, #042e3c); 
  color: #ffffff; 
}

.commitment-item {
  /* Subtle glass effect */
  background: rgba(255, 255, 255, 0.07); 
  backdrop-filter: blur(8px);
  padding: 20px;
  border-radius: 15px;
  border-left: 5px solid #48cae4;
  margin-bottom: 15px;
  transition: transform 0.3s ease;
  color: #ffffff;
}

.commitment-item:hover {
  transform: translateX(10px);
  background: rgba(255, 255, 255, 0.12);
}

.commitment-item strong {
  color: #48cae4; 
}

/* ===== COMPLIMENTARY DARK BLUE FOOTER ===== */
.footer {
  /* Midnight Navy: A deeper shade of your about section blue */
  background: #031b24; 
  color: #d1e3e9;
  padding: 60px 0 30px;
  text-align: center;
  /* Subtle top border to define the section without being harsh */
  border-top: 1px solid rgba(72, 202, 228, 0.2); 
}

.footer strong {
  color: #ffffff;
}

.footer hr {
  border-color: rgba(255, 255, 255, 0.1);
  width: 50%;
  margin: 20px auto;
}

.highlight-brand {
    font-weight: 700;
    color: #48cae4; /* Matches your accent cyan */
    text-shadow: 0 0 10px rgba(72, 202, 228, 0.4);
    letter-spacing: 1px;
}
</style>
</head>

<body>

<section class="hero">
  <div class="hero-content container">
    <h1>Waves Water Sports</h1>
    <p>Smart Water Adventure Booking with Real-Time Safety Monitoring 
       Powered by <span class="highlight-brand">MARISENSE</span>
    </p>
    
    <a href="<?= base_url('login') ?>" class="btn btn-ocean">
      Login to Continue
    </a>
  </div>

  <div class="wave-wrapper">
    <svg class="waves" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs><path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" /></defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(10, 88, 114, 0.7)" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(10, 88, 114, 0.5)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(10, 88, 114, 0.3)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="#0a5872" />
      </g>
    </svg>
  </div>
</section>

<section class="features text-center">
  <div class="container">
    <h2 class="mb-5 fw-bold text-uppercase" style="letter-spacing: 2px;">Experience the Sea</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-box">
          <h5 class="fw-bold">Water Activities</h5>
          <p>Jet Ski, Banana Boat, Kayaking and exciting ocean adventures.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <h5 class="fw-bold">Easy Online Booking</h5>
          <p>Reserve your preferred schedule anytime with our smart system.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <h5 class="fw-bold">Safe & Monitored</h5>
          <p>Real-time water condition monitoring for your safety.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="about-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <h2 class="fw-bold mb-4">About Us</h2>
        <p><strong>Waves Water Sports</strong> is a premier leisure and adventure provider located in Matabungkay, Lian, Batangas. We specialize in safe, thrilling, and memorable water experiences for families, friends, and solo adventurers.</p>
        <p>Our mission is to combine fun, safety, and convenience using smart technology to monitor water conditions in real-time while offering easy online booking. Whether you’re into jet skiing, banana boating, or kayaking, every visit is enjoyable and secure.</p>
      </div>
      <div class="col-lg-6">
        <h4 class="fw-bold mb-4">Our Commitments</h4>
        <div class="commitment-item">
          <strong>Safety First:</strong> Real-time monitoring to ensure guest safety.
        </div>
        <div class="commitment-item">
          <strong>Customer Convenience:</strong> Hassle-free online booking.
        </div>
        <div class="commitment-item">
          <strong>Memorable Experiences:</strong> Fun, unforgettable moments on the water.
        </div>
        <div class="commitment-item">
          <strong>Sustainable Practices:</strong> Preserving Matabungkay Beach for future generations.
        </div>
      </div>
    </div>
  </div>
</section>

<section class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p class="mb-2"><strong>Location:</strong> Matabungkay, Lian, Batangas</p>
        <p class="mb-2"><strong>Email:</strong> waveswatersports@email.com</p>
        <p class="mb-4"><strong>Contact:</strong> 09XX-XXX-XXXX</p>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <p class="mt-4 opacity-75">© 2026 Waves Water Sports | All Rights Reserved</p>
      </div>
    </div>
  </div>
</section>

<script src="<?= base_url('bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>

<script>
  const waveLayers = document.querySelectorAll('.parallax > use');
  
  document.addEventListener('mousemove', (e) => {
    let moveX = (e.clientX / window.innerWidth);
    
    waveLayers.forEach((wave, index) => {
      let shift = (moveX * 20) * (index + 1);
      wave.style.transform = `translateX(${shift}px)`;
      
      let baseSpeed = 20 - (index * 4);
      let dynamicSpeed = baseSpeed + (moveX * 10);
      wave.style.animationDuration = `${dynamicSpeed}s`;
    });
  });
</script>

</body>
</html>