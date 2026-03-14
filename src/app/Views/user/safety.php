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

        /* Navbar Styles */
        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; }
        .nav-link-custom { color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255, 255, 255, 0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255, 107, 107, 0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }

        /* UNIFIED HERO - Ginaya ang size sa Activities/Home */
        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.6), rgba(5, 44, 57, 0.8)), 
                        url('<?= base_url('images/marisensebg.png') ?>'); 
            background-size: cover; background-position: center; background-attachment: fixed;
            padding: 120px 40px; color: white; border-radius: 0 0 80px 80px;
            text-align: center; display: flex; flex-direction: column; align-items: center;
            margin-bottom: 60px;
        }

        .activity-line { height: 5px; width: 100px; background: var(--accent-cyan); border-radius: 10px; margin: 10px auto 40px auto; }

        /* Main Container - Consistent width */
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

        /* Live Dashboard Grid */
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

        /* Feature Cards */
        .feature-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 25px;
            padding: 25px;
            height: 100%;
            transition: 0.3s;
        }
        .feature-box:hover { background: rgba(255, 255, 255, 0.07); transform: translateY(-5px); }
        .feature-box i { font-size: 2rem; color: var(--accent-cyan); margin-bottom: 15px; }

        /* Status Indicators */
        .status-bar { border-radius: 50px; padding: 10px 20px; display: inline-flex; align-items: center; gap: 10px; font-weight: 600; }
        .bg-safe { background: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745; }
        .bg-moderate { background: rgba(255, 193, 7, 0.2); color: #ffc107; border: 1px solid #ffc107; }
        .bg-unsafe { background: rgba(220, 53, 69, 0.2); color: #dc3545; border: 1px solid #dc3545; }

        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }
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
            <a href="<?= base_url('user/calendar') ?>" class="nav-link-custom">Calendar</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Safety & Sea Conditions</h1>
        <p class="lead mb-0 opacity-90 mx-auto" style="max-width: 800px;">
            Real-time marine monitoring powered by MARISENSE technology.
        </p>
    </div>
</header>

<div class="container">
    <div class="text-center">
        <h2 class="fw-bold text-white mb-1">About MARISENSE</h2>
        <div class="activity-line"></div>
    </div>
    <div class="safety-main-container shadow-lg mb-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h4 class="text-info fw-bold mb-3">Smart Marine Monitoring</h4>
                <p class="opacity-80 mb-3">
                    <strong>MARISENSE</strong> (Marine Analytics for Resilient and Intelligent Synchronized Coastal Systems) is a smart marine monitoring system designed to improve safety for coastal leisure activities.
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

    <div class="text-center mt-5">
        <h2 class="fw-bold text-white mb-1">System Features</h2>
        <div class="activity-line"></div>
    </div>
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="feature-box text-center">
                <i class="fa-solid fa-wind"></i>
                <h6 class="fw-bold">Wind Monitoring</h6>
                <p class="small opacity-70">Detects speed and direction to identify unsafe wind conditions.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-box text-center">
                <i class="fa-solid fa-water"></i>
                <h6 class="fw-bold">Wave Monitoring</h6>
                <p class="small opacity-70">Measures height and movement using onboard motion sensors.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-box text-center">
                <i class="fa-solid fa-location-crosshairs"></i>
                <h6 class="fw-bold">GPS Tracking</h6>
                <p class="small opacity-70">Ensures data is collected from the exact activity zone.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature-box text-center">
                <i class="fa-solid fa-bell"></i>
                <h6 class="fw-bold">Safety Alerts</h6>
                <p class="small opacity-70">Alerts staff immediately when sea conditions exceed safe thresholds.</p>
            </div>
        </div>
    </div>

    <div class="safety-main-container bg-opacity-10 mb-5">
        <div class="row">
            <div class="col-md-6 border-end border-white border-opacity-10">
                <h5 class="fw-bold text-info mb-4">Safety Status Indicator</h5>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3"><span class="badge rounded-circle p-2 bg-success"> </span> <span><strong>Green</strong>: Safe for Activities</span></div>
                    <div class="d-flex align-items-center gap-3"><span class="badge rounded-circle p-2 bg-warning"> </span> <span><strong>Yellow</strong>: Moderate Conditions</span></div>
                    <div class="d-flex align-items-center gap-3"><span class="badge rounded-circle p-2 bg-danger"> </span> <span><strong>Red</strong>: Unsafe / Suspended</span></div>
                </div>
            </div>
            <div class="col-md-6 ps-md-5">
                <h5 class="fw-bold text-warning mb-4">Activity Safety Guide</h5>
                <ul class="list-unstyled opacity-80">
                    <li class="mb-2"><i class="fa-solid fa-circle-exclamation me-2"></i> Wind > 15 knots = <strong>UNSAFE</strong></li>
                    <li class="mb-2"><i class="fa-solid fa-circle-exclamation me-2"></i> Wave Height > 1.5 meters = <strong>UNSAFE</strong></li>
                    <li><i class="fa-solid fa-circle-info me-2"></i> Operations may pause during high tide.</li>
                </ul>
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

</body>
</html>