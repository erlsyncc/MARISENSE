<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; }

        .highlight-brand {
            font-weight: 700;
            color: #48cae4;
            text-shadow: 0 0 10px rgba(72, 202, 228, 0.4);
            letter-spacing: 1px;
        }

        /* Navbar Styles */
        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; gap: 10px; align-items: center; }
        .nav-link-custom { color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255, 255, 255, 0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255, 107, 107, 0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }

        /* ============================================================
           ADDED: HELP BUTTON STYLE
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
        /* ============================================================
           ADDED: HELP MODAL STYLES
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
        /* ============================================================ */

        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), 
                        url('<?= base_url('images/marisensebg.png') ?>'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 150px 40px;
            color: white;
            border-radius: 0 0 80px 80px;
            margin-bottom: 60px;
        }

        .activity-line { height: 5px; width: 100px; background: var(--accent-cyan); border-radius: 10px; margin: 10px auto 40px auto; }

        .safety-main-container { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 30px; 
            padding: 40px; 
            margin-bottom: 50px; 
            max-width: 1100px; 
            margin-left: auto;
            margin-right: auto;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 140px);
            gap: 15px;
        }
        .data-card {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .data-card i { color: var(--accent-cyan); font-size: 1.5rem; margin-bottom: 5px; }
        .data-card .label { font-size: 0.75rem; text-transform: uppercase; opacity: 0.7; letter-spacing: 1px; }
        .data-card .value { font-size: 1.3rem; font-weight: 700; }

        .system-features-wrapper {
            padding: 0 15%;
            margin: 80px 0;
        }

        .system-grid-layout {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, auto);
            gap: 30px;
        }

        .feature-box {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            padding: 40px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .feature-box h5 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-cyan);
            margin: 15px 0;
        }

        .feature-box p {
            font-size: 1rem;
            line-height: 1.5;
            opacity: 0.9;
            margin: 0;
        }

        .feature-box i {
            font-size: 3.5rem;
            color: var(--accent-cyan);
        }
        .status-bar { border-radius: 50px; padding: 10px 20px; display: inline-flex; align-items: center; gap: 10px; font-weight: 600; }
        .bg-safe { background: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745; }
        .bg-moderate { background: rgba(255, 193, 7, 0.2); color: #ffc107; border: 1px solid #ffc107; }
        .bg-unsafe { background: rgba(220, 53, 69, 0.2); color: #dc3545; border: 1px solid #dc3545; }

        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

        .section-header-centered {
            text-align: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .activity-line { 
            height: 5px; 
            width: 100px; 
            background: var(--accent-cyan); 
            border-radius: 10px; 
            margin: 10px auto 40px auto;
        }

        .safety-wrapper-final {
            width: 100%;
            max-width: 1100px; 
            margin: 60px auto !important;
            text-align: center !important;
            padding: 60px 40px;
            border: 3px dashed #ffc107 !important; 
            border-radius: 40px;
            background: rgba(255, 193, 7, 0.05);
            display: block;
        }

        .yellow-line-move {
            height: 4px;
            width: 100px;
            background: #ffc107;
            margin: 20px auto !important;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .yellow-line-move::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            animation: shine 2s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .safety-content-box {
            display: inline-block;
            text-align: left;
            vertical-align: top;
        }

        .dot { height: 12px; width: 12px; border-radius: 50%; display: inline-block; margin-right: 10px; }
        .dot-green { background-color: #28a745; box-shadow: 0 0 10px #28a745; }
        .dot-yellow { background-color: #ffc107; box-shadow: 0 0 10px #ffc107; }
        .dot-red { background-color: #dc3545; box-shadow: 0 0 10px #dc3545; }

        .text-safe { color: #28a745; font-weight: 600; }
        .text-moderate { color: #ffc107; font-weight: 600; }
        .text-suspended { color: #dc3545; font-weight: 600; }

        .vertical-divider {
            border-left: 2px solid rgba(255, 255, 255, 0.1);
            height: 100%;
        }

        #scrollBtn {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            width: 50px;
            height: 150px;
            background: rgba(10, 88, 114, 0.85);
            backdrop-filter: blur(10px);
            border: 3px solid var(--accent-cyan);
            border-radius: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-cyan);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        #scrollBtn:hover {
            background: var(--accent-cyan);
            color: var(--deep-blue);
            right: 25px;
        }

        #scrollBtn i {
            font-size: 2.5rem;
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            margin: 0 auto;
        }

        .rotate-up {
            transform: rotate(180deg);
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>

<nav class="waves-navbar">
    <div class="container header-container">
        <div class="user-greeting"><i class="fa-solid fa-circle-user me-2 text-info"></i> Hi, <span class="fw-bold"><?= auth()->user()->username ?></span></div>
        <div class="nav-menu-center d-none d-lg-flex">
            <a href="<?= base_url('user/home') ?>" class="nav-link-custom">Home</a>
            <a href="<?= base_url('user/activities') ?>" class="nav-link-custom">Activities</a>
            <a href="<?= base_url('user/safety') ?>" class="nav-link-custom active">Safety & Sea Conditions</a>
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom">Book & Reserve</a>
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <!-- UPDATED: added Help button beside Logout -->
        <div class="logout-wrapper">
            <button class="btn-help-custom" onclick="document.getElementById('helpModal').classList.remove('d-none')">
                <i class="fa-solid fa-circle-question me-1"></i> Help
            </button>
            <a href="<?= base_url('logout') ?>" class="btn-logout-custom">
                <i class="fa-solid fa-power-off me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Stay Updated with Sea Conditions</h1>
        <p class="lead mb-0 opacity-90 mx-auto" style="max-width: 800px;">
            Monitor real-time wind and wave data powered by MARISENSE. Make informed decisions and enjoy water activities safely with accurate coastal insights.
        </p>
    </div>
</header>

<div class="container">
    <div class="section-header-centered mt-5" id="marisense-section">
        <h1 class="fw-bold text-white mb-1">About <span class="highlight-brand">MARISENSE</span></h1>
        <div class="activity-line"></div>
    </div>
    <div class="safety-main-container shadow-lg mb-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h4 class="text-info fw-bold mb-3">Smart Marine Monitoring</h4>
                <p class="opacity-80 mb-3">
                    <span class="highlight-brand">MARISENSE</span> (Marine Analytics for Resilient and Intelligent Synchronized Coastal Systems) is a smart marine monitoring system designed to improve safety for coastal leisure activities.
                </p>
                <p class="opacity-80 mb-3">
                    The system collects real-time environmental data such as wind speed, wind direction, wave height, and wave period using sensors installed on a floating buoy.
                </p>
                <p class="opacity-80">
                    This data helps water sports operators determine whether conditions are safe for guests before starting activities, ensuring a worry-free adventure at Matabungkay.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-white bg-opacity-5 rounded-4 border border-white border-opacity-10">
                    <h5 class="text-center mb-4 fw-bold"><i class="fa-solid fa-tower-broadcast me-2 text-info"></i> LIVE SEA DASHBOARD</h5>
                    <div class="dashboard-grid">
                        <div class="data-card"><i class="fa-solid fa-wind"></i><span class="label">Wind Speed</span><span class="value">11 knots</span></div>
                        <div class="data-card"><i class="fa-solid fa-compass"></i><span class="label">Direction</span><span class="value">Northeast</span></div>
                        <div class="data-card"><i class="fa-solid fa-water"></i><span class="label">Wave Height</span><span class="value">0.8m</span></div>
                        <div class="data-card"><i class="fa-solid fa-wave-square"></i><span class="label">Wave Period</span><span class="value">6s</span></div>
                    </div>
                    <div class="mt-4 text-center">
                        <div class="status-bar bg-safe">
                            <i class="fa-solid fa-circle-check"></i> STATUS: SAFE FOR ACTIVITIES
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="section-header-centered mt-5">
    <h1 class="fw-bold text-white mb-1">System Features</h1>
    <div class="activity-line"></div>
</div>

<div class="system-features-wrapper">
    <div class="system-grid-layout">
        
        <div class="feature-box">
            <i class="fa-solid fa-wind"></i>
            <h5>Wind Monitoring</h5>
            <p>Detects speed and direction to identify unsafe wind conditions for water sports.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-water"></i>
            <h5>Wave Monitoring</h5>
            <p>Measures height and movement using onboard motion sensors to ensure guest safety.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-location-crosshairs"></i>
            <h5>GPS Tracking</h5>
            <p>Ensures data is collected from the exact activity zone for precise marine updates.</p>
        </div>

        <div class="feature-box">
            <i class="fa-solid fa-bell"></i>
            <h5>Safety Alerts</h5>
            <p>Alerts staff immediately when sea conditions exceed safe thresholds in real-time.</p>
        </div>

    </div>
</div>

    <div class="container text-center"> 
    <div class="safety-wrapper-final shadow-lg">
        
        <h2 class="fw-bold text-warning mb-0">
            Activity Safety Protocol
        </h2>
        
        <div class="yellow-line-move"></div>

        <div class="row g-4 align-items-start mt-2">
            
            <div class="col-md-5 text-start ps-lg-5">
                <h4 class="fw-bold text-info mb-4">Safety Status Indicator</h4>
                <div class="ps-2">
                    <div class="mb-3 d-flex align-items-center">
                        <span class="dot dot-green"></span> 
                        <span><strong class="text-safe">Green:</strong> Safe for Activities</span>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <span class="dot dot-yellow"></span> 
                        <span><strong class="text-moderate">Yellow:</strong> Moderate Conditions</span>
                    </div>
                    <div class="mb-0 d-flex align-items-center">
                        <span class="dot dot-red"></span> 
                        <span><strong class="text-suspended">Red:</strong> Unsafe / Suspended</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 d-none d-md-flex justify-content-center">
                <div class="vertical-divider"></div>
            </div>

            <div class="col-md-5 text-start pe-lg-5">
                <h4 class="fw-bold text-warning mb-4">Activity Safety Guide</h4>
                <div class="ps-2">
                    <div class="mb-3">
                        <i class="fa-solid fa-wind text-info me-2"></i> 
                        Wind > 15 knots = <strong style="color: #ff4d4d;">UNSAFE</strong>
                    </div>
                    <div class="mb-3">
                        <i class="fa-solid fa-water text-info me-2"></i> 
                        Wave Height > 1.5m = <strong style="color: #ff4d4d;">UNSAFE</strong>
                    </div>
                    <div class="mb-0">
                        <i class="fa-solid fa-circle-exclamation text-info me-2"></i> 
                        Operations may pause during high tide.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text mb-4 opacity-75">For inquiries, message us through our social media platforms.</div>
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
        <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
</footer>

<!-- ADDED: HELP MODAL -->
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
<!-- END HELP MODAL -->

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
            const scrollBtn = document.getElementById("scrollBtn");
            
            const scrollTotal = document.documentElement.scrollHeight - window.innerHeight;
            const scrollValue = window.scrollY / scrollTotal;
            
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

        /* ADDED: Close help modal when clicking outside the box */
        document.getElementById('helpModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('d-none');
            }
        });
    </script>

    <div id="scrollBtn" onclick="smartScroll()" title="Navigate Page">
        <i class="fa-solid fa-arrow-down" id="scrollIcon"></i>
    </div>

</body>
</html>