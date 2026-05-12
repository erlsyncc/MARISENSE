<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waves Water Sports | Matabungkay, Lian, Batangas</title>
  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ===== GLOBAL ===== */
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  overflow-x: hidden;
  /* Binago: Ginawang Ocean Gradient para tumugma sa dashboard */
  background: linear-gradient(180deg, #0a5872 0%, #052c39 100%);
  background-attachment: fixed;
  color: white;
}

/* ===== HERO ===== */
.hero {
  height: 100vh;
  background:
    linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.6)),
    url('<?= base_url("images/cover.png") ?>') center/cover no-repeat;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: white;
  position: relative;
  overflow: hidden;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}

.hero-content {
  animation: fadeIn 1.5s ease;
  position: relative;
  z-index: 10;
}

.hero h1 {
  font-size: 3.8rem;
  font-weight: 700;
  letter-spacing: 1px;
  margin-top: 15px;
  margin-bottom: 1px;
}

.hero p {
  font-size: 1.2rem;
  margin-top: 10px;
  opacity: 0.9;
}

.highlight-brand {
  color: #48cae4;
  font-weight: 700;
  position: relative;
}

.highlight-brand::after {
  content: "MARISENSE";
  position: absolute;
  left: 0; top: 0;
  color: #0077b6;
  opacity: 0.25;
  filter: blur(6px);
  z-index: -1;
}

/* ===== BUTTON ===== */
.btn-ocean {
  background: linear-gradient(45deg, #48cae4, #0077b6);
  border: none;
  color: white;
  padding: 12px 60px;
  font-size: 1.1rem;
  border-radius: 50px;
  font-weight: 600;
  transition: 0.3s;
  position: relative;
  z-index: 11;
  text-decoration: none;
  display: inline-block;
}

.btn-ocean:hover {
  transform: scale(1.08);
  box-shadow: 0 10px 25px rgba(0,140,200,0.5);
  color: white;
}

/* ===== SCROLL CUE ===== */
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
  color: rgba(255,255,255,0.85);
  text-decoration: none;
  font-size: 0.78rem;
  letter-spacing: 1.4px;
  text-transform: uppercase;
}

.scroll-cue .scroll-arrow {
  width: 34px;
  height: 34px;
  border: 1px solid rgba(255,255,255,0.45);
  border-radius: 999px;
  display: grid;
  place-items: center;
  background: rgba(255,255,255,0.08);
  box-shadow: 0 8px 20px rgba(0,0,0,0.16);
  animation: floatDown 1.8s ease-in-out infinite;
}

.scroll-cue .scroll-arrow::before {
  content: "↓";
  font-size: 0.95rem;
  line-height: 1;
}

@keyframes floatDown {
  0%, 100% { transform: translateY(0);  opacity: 0.82; }
  50%       { transform: translateY(5px); opacity: 1; }
}

/* ===== ANIMATED WAVES ===== */
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
  0%   { transform: translate3d(-90px, 0, 0); }
  100% { transform: translate3d(85px, 0, 0); }
}

/* ===== LANDING SNAPSHOT ===== */
.landing-snapshot {
  padding: 80px 0 100px;
  background: transparent; /* Binura ang light blue bg */
  position: relative;
}

.landing-snapshot::before {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(72,202,228,0.4), transparent);
}

/* Section heading */
.snap-section-heading {
  text-align: center;
  margin-bottom: 52px;
}

.snap-section-heading .eyebrow {
  display: inline-block;
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  color: #048fb9;
  margin-bottom: 10px;
}

.snap-section-heading h2 {
  font-size: 2rem;
  font-weight: 700;
  color: #ffffff; /* Ginawang puti */
  margin: 0;
  line-height: 1.25;
}

.snap-section-heading h2 span {
  color: #048fb9;
}

/* Cards */
.snap-card {
  background: #ffffff;
  border-radius: 24px;
  border: 1px solid rgba(10,88,114,0.1);
  padding: 32px 28px 28px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 8px 32px rgba(5,44,57,0.07);
  height: 100%;
  transition: transform 0.28s ease, box-shadow 0.28s ease;
  animation: snapFadeUp 0.6s ease-out both;
}

.snap-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 28px 60px rgba(5,44,57,0.14);
}

.col-lg-4:nth-child(1) .snap-card { animation-delay: 0.1s; }
.col-lg-4:nth-child(2) .snap-card { animation-delay: 0.2s; }
.col-lg-4:nth-child(3) .snap-card { animation-delay: 0.3s; }

@keyframes snapFadeUp {
  from { opacity: 0; transform: translateY(24px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* Accent bar */
.snap-card::before {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 4px;
  background: linear-gradient(90deg, #48cae4, #0077b6);
  border-radius: 24px 24px 0 0;
}

/* Decorative background icon */
.card-bg-icon {
  position: absolute;
  bottom: -14px;
  right: -8px;
  font-size: 96px;
  color: rgba(72,202,228,0.07);
  line-height: 1;
  pointer-events: none;
}

/* Chip / label */
.snap-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 0.68rem;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #0a5872;
  background: rgba(72,202,228,0.13);
  border: 1px solid rgba(72,202,228,0.28);
  border-radius: 999px;
  padding: 5px 13px;
  margin-bottom: 16px;
}

.snap-chip i {
  font-size: 13px;
}

.snap-card h3 {
  font-size: 1.2rem;
  font-weight: 700;
  color: #052c39;
  margin: 0 0 8px;
}

.snap-card .snap-sub {
  font-size: 0.87rem;
  color: rgba(5,44,57,0.62);
  line-height: 1.7;
  margin: 0 0 20px;
}

/* ===== ABOUT CARD — feature list ===== */
.feature-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.feat-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.85rem;
  color: #052c39;
}

.feat-dot {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: rgba(72,202,228,0.14);
  display: grid;
  place-items: center;
  flex-shrink: 0;
  color: #048fb9;
  font-size: 15px;
}

/* ===== PRICES CARD ===== */
.price-divider {
  border: none;
  border-top: 1px solid rgba(10,88,114,0.08);
  margin: 0 0 16px;
}

.price-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 11px 0;
  border-bottom: 1px solid rgba(10,88,114,0.07);
  gap: 12px;
}

.price-row:last-child {
  border-bottom: none;
}

.price-row .pname {
  font-size: 0.88rem;
  font-weight: 600;
  color: #052c39;
}

.price-badge {
  background: linear-gradient(135deg, rgba(72,202,228,0.15), rgba(0,119,182,0.1));
  color: #0a5872;
  font-size: 0.8rem;
  font-weight: 700;
  padding: 4px 13px;
  border-radius: 999px;
  white-space: nowrap;
  border: 1px solid rgba(72,202,228,0.25);
}

/* ===== SEA CONDITIONS CARD ===== */
.sea-status-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.82rem;
  font-weight: 700;
  padding: 7px 16px;
  border-radius: 999px;
  margin-bottom: 14px;
  border: 1.5px solid;
}

.sea-safe {
  background: rgba(40,167,69,0.12);
  color: #1a6b30;
  border-color: rgba(40,167,69,0.3);
}

.sea-moderate {
  background: rgba(255,193,7,0.15);
  color: #8a6300;
  border-color: rgba(255,193,7,0.38);
}

.sea-unsafe {
  background: rgba(220,53,69,0.12);
  color: #9b2030;
  border-color: rgba(220,53,69,0.3);
}

.pulse-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  flex-shrink: 0;
  animation: pulseDot 2s ease-in-out infinite;
}

.sea-safe     .pulse-dot { background: #28a745; }
.sea-moderate .pulse-dot { background: #ffc107; }
.sea-unsafe   .pulse-dot { background: #dc3545; }

@keyframes pulseDot {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: 0.4; transform: scale(0.7); }
}

.metric-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
  margin-top: 18px;
}

.metric-box {
  background: linear-gradient(180deg, #f4fbfe 0%, #eaf7fc 100%);
  border: 1px solid rgba(72,202,228,0.18);
  border-radius: 14px;
  padding: 14px 8px;
  text-align: center;
  transition: transform 0.22s ease, box-shadow 0.22s ease;
}

.metric-box:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 24px rgba(72,202,228,0.15);
}

.metric-box .mlabel {
  display: block;
  font-size: 0.62rem;
  font-weight: 700;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  color: #0a5872;
  margin-bottom: 6px;
}

.metric-box .mval {
  display: block;
  font-size: 1rem;
  font-weight: 700;
  color: #048fb9;
}

.updated-note {
  font-size: 0.75rem;
  color: rgba(5,44,57,0.45);
  margin-top: 14px;
  display: flex;
  align-items: center;
  gap: 5px;
}

/* ===== CTA ===== */
.snap-cta {
  text-align: center;
  margin-top: 52px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 767px) {
  .hero h1 { font-size: 2.4rem; }
  .snap-section-heading h2 { font-size: 1.5rem; }
  .metric-row { grid-template-columns: 1fr; }
  .snap-card { padding: 26px 20px 22px; }
  .scroll-cue { bottom: 18px; font-size: 0.68rem; }
}

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
/* --- SCREENSHOT-MATCHED FOOTER --- */
footer { background: #052c39; padding: 100px 0 40px 0; color: rgba(255,255,255,0.6) !important; border-top: 1px solid rgba(255,255,255,0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
.footer-inquiry-text { font-size: 0.95rem; margin-bottom: 15px; color: rgba(255,255,255,0.6); letter-spacing: 0.3px; }
.social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
.social-icons a { color: #f4f9fc; font-size: 1.5rem; transition: 0.3s ease; text-decoration: none; }
.social-icons a:hover { color: #48cae4; transform: scale(1.2); }
.copyright-text { font-size: 0.85rem; color: rgba(255,255,255,0.5); margin-top: 5px; }
.tech-by { color: #48cae4; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
</style>
</head>

<body>

<!-- ===== HERO ===== -->
<section class="hero">
  <div class="hero-content container">
    <h1>Waves Water Sports</h1>
    <p>Smart Water Adventure Booking with Real-Time Safety Monitoring
       Powered by <span class="highlight-brand">MARISENSE</span>
    </p>
  </div>

  <a href="#landing-snapshot" class="scroll-cue" aria-label="Scroll to more content">
    <span class="scroll-arrow"></span>
    <span>More below</span>
  </a>

  <div class="wave-wrapper">
    <svg class="waves" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
      </defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(10,88,114,0.7)" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(10,88,114,0.5)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(10,88,114,0.3)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="#0a5872" />
      </g>
    </svg>
  </div>
</section>

<!-- ===== LANDING SNAPSHOT ===== -->
<section class="landing-snapshot" id="landing-snapshot">
  <div class="container">

    <!-- Section heading -->
    <div class="snap-section-heading">
      <span class="eyebrow">Discover Matabungkay</span>
      <h2>Everything you need to <span>dive in</span></h2>
    </div>

    <div class="row g-4">

      <!-- ABOUT CARD -->
      <div class="col-lg-4">
        <div class="snap-card">
          <i class="ti ti-wave-sine card-bg-icon" aria-hidden="true"></i>
          <span class="snap-chip">
            <i class="ti ti-info-circle" aria-hidden="true"></i> About
          </span>
          <h3>Smart booking, safer seas.</h3>
          <p class="snap-sub">Waves Water Sports brings water adventures at Matabungkay Beach with real-time safety monitoring powered by MARISENSE.</p>
          <div class="feature-list">
            <div class="feat-item">
              <div class="feat-dot"><i class="ti ti-calendar-check" aria-hidden="true"></i></div>
              Real-time activity booking
            </div>
            <div class="feat-item">
              <div class="feat-dot"><i class="ti ti-radar" aria-hidden="true"></i></div>
              Live marine safety monitoring
            </div>
            <div class="feat-item">
              <div class="feat-dot"><i class="ti ti-map-pin" aria-hidden="true"></i></div>
              Matabungkay Beach, Lian, Batangas
            </div>
          </div>
        </div>
      </div>

      <!-- PRICES CARD -->
      <div class="col-lg-4">
        <div class="snap-card">
          <i class="ti ti-tag card-bg-icon" aria-hidden="true"></i>
          <span class="snap-chip">
            <i class="ti ti-cash" aria-hidden="true"></i> Rates
          </span>
          <h3>Simple, transparent pricing</h3>
          <p class="snap-sub">No hidden fees — what you see is what you pay.</p>

          <?php if (!empty($featuredActivities)): ?>
            <hr class="price-divider">
            <?php foreach ($featuredActivities as $activity): ?>
              <?php
                $price  = number_format((float)($activity['price'] ?? 0), 2);
                $suffix = (($activity['price_type'] ?? 'flat') === 'per_person') ? '/ person' : '/ session';
              ?>
              <div class="price-row">
                <span class="pname"><?= esc($activity['name']) ?></span>
                <span class="price-badge">₱<?= $price ?> <small><?= $suffix ?></small></span>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="snap-sub">Pricing details will appear here once activities are loaded.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- SEA CONDITIONS CARD -->
      <div class="col-lg-4">
        <div class="snap-card">
          <i class="ti ti-droplet card-bg-icon" aria-hidden="true"></i>
          <span class="snap-chip">
            <i class="ti ti-antenna" aria-hidden="true"></i> Conditions
          </span>
          <h3>Current marine snapshot</h3>

          <?php if ($seaSnapshot): ?>
            <div class="sea-status-pill <?= esc($seaSnapshot['class']) ?>">
              <span class="pulse-dot"></span>
              <?= esc($seaSnapshot['label']) ?>
            </div>
            <p class="snap-sub" style="margin-bottom:0"><?= esc($seaSnapshot['note']) ?></p>
            <div class="metric-row">
              <div class="metric-box">
                <span class="mlabel">Wind</span>
                <span class="mval"><?= esc($seaSnapshot['wind']) ?></span>
              </div>
              <div class="metric-box">
                <span class="mlabel">Wave</span>
                <span class="mval"><?= esc($seaSnapshot['wave']) ?></span>
              </div>
              <div class="metric-box">
                <span class="mlabel">Temp</span>
                <span class="mval"><?= esc($seaSnapshot['temp']) ?></span>
              </div>
            </div>
            <p class="updated-note">
              <i class="ti ti-clock" aria-hidden="true"></i>
              Updated <?= esc($seaSnapshot['updated']) ?>
            </p>
          <?php else: ?>
            <p class="snap-sub">No buoy reading available yet.</p>
          <?php endif; ?>
        </div>
      </div>

    </div><!-- /.row -->

    <!-- Bottom CTA -->
    <div class="snap-cta">
      <a href="<?= base_url('login') ?>" class="btn btn-ocean">Login to Continue</a>
    </div>

  </div><!-- /.container -->
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const waveLayers = document.querySelectorAll('.parallax > use');
  document.addEventListener('mousemove', (e) => {
    const moveX = e.clientX / window.innerWidth;
    waveLayers.forEach((wave, index) => {
      wave.style.transform = `translateX(${moveX * 20 * (index + 1)}px)`;
      const baseSpeed = 20 - (index * 4);
      wave.style.animationDuration = `${baseSpeed + (moveX * 10)}s`;
    });
  });
</script>

<!-- ========== FOOTER ========== -->
<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text">
            For inquiries, message us through our social media platforms.
        </div>

        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100077368436521" target="_blank" title="Facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://instagram.com" target="_blank" title="Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://twitter.com" target="_blank" title="Twitter">
                <i class="fa-brands fa-twitter"></i>
            </a>
        </div>

        <div class="copyright-text">
            &copy; 2026 Waves Water Sports | Tech by 
            <span class="tech-by">MARISENSE</span>
        </div>
    </div>
</footer>
</body>
</html>