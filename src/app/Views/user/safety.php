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

        .sea-data-container { background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(15px); border-radius: 30px; padding: 40px; border: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
        .data-item { border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding: 20px 0; display: flex; justify-content: space-between; align-items: center; }
        .data-item:last-child { border-bottom: none; }
        .data-label { font-size: 1rem; color: rgba(255, 255, 255, 0.7); text-transform: uppercase; letter-spacing: 1.5px; }
        .data-value { font-weight: 700; font-size: 1.5rem; color: var(--accent-cyan); }
        .feature-card { background: rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 25px; border: 1px solid rgba(255, 255, 255, 0.1); transition: 0.3s; height: 100%; }

        /* Footer Styles */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }
    </style>
</head>
<body>

<nav class="waves-navbar">
    <div class="container header-container">
        <div class="user-greeting"><i class="fa-solid fa-circle-user me-2 text-info"></i>Hi, <span class="fw-bold"><?= auth()->user()->username ?></span></div>
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

<div class="container py-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-white mb-4">About MARISENSE</h1>
            <p class="lead opacity-75">Marine Analytics for Resilient and Intelligent Synchronized Coastal Systems.</p>
            <p>Our smart monitoring system collects real-time data using sensors installed on a floating buoy to identify whether sea conditions are safe for guests.</p>
        </div>
        <div class="col-lg-6">
            <div class="sea-data-container">
                <h5 class="text-center text-info mb-4">LIVE SEA DASHBOARD</h5>
                <div class="data-item"><span class="data-label">Wind Speed</span><span class="data-value">11 knots</span></div>
                <div class="data-item"><span class="data-label">Wave Height</span><span class="data-value">0.8 meters</span></div>
                <div class="data-item"><span class="data-label">Wave Period</span><span class="data-value">6 seconds</span></div>
                <div class="data-item"><span class="data-label">Status</span><span class="data-value text-success">🟢 SAFE</span></div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="feature-card text-center">
                <i class="fa-solid fa-satellite-dish fa-3x text-info mb-3"></i>
                <h4 class="fw-bold">Wind Monitoring</h4>
                <p class="small opacity-75">Detects wind speed and direction to identify unsafe drifting conditions.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center">
                <i class="fa-solid fa-water fa-3x text-info mb-3"></i>
                <h4 class="fw-bold">Wave Monitoring</h4>
                <p class="small opacity-75">Measures height using motion sensors to prevent boat capsizing.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center">
                <i class="fa-solid fa-bell-slash fa-3x text-warning mb-3"></i>
                <h4 class="fw-bold">Safety Alerts</h4>
                <p class="small opacity-75">Alerts staff when conditions exceed safe thresholds (Wind > 15 knots).</p>
            </div>
        </div>
    </div>
</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text">For inquiries, message us through our social media platforms.</div>
        <div class="social-icons">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="copyright-text">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
</footer>

</body>
</html>