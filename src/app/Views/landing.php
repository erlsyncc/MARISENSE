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
  margin-top:15px;
  margin-bottom: 1px;
}

.hero p {
  font-size:1.2rem;
  margin-top:10px;
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
.highlight-brand {
  color: #48cae4; /* main color from button */
  font-weight: 700;
  position: relative;
}

/* subtle glow lang */
.highlight-brand::after {
  content: "MARISENSE";
  position: absolute;
  left: 0;
  top: 0;
  color: #0077b6;
  opacity: 0.25;
  filter: blur(6px);
  z-index: -1;
}

.scroll-cue {
  position: absolute;
  left: 50%;
  bottom: 26px;
  transform: translateX(-50%);
  z-index: 12;
  display: inline-flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  color: rgba(255, 255, 255, 0.85);
  text-decoration: none;
  font-size: 0.78rem;
  letter-spacing: 1.4px;
  text-transform: uppercase;
}

.scroll-cue .scroll-arrow {
  width: 34px;
  height: 34px;
  border: 1px solid rgba(255, 255, 255, 0.45);
  border-radius: 999px;
  display: grid;
  place-items: center;
  background: rgba(255, 255, 255, 0.08);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.16);
  animation: floatDown 1.8s ease-in-out infinite;
}

.scroll-cue .scroll-arrow::before {
  content: "↓";
  font-size: 0.95rem;
  line-height: 1;
}

@keyframes floatDown {
  0%, 100% { transform: translateY(0); opacity: 0.82; }
  50% { transform: translateY(5px); opacity: 1; }
}

/* ===== KEYFRAMES ===== */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(24px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes slideInLeft {
  from { opacity: 0; transform: translateX(-16px); }
  to { opacity: 1; transform: translateX(0); }
}

@keyframes slideInRight {
  from { opacity: 0; transform: translateX(16px); }
  to { opacity: 1; transform: translateX(0); }
}

@keyframes liftUp {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-4px); }
}

@keyframes shimmerWave {
  0% { background-position: -1000px 0; }
  100% { background-position: 1000px 0; }
}

/* ===== LANDING SNAPSHOT ===== */
.landing-snapshot {
  padding: 86px 0 108px;
  background: linear-gradient(180deg, 
    rgba(240,248,255,0) 0%, 
    rgba(72, 202, 228, 0.06) 25%,
    rgba(0, 119, 182, 0.03) 50%,
    rgba(240,248,255,0.95) 100%);
  position: relative;
}

.landing-snapshot::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(72, 202, 228, 0.4), transparent);
}

.snapshot-card {
  position: relative;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.96);
  border: 1px solid rgba(10, 88, 114, 0.1);
  border-radius: 28px;
  padding: 30px;
  box-shadow: 0 20px 45px rgba(5, 44, 57, 0.08);
  height: 100%;
  animation: fadeUp 0.6s ease-out both;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.snapshot-card:hover {
  transform: translateY(-12px);
  box-shadow: 0 40px 80px rgba(5, 44, 57, 0.18), 
              0 0 30px rgba(72, 202, 228, 0.18);
  border-color: rgba(72, 202, 228, 0.3);
  background: rgba(255, 255, 255, 0.98);
}

.col-lg-4:nth-child(1) .snapshot-card { animation-delay: 0.1s; }
.col-lg-4:nth-child(2) .snapshot-card { animation-delay: 0.2s; }
.col-lg-4:nth-child(3) .snapshot-card { animation-delay: 0.3s; }

.snapshot-card::before {
  content: "";
  position: absolute;
  inset: 0 auto auto 0;
  width: 100%;
  height: 6px;
  background: linear-gradient(90deg, #48cae4, #0077b6, #048fb9);
  transform-origin: left;
  animation: slideInLeft 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) both;
  animation-delay: 0.2s;
}

.section-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 7px 12px;
  border-radius: 999px;
  background: linear-gradient(135deg, rgba(72, 202, 228, 0.15), rgba(0, 119, 182, 0.08));
  border: 1px solid rgba(72, 202, 228, 0.2);
  font-size: 0.7rem;
  letter-spacing: 1.8px;
  text-transform: uppercase;
  color: #0a5872;
  font-weight: 700;
  margin-bottom: 12px;
  animation: slideInLeft 0.6s ease-out both;
  animation-delay: 0.1s;
}

.col-lg-4:nth-child(1) .section-label { color: #0a5872; border-color: rgba(72, 202, 228, 0.3); }
.col-lg-4:nth-child(2) .section-label { color: #0a5872; border-color: rgba(72, 202, 228, 0.3); }
.col-lg-4:nth-child(3) .section-label { color: #0a5872; border-color: rgba(72, 202, 228, 0.3); }

.snapshot-card h2 {
  font-size: 1.35rem;
  margin-bottom: 10px;
  color: #052c39;
  font-weight: 700;
  animation: slideInLeft 0.6s ease-out both;
  animation-delay: 0.15s;
}

.col-lg-4:nth-child(1) .snapshot-card h2 { color: #0a5872; }
.col-lg-4:nth-child(2) .snapshot-card h2 { color: #052c39; }
.col-lg-4:nth-child(3) .snapshot-card h2 { color: #048fb9; }

.snapshot-card p {
  color: rgba(5, 44, 57, 0.72);
  line-height: 1.7;
  margin-bottom: 0;
}

.snapshot-note {
  margin-top: 16px;
  font-size: 0.92rem;
  color: rgba(5, 44, 57, 0.6);
  line-height: 1.6;
  animation: slideInLeft 0.6s ease-out both;
  animation-delay: 0.2s;
}

.price-list {
  margin-top: 18px;
  border-top: 2px solid rgba(72, 202, 228, 0.15);
  padding-top: 16px;
}

.price-row {
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  gap: 16px;
  padding: 14px 12px;
  border-radius: 10px;
  margin-bottom: 6px;
  animation: slideInRight 0.5s ease-out both;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  background: rgba(72, 202, 228, 0.02);
}

.price-row:hover {
  background: linear-gradient(90deg, rgba(72, 202, 228, 0.12), rgba(72, 202, 228, 0.04));
  border-left: 3px solid #48cae4;
  padding-left: 14px;
}

.price-row:nth-child(1) { animation-delay: 0.25s; }
.price-row:nth-child(2) { animation-delay: 0.3s; }
.price-row:nth-child(3) { animation-delay: 0.35s; }
.price-row:nth-child(4) { animation-delay: 0.4s; }

.price-row span {
  font-weight: 600;
  color: #052c39;
}

.price-row strong {
  color: #048fb9;
  font-size: 1rem;
  white-space: nowrap;
  font-weight: 700;
}

.price-row small {
  color: rgba(5, 44, 57, 0.52);
  font-weight: 500;
}

.sea-pill {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 10px 16px;
  border-radius: 999px;
  font-weight: 700;
  font-size: 0.82rem;
  margin: 12px 0 18px;
  animation: slideInLeft 0.6s ease-out both;
  animation-delay: 0.25s;
  position: relative;
  letter-spacing: 0.3px;
  border: 1.5px solid;
}

.sea-pill::before {
  content: "●";
  font-size: 0.5rem;
  animation: pulse 2.2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  display: inline-block;
}

.sea-pill.sea-safe {
  background: linear-gradient(135deg, rgba(40, 167, 69, 0.15), rgba(40, 167, 69, 0.08));
  color: #1f7a3f;
  border-color: rgba(40, 167, 69, 0.35);
}

.sea-pill.sea-moderate {
  background: linear-gradient(135deg, rgba(255, 193, 7, 0.18), rgba(255, 193, 7, 0.1));
  color: #a57c00;
  border-color: rgba(255, 193, 7, 0.4);
}

.sea-pill.sea-unsafe {
  background: linear-gradient(135deg, rgba(220, 53, 69, 0.15), rgba(220, 53, 69, 0.08));
  color: #b02a37;
  border-color: rgba(220, 53, 69, 0.35);
}

@keyframes pulse {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.4); opacity: 0.6; }
}

.metric-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
  margin-top: 24px;
  background: linear-gradient(135deg, rgba(72, 202, 228, 0.08), rgba(72, 202, 228, 0.02));
  padding: 16px;
  border-radius: 16px;
  border: 1px solid rgba(72, 202, 228, 0.12);
}

.metric {
  background: linear-gradient(180deg, #fafcfe 0%, #f3f8fc 100%);
  border-radius: 16px;
  padding: 18px 12px;
  text-align: center;
  border: 1.5px solid rgba(72, 202, 228, 0.15);
  animation: fadeUp 0.6s ease-out both;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.metric::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(72, 202, 228, 0.1), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.metric:hover {
  transform: translateY(-6px);
  background: linear-gradient(180deg, #f0f9fd 0%, #e0f4fb 100%);
  border-color: rgba(72, 202, 228, 0.35);
  box-shadow: 0 12px 28px rgba(72, 202, 228, 0.15);
}

.metric:hover::before {
  opacity: 1;
}

.metric:nth-child(1) { animation-delay: 0.3s; }
.metric:nth-child(2) { animation-delay: 0.35s; }
.metric:nth-child(3) { animation-delay: 0.4s; }

.metric span {
  display: block;
  font-size: 0.68rem;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  color: #0a5872;
  margin-bottom: 8px;
  font-weight: 700;
}

.metric strong {
  color: #048fb9;
  font-size: 1.1rem;
  font-weight: 700;
}

@media (max-width: 767px) {
  .scroll-cue {
    bottom: 18px;
    font-size: 0.68rem;
  }

  .metric-grid {
    grid-template-columns: 1fr;
  }

  .snapshot-card {
    padding: 24px;
  }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
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

  <a href="#landing-snapshot" class="scroll-cue" aria-label="Scroll to more content">
    <span class="scroll-arrow"></span>
    <span>More below</span>
  </a>

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

<section class="landing-snapshot" id="landing-snapshot">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <div class="snapshot-card">
          <span class="section-label">About</span>
          <h2>Smart booking, safer seas.</h2>
          <p>Waves Water Sports brings water adventures at Matabungkay Beach with real-time safety monitoring powered by MARISENSE.</p>
          <p class="snapshot-note">Plan the day, check conditions, then book with confidence.</p>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="snapshot-card">
          <span class="section-label">Prices</span>
          <h2>Simple rates</h2>
          <?php if (! empty($featuredActivities)): ?>
            <div class="price-list">
              <?php foreach ($featuredActivities as $activity): ?>
                <?php
                  $price = number_format((float) ($activity['price'] ?? 0), 2);
                  $suffix = (($activity['price_type'] ?? 'flat') === 'per_person') ? '/ person' : '/ session';
                ?>
                <div class="price-row">
                  <span><?= esc($activity['name']) ?></span>
                  <strong>₱<?= $price ?> <small><?= $suffix ?></small></strong>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p>Pricing details will appear here once activities are loaded.</p>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="snapshot-card">
          <span class="section-label">Sea Conditions</span>
          <h2>Current marine snapshot</h2>
          <?php if ($seaSnapshot): ?>
            <div class="sea-pill <?= esc($seaSnapshot['class']) ?>">
              <?= esc($seaSnapshot['label']) ?>
            </div>
            <p><?= esc($seaSnapshot['note']) ?></p>
            <div class="metric-grid">
              <div class="metric">
                <span>Wind</span>
                <strong><?= esc($seaSnapshot['wind']) ?></strong>
              </div>
              <div class="metric">
                <span>Wave</span>
                <strong><?= esc($seaSnapshot['wave']) ?></strong>
              </div>
              <div class="metric">
                <span>Temp</span>
                <strong><?= esc($seaSnapshot['temp']) ?></strong>
              </div>
            </div>
            <p class="snapshot-note">Updated <?= esc($seaSnapshot['updated']) ?></p>
          <?php else: ?>
            <p>No buoy reading available yet.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <a href="<?= base_url('login') ?>" class="btn btn-ocean">Login to Continue</a>
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
