<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {--deep-blue: #052c39;--ocean-blue: #0a5872;--accent-cyan: #48cae4;--soft-white: #f4f9fc;--safe-green: #2ecc71;}
        .highlight-brand {font-weight: 700;color: #48cae4;text-shadow: 0 0 10px rgba(72, 202, 228, 0.4);letter-spacing: 1px;}
        body {font-family: 'Poppins', sans-serif;background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%);background-attachment: fixed;color: var(--soft-white);margin: 0;}

        /* --- NAVBAR --- */
        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; gap: 10px; align-items: center; }
        .nav-link-custom { color: rgba(255,255,255,0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255,255,255,0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255,107,107,0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }

        /* ============================================================
           NEW: HELP BUTTON STYLE
           ============================================================ */
        .btn-help-custom {
            color: #48cae4;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 18px;
            border: 1px solid rgba(72,202,228,0.5);
            border-radius: 50px;
            background: rgba(72,202,228,0.08);
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-help-custom:hover {
            background: rgba(72,202,228,0.2);
            border-color: var(--accent-cyan);
        }
        /* ============================================================ */

        /* --- HERO --- */
        .welcome-hero {
            background: linear-gradient(rgba(5,44,57,0.5), rgba(5,44,57,0.7)), url('<?= base_url('images/cover.png') ?>');
            background-size: cover; background-position: center; background-attachment: fixed;
            padding: 120px 40px; color: white; border-radius: 0 0 80px 80px; margin-bottom: 60px;
        }

        /* --- SECTION HEADER --- */
        .section-header { text-align: center; margin-bottom: 40px; }
        .title-line { height: 4px; width: 60px; background: var(--accent-cyan); margin: 10px auto; border-radius: 10px; }

        /* --- ACTIVITY CARDS --- */
        .activities-flex-container { display: flex; justify-content: center; gap: 20px; flex-wrap: nowrap; overflow-x: auto; padding: 20px 0; text-align: center; }
        .activity-box { flex: 1; min-width: 280px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 25px; overflow: hidden; transition: 0.4s ease; display: flex; flex-direction: column; }
        .activity-box:hover { transform: translateY(-10px); background: rgba(255,255,255,0.15); border-color: var(--accent-cyan); }
        .activity-img { height: 180px; background-size: cover; background-position: center; }
        .activity-box h2 { font-size: 1rem; margin-bottom: 10px; text-align: center; }
        .btn-view-details { display: inline-block; background: var(--accent-cyan); color: var(--deep-blue) !important; padding: 12px 40px; border-radius: 50px; font-weight: 600; font-size: 0.95rem; text-decoration: none; transition: 0.3s ease; box-shadow: 0 4px 15px rgba(72,202,228,0.3); }
        .btn-view-details:hover { background: white; transform: translateY(-3px) scale(1.02); box-shadow: 0 8px 20px rgba(255,255,255,0.2); }

        /* --- SEA CONDITIONS --- */
        .centered-data-wrapper { max-width: 800px; margin: 0 auto; }
        .sea-data-container { background: rgba(255,255,255,0.08); backdrop-filter: blur(15px); border-radius: 30px; padding: 40px; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
        .data-item { border-bottom: 1px solid rgba(255,255,255,0.1); padding: 20px 0; display: flex; justify-content: space-between; align-items: center; }
        .data-item:last-child { border-bottom: none; }
        .data-label { font-size: 1rem; font-weight: 500; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1.5px; }
        .data-value { font-weight: 700; font-size: 1.5rem; color: var(--accent-cyan); }

        /* --- BUTTONS --- */
        .btn-action { border-radius: 50px; padding: 12px 30px; font-weight: 600; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; border: none; display: inline-flex; align-items: center; background: #48cae4; }
        .btn-action:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important; filter: brightness(1.1); }
        .btn-action:active { transform: translateY(-1px); }

        h2, h5, .section-header h2 { color: white !important; }

        /* --- REVIEWS SECTION --- */
        .reviews-section { padding: 20px 0 60px; }
        .review-cards-wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px;
        }
        @media (max-width: 992px) { .review-cards-wrapper { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 600px) { .review-cards-wrapper { grid-template-columns: 1fr; } }

        .home-review-card {
            background: rgba(255,255,255,0.92);
            color: var(--deep-blue);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .home-review-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(0,0,0,0.35); }

        .review-card-photo {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .review-card-photo-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--deep-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(72,202,228,0.6);
        }

        .review-card-body { padding: 22px 24px; flex: 1; display: flex; flex-direction: column; }
        .review-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .reviewer-info { display: flex; align-items: center; gap: 10px; }
        .reviewer-avatar { width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid var(--accent-cyan); }
        .reviewer-name { font-weight: 700; font-size: 0.9rem; color: var(--deep-blue); }
        .review-date { font-size: 0.75rem; color: rgba(5,44,57,0.45); }
        .review-stars { color: #f5a623; font-size: 0.85rem; }
        .review-text { font-size: 0.88rem; color: rgba(5,44,57,0.8); line-height: 1.6; flex: 1; font-style: italic; margin-bottom: 14px; }
        .review-badge-row { display: flex; gap: 8px; flex-wrap: wrap; }
        .badge-activity-home { background: var(--ocean-blue); color: white; padding: 4px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; }
        .badge-safe-home { background: #e8f5e9; color: #2e7d32; padding: 4px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; }
        .badge-unsafe-home { background: #fdecea; color: #c62828; padding: 4px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; }

        .reviews-cta { text-align: center; margin-top: 36px; }

        /* --- CTA BOX --- */
        .cta-box { background: rgba(255,255,255,0.1); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.2); border-radius: 40px; padding: 60px 40px; text-align: center; margin-top: 30px; margin-bottom: -50px; position: relative; z-index: 5; color: white; }

        /* --- FOOTER --- */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255,255,255,0.6) !important; border-top: 1px solid rgba(255,255,255,0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .footer-links { list-style: none; padding: 0; margin: 0 auto 20px auto; display: flex; justify-content: center; align-items: center; gap: 25px; flex-wrap: wrap; }
        .footer-links a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.9rem; transition: 0.3s ease; display: inline-block; }
        .footer-links a:hover { color: var(--accent-cyan); transform: translateY(-2px); }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255,255,255,0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

        /* --- SCROLL BUTTON --- */
        #scrollBtn { position: fixed; right: 20px; top: 50%; transform: translateY(-50%); z-index: 1000; width: 50px; height: 150px; background: rgba(10,88,114,0.85); backdrop-filter: blur(10px); border: 3px solid var(--accent-cyan); border-radius: 60px; display: flex; align-items: center; justify-content: center; color: var(--accent-cyan); cursor: pointer; transition: all 0.3s ease; box-shadow: 0 15px 35px rgba(0,0,0,0.4); }
        #scrollBtn:hover { background: var(--accent-cyan); color: var(--deep-blue); right: 25px; }
        #scrollBtn i { font-size: 2.5rem; transition: transform 0.5s cubic-bezier(0.68,-0.55,0.27,1.55); margin: 0 auto; }
        .rotate-up { transform: rotate(180deg); }
        html { scroll-behavior: smooth; }

        /* ===== FEATURES SECTION ===== */
        .features { padding:90px 0; color: white; text-align: center; }
        .features .row { display: flex; justify-content: center; gap: 40px; flex-wrap: wrap; margin-top: 40px; }
        .features .col-md-4 { flex: 1; min-width: 280px; max-width: 350px; }
        .feature-box { background: rgba(255,255,255,0.95); padding:20px; border-radius:30px; transition:0.3s; box-shadow:0 10px 25px rgba(0,0,0,0.08); color: #333; height: 100%; }
        .feature-box:hover { transform:translateY(-10px); }

        /* ABOUT SECTION */
        .about-section { padding: 10px 0; color: #ffffff; display: flex; justify-content: center; }
        .about-row { display: flex; align-items: center; justify-content: space-between; gap: 80px; }
        .about-section .container { max-width: 1500px; padding: 0 40px; width: 100%; }
        .about-left { flex: 1; text-align: left; }
        .about-right { flex: 1; }
        .about-section h2 { font-weight: 700; color: #ffffff; margin-bottom: 25px; font-size: 2.5rem; }
        .about-section h3 { font-weight: 600; color: #48cae4; margin-bottom: 25px; }
        .about-section p { line-height: 1.8; opacity: 0.9; font-size: 1.05rem; }
        .commitment-item { padding: 18px 25px; border-radius: 15px; border-left: 4px solid #48cae4; margin-bottom: 20px; transition: all 0.3s ease; background: rgba(255, 255, 255, 0.03); color: #ffffff; }
        .commitment-item:hover { transform: translateX(10px); background: rgba(72, 202, 228, 0.08); }
        .commitment-item strong { color: #48cae4; display: block; margin-bottom: 5px; }
        @media (max-width: 991px) { .about-row { flex-direction: column; gap: 40px; text-align: center; } .about-left, .about-right { text-align: center; } .commitment-item { text-align: left; } }
        .title-line-left { height: 4px; width: 60px; background: var(--accent-cyan); margin: 10px 0 25px 0; border-radius: 10px; }
        .tooltip-btn { position: relative; }
        .tooltip-btn::after { content: attr(data-tooltip); position: absolute; bottom: 120%; left: 50%; transform: translateX(-50%); background: var(--deep-blue); color: white; padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; white-space: nowrap; opacity: 0; visibility: hidden; transition: 0.3s ease; pointer-events: none; border: 1px solid var(--accent-cyan); z-index: 1000; }
        .tooltip-btn:hover::after { opacity: 1; visibility: visible; }

        /* ============================================================
           NEW: HELP MODAL STYLES
           ============================================================ */
        #helpModal {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(5,44,57,0.88);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeInModal 0.25s ease;
        }
        #helpModal.d-none { display: none !important; }
        @keyframes fadeInModal {
            from { opacity: 0; transform: scale(0.96); }
            to   { opacity: 1; transform: scale(1); }
        }
        .help-modal-box {
            background: #0a3d52;
            border: 1px solid rgba(72,202,228,0.35);
            border-radius: 30px;
            padding: 40px;
            max-width: 780px;
            width: 100%;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        }
        .help-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        .help-modal-title {
            color: #48cae4;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }
        .btn-close-help {
            background: none;
            border: 1px solid rgba(255,255,255,0.25);
            color: white;
            border-radius: 50px;
            padding: 6px 20px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: 0.3s;
        }
        .btn-close-help:hover { background: rgba(255,255,255,0.1); }
        .help-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 600px) { .help-grid { grid-template-columns: 1fr; } }
        .help-item {
            background: rgba(255,255,255,0.05);
            border-left: 4px solid #48cae4;
            border-radius: 14px;
            padding: 18px 20px;
            transition: 0.3s;
        }
        .help-item:hover { background: rgba(72,202,228,0.08); transform: translateX(4px); }
        .help-item strong {
            color: #48cae4;
            display: block;
            margin-bottom: 8px;
            font-size: 0.92rem;
        }
        .help-item p {
            color: rgba(255,255,255,0.75);
            font-size: 0.85rem;
            margin: 0;
            line-height: 1.6;
        }
        .help-modal-footer {
            margin-top: 28px;
            text-align: center;
            color: rgba(255,255,255,0.4);
            font-size: 0.8rem;
        }
        .map-btn-wrapper{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:25px;
        }
    </style>
</head>
<body>

<nav class="waves-navbar">
    <div class="container header-container">
        <div class="user-greeting">
            <i class="fa-solid fa-circle-user me-2 text-info"></i>
            Hi, <span class="fw-bold"><?= auth()->user()->username ?></span>
        </div>
        <div class="nav-menu-center d-none d-lg-flex">
            <a href="<?= base_url('user/home') ?>" class="nav-link-custom active">Home</a>
            <a href="<?= base_url('user/activities') ?>" class="nav-link-custom">Activities</a>
            <a href="<?= base_url('user/safety') ?>" class="nav-link-custom">Safety & Sea Conditions</a>
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom">Book & Reserve</a>
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>

        <!-- UPDATED: logout-wrapper now has gap and help button added -->
        <div class="logout-wrapper">
            <!-- NEW: Help Button -->
            <button class="btn-help-custom" onclick="document.getElementById('helpModal').classList.remove('d-none')">
                <i class="fa-solid fa-circle-question me-1"></i> Help
            </button>
            <a href="<?= base_url('logout') ?>" class="btn-logout-custom">
                <i class="fa-solid fa-power-off me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<header class="welcome-hero text-center">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Welcome to Waves Water Sports</h1>
        <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 800px;">
            Plan your perfect water adventure at Matabungkay Beach. Explore exciting activities, 
            check real-time sea conditions powered by <span class="highlight-brand">MARISENSE</span>, and reserve with ease.
        </p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="<?= base_url('user/activities') ?>#jet-ski" class="btn btn-primary btn-action tooltip-btn" data-tooltip="Click here to explore activities">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Explore Activities
            </a>
            <a href="<?= base_url('user/safety') ?>#marisense-section" class="btn btn-primary btn-action tooltip-btn" data-tooltip="Click here to check sea conditions">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Check Sea Conditions
            </a>
            <a href="<?= base_url('user/booking') ?>" class="btn btn-light btn-action tooltip-btn" data-tooltip="Click here to book your adventure">
                <i class="fa-solid fa-calendar-check me-2"></i> Book Adventure
            </a>
        </div>
    </div>
</header>

<section class="about-section">
  <div class="container">
    <div class="about-row">
      <div class="about-left">
        <h2 style="margin-bottom: 10px;">About Us</h2>
        <div class="title-line-left"></div>
        <p><strong>Waves Water Sports</strong> is a premier leisure and adventure provider located in Matabungkay, Lian, Batangas. We specialize in safe, thrilling, and memorable water experiences for families, friends, and solo adventurers.</p>
        <p>Our mission is to combine fun, safety, and convenience using smart technology to monitor water conditions in real-time while offering easy online booking. Whether you're into jet skiing, banana boating, or kayaking, every visit is enjoyable and secure.</p>
      </div>
      <div class="about-right">
        <h3>Our Commitments</h3>
        <div class="commitment-item">
          <strong>Safety First</strong>
          Real-time monitoring to ensure guest safety.
        </div>
        <div class="commitment-item">
          <strong>Customer Convenience</strong>
          Hassle-free online booking.
        </div>
        <div class="commitment-item">
          <strong>Memorable Experiences</strong>
          Fun, unforgettable moments on the water.
        </div>
        <div class="commitment-item">
          <strong>Sustainable Practices</strong>
          Preserving Matabungkay Beach for future generations.
        </div>
      </div>
    </div>
  </div>
</section>

<section class="features text-center">
  <div class="container">
    <h1 class="mb-5 fw-bold text-uppercase" style="letter-spacing: 2px;">Experience the Sea</h1>
    <div class="title-line"></div>
    <div class="row">
      <div class="col-md-4">
        <div class="feature-box">
          <h3 class="fw-bold">Water Activities</h3>
          <p>Jet Ski, Banana Boat, Kayaking and exciting ocean adventures.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <h3 class="fw-bold">Easy Online Booking</h3>
          <p>Reserve your preferred schedule anytime with our smart system.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <h3 class="fw-bold">Safe & Monitored</h3>
          <p>Real-time water condition monitoring for your safety.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">

    <div class="section-header">
        <h1 class="fw-bold text-white">Featured Activities</h1>
        <div class="title-line"></div>
    </div>

    <div class="activities-flex-container">
        <?php 
        $activities = [
            ['Jet Ski', 'Experience high-speed water adventure.', 'jetski.jpg', 'jet-ski'],
            ['Banana Boat', 'Thrilling group ride with friends.', 'bananaboats.jpg', 'banana-boat'],
            ['Kayaking', 'Explore the clear waters and breeze.', 'kayak.jpg', 'kayaking'],
            ['Flying Saucer', 'Glide and spin over the surface.', 'flying.jpg', 'flying-saucer']
        ];
        foreach($activities as $act): ?>
        <div class="activity-box shadow-lg">
            <div class="activity-img" style="background-image: url('<?= base_url('images/' . $act[2]) ?>');"></div>
            <div class="p-4 text-center d-flex flex-column align-items-center justify-content-center">
                <h2 class="fw-bold text-white mb-2"><?= $act[0] ?></h2>
                <p class="small text-white-50 mb-3"><?= $act[1] ?></p>
                <a href="<?= base_url('user/activities') ?>#<?= $act[3] ?>" 
                class="btn-view-details tooltip-btn" 
                data-tooltip="Click here to see activity details (<?= $act[0] ?>)">
                View Details
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <section class="py-5">
        <div class="container">
            <div class="section-header">
                <h1 class="fw-bold">Real-Time Sea Conditions</h1>
                <div class="title-line"></div>
            </div>
            <div class="centered-data-wrapper">
                <div class="sea-data-container shadow-lg">
                    <?php
                    $windSpeed  = isset($seaCondition['wind_speed'])  ? $seaCondition['wind_speed']  . ' knots' : '10 knots';
                    $waveHeight = isset($seaCondition['wave_height'])  ? $seaCondition['wave_height'] . ' meters' : '0.9 meters';
                    $wavePeriod = isset($seaCondition['wave_period'])  ? $seaCondition['wave_period'] . ' seconds' : '5 seconds';
                    $safetyStatus = isset($seaCondition['safety_status']) ? $seaCondition['safety_status'] : 'safe';
                    $safetyLabel = match($safetyStatus) {
                        'safe'     => '🟢 SAFE FOR ACTIVITIES',
                        'moderate' => '🟡 MODERATE CONDITIONS',
                        'unsafe'   => '🔴 UNSAFE - SUSPENDED',
                        default    => '🟢 SAFE FOR ACTIVITIES',
                    };
                    $safetyColor = match($safetyStatus) {
                        'safe'     => 'text-success',
                        'moderate' => 'text-warning',
                        'unsafe'   => 'text-danger',
                        default    => 'text-success',
                    };
                    ?>
                    <div class="data-item">
                        <span class="data-label"><i class="fa-solid fa-wind me-3 text-info"></i> Wind Speed</span>
                        <span class="data-value"><?= esc($windSpeed) ?></span>
                    </div>
                    <div class="data-item">
                        <span class="data-label"><i class="fa-solid fa-water me-3 text-info"></i> Wave Height</span>
                        <span class="data-value"><?= esc($waveHeight) ?></span>
                    </div>
                    <div class="data-item">
                        <span class="data-label"><i class="fa-solid fa-stopwatch me-3 text-info"></i> Wave Period</span>
                        <span class="data-value"><?= esc($wavePeriod) ?></span>
                    </div>
                    <div class="data-item">
                        <span class="data-label"><i class="fa-solid fa-shield-halved me-3 text-info"></i> Safety Status</span>
                        <span class="data-value <?= $safetyColor ?>"><?= $safetyLabel ?></span>
                    </div>
                    <div class="text-center mt-5">
                        <a href="<?= base_url('user/safety') ?>#marisense-section" class="btn-view-details tooltip-btn" data-tooltip="Click here to see detailed report">
                            View Full Detailed Report <i class="fa-solid fa-chevron-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<section class="reviews-section">
    <div class="section-header">
        <h1 class="fw-bold text-white">What Our Adventurers Say</h1>
        <div class="title-line"></div>
    </div>

    <div class="review-cards-wrapper">
        <?php
        $staticReviews = [
            [
                'username'    => 'Cardo Dalisay',
                'activity'    => 'Banana Boat',
                'rating'      => 5,
                'review_text' => 'Napakasaya! Safe kahit may konting alon. Very accommodating din ang mga staff at sulit na sulit ang bayad.',
                'safe_feel'   => 'yes',
                'photo_url'   => 'https://scontent.fmnl22-1.fna.fbcdn.net/v/t39.30808-6/572804802_846688217920118_7400127582885222591_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeHKUGolkrfTOLUVbTEI50luSvb9aHED1nxK9v1ocQPWfFSxku6bpuccFk_bE-sSC8GFXXhnFMNh14G5WxlY2D0F&_nc_ohc=nAwP4c6fMgUQ7kNvwEC54xu&_nc_oc=AdprUKxGOs74ueZyPgTUIm72zCsdht6izEtKANUD_265_ry7DOR84fdkxurSUfegWWM&_nc_zt=23&_nc_ht=scontent.fmnl22-1.fna&_nc_gid=DfvNZaRjqHWOoycpNdB48A&_nc_ss=7a3a8&oh=00_Af0rvTUbxUqtcs1Fm49kEEJrhqxMww0nedzbBE7wTWKsnA&oe=69DE6595',
                'created_at'  => '2026-03-15 10:00:00',
            ],
            [
                'username'    => 'Maria Clara',
                'activity'    => 'Jet Ski',
                'rating'      => 5,
                'review_text' => 'Maganda ang experience! Buti na lang real-time ang sea monitoring ng MARISENSE kaya alam naming safe bago sumabak.',
                'safe_feel'   => 'yes',
                'photo_url'   => 'https://scontent.fmnl22-1.fna.fbcdn.net/v/t39.30808-6/659754567_975447061710899_134557125449451855_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=106&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeHtn0-hlActf50cJ7FmpU3BWqrzzn6PbvhaqvPOfo9u-KlSTjI2PqxS_EPsv6a3pR_j1fXTa-bF4z02t1QKeZoS&_nc_ohc=ROWDwym0XcMQ7kNvwHoVnRI&_nc_oc=AdocTCzQ_YKfwHooVJbm5LStGk2L2DAivbIPkl8Ez5EEnJRxc5aAabuBWoUDwNdgMWs&_nc_zt=23&_nc_ht=scontent.fmnl22-1.fna&_nc_gid=mmvMr5qY7mD2TjXsvL5Gjg&_nc_ss=7a3a8&oh=00_Af0cx45jRYNg8zDz7YUi57R_S2m0iasDs64mLptr__ZAUg&oe=69DE6B40',
                'created_at'  => '2026-03-12 14:30:00',
            ],
            [
                'username'    => 'Juan dela Cruz',
                'activity'    => 'Kayaking',
                'rating'      => 4,
                'review_text' => 'Relaxing and fun! Perfect para sa mga gustong mag-enjoy ng beach nang tahimik. Highly recommended para sa mag-partner.',
                'safe_feel'   => 'yes',
                'photo_url'   => 'https://tse3.mm.bing.net/th/id/OIP.uEerkLhRkdWbUvjO7w2ltQHaE7?rs=1&pid=ImgDetMain&o=7&rm=3',
                'created_at'  => '2026-03-10 09:00:00',
            ],
        ];

        $displayReviews = $staticReviews;

        foreach ($displayReviews as $rev):
            $stars = (int)($rev['rating'] ?? 5);
            $name  = esc($rev['username'] ?? 'Guest');
            $act   = esc($rev['activity'] ?? '');
            $text  = esc($rev['review_text'] ?? '');
            $safe  = strtolower($rev['safe_feel'] ?? 'yes');
            $date  = date('F d, Y', strtotime($rev['created_at']));
            $photo = $rev['photo_url'];
            $actIcon = match(strtolower($act)) {
                'jet ski'     => 'fa-person-water-polo',
                'banana boat' => 'fa-ship',
                'kayaking'    => 'fa-water',
                default       => 'fa-water',
            };
        ?>
        <div class="home-review-card shadow">
            <img src="<?= $photo ?>" alt="Review photo by <?= $name ?>" class="review-card-photo" style="object-fit: cover;">
            <div class="review-card-body">
                <div class="review-card-header">
                    <div class="reviewer-info">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($name) ?>&background=0a5872&color=fff&size=80"
                             alt="<?= $name ?>" class="reviewer-avatar">
                        <div>
                            <div class="reviewer-name"><?= $name ?></div>
                            <div class="review-date"><?= $date ?></div>
                        </div>
                    </div>
                    <div class="review-stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fa-<?= $i <= $stars ? 'solid' : 'regular' ?> fa-star"></i>
                        <?php endfor; ?>
                    </div>
                </div>
                <p class="review-text">"<?= $text ?>"</p>
                <div class="review-badge-row">
                    <span class="badge-activity-home"><i class="fa-solid <?= $actIcon ?> me-1"></i><?= $act ?></span>
                    <span class="badge-safe-home"><i class="fa-solid fa-shield-halved me-1"></i> Felt Safe</span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="reviews-cta">
        <a href="<?= base_url('user/reviews') ?>" class="btn-view-details tooltip-btn" data-tooltip="Click here to read all reviews">
            <i class="fa-solid fa-star me-2"></i> Read All Reviews
        </a>
    </div>
</section>

<div class="container">
    <div class="cta-box shadow-lg">
        <h2 class="fw-bold mb-3">Ready for your next water adventure?</h2>
        <p class="opacity-75 mb-4">The waves are waiting. Check availability and book your slot today!</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="<?= base_url('user/booking') ?>" class="btn btn-info text-white btn-action px-5 shadow tooltip-btn" data-tooltip="Click here to book now">
                <i class="fa-solid fa-calendar-check me-2"></i> Book Now
            </a>
        </div>
    </div>
</div>

<!-- GOOGLE MAPS SECTION -->
<section style="padding: 80px 0 60px;">
    <div class="container">
        <div class="section-header">
            <h1 class="fw-bold text-white">Find Us Here</h1>
            <div class="title-line"></div>
            <p class="opacity-75 mt-2">Matabungkay Beach, Lian, Batangas, Philippines</p>
        </div>
        <div style="border-radius: 30px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3877.0521!2d120.63170!3d13.95670!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd052f43e38a5d%3A0x4ee4d0726e25a8c4!2sMatabungkay%20Beach%2C%20Lian%2C%20Batangas!5e0!3m2!1sen!2sph!4v1700000000000!5m2!1sen!2sph"
                width="100%"
                height="450"
                style="border:0; display:block;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        <div class="map-btn-wrapper">
            <a href="https://maps.google.com/?q=Matabungkay+Beach+Lian+Batangas" target="_blank"
               class="btn-view-details tooltip-btn"
               data-tooltip="Open in Google Maps">
                <i class="fa-solid fa-location-dot me-2"></i> Open in Google Maps
            </a>
        </div>
    </div>
</section>
<!-- END GOOGLE MAPS SECTION -->

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
            <span class="text-info fw-bold" style="letter-spacing: 1px;">MARISENSE</span>
        </div>
    </div>
</footer>

<!-- ============================================================
     NEW: HELP MODAL
     ============================================================ -->
<div id="helpModal" class="d-none">
    <div class="help-modal-box">
        <div class="help-modal-header">
            <h5 class="help-modal-title">
                <i class="fa-solid fa-circle-question me-2"></i> System Guide
            </h5>
            <button class="btn-close-help" onclick="document.getElementById('helpModal').classList.add('d-none')">
                <i class="fa-solid fa-xmark me-1"></i> Close
            </button>
        </div>

        <div class="help-grid">
            <div class="help-item">
                <strong><i class="fa-solid fa-house me-2"></i>Home</strong>
                <p>Overview of the whole system — featured activities, live sea conditions powered by MARISENSE, and recent customer reviews at a glance.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-person-swimming me-2"></i>Activities</strong>
                <p>Browse all available water sports — Jet Ski, Banana Boat, Kayaking, and Flying Saucer — with descriptions and pricing info.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-water me-2"></i>Safety & Sea Conditions</strong>
                <p>View real-time MARISENSE data: wind speed, wave height, wave period, and whether activities are currently safe to proceed.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-calendar-check me-2"></i>Book & Reserve</strong>
                <p>Select your preferred activity, pick a date and time slot, and confirm your reservation online before heading to the beach.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-list-check me-2"></i>My Bookings</strong>
                <p>Track all your active and past reservations. View booking status, schedule, and activity details anytime.</p>
            </div>
            <div class="help-item">
                <strong><i class="fa-solid fa-star me-2"></i>Reviews</strong>
                <p>Read honest feedback from fellow adventurers, or leave your own review and rating after completing an activity.</p>
            </div>
        </div>

        <div class="help-modal-footer">
            <i class="fa-solid fa-shield-halved me-1"></i>
            For further assistance, contact us via our social media pages.
        </div>
    </div>
</div>
<!-- ============================================================ -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function smartScroll() {
        const scrollIcon = document.getElementById("scrollIcon");
        const isAtBottom = (window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 200);
        if (isAtBottom || scrollIcon.classList.contains("rotate-up")) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            window.scrollBy({ top: 600, left: 0, behavior: 'smooth' });
        }
    }

    window.addEventListener('scroll', function() {
        const scrollIcon = document.getElementById("scrollIcon");
        const scrollBtn  = document.getElementById("scrollBtn");
        const scrollTotal = document.documentElement.scrollHeight - window.innerHeight;
        const scrollValue = scrollTotal > 0 ? window.scrollY / scrollTotal : 0;

        if (scrollValue > 0.8) {
            scrollIcon.classList.add("rotate-up");
            scrollBtn.style.background = "#48cae4";
            scrollIcon.style.color = "#052c39";
        } else {
            scrollIcon.classList.remove("rotate-up");
            scrollBtn.style.background = "rgba(10, 88, 114, 0.8)";
            scrollIcon.style.color = "#48cae4";
        }
    });

    /* ============================================================
       NEW: Close help modal when clicking outside the box
       ============================================================ */
    document.getElementById('helpModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('d-none');
        }
    });
    /* ============================================================ */
</script>

<div id="scrollBtn" onclick="smartScroll()" title="Navigate Page">
    <i class="fa-solid fa-arrow-down" id="scrollIcon"></i>
</div>

</body>
</html>