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
        :root {
            --deep-blue: #052c39;
            --ocean-blue: #0a5872;
            --accent-cyan: #48cae4;
            --soft-white: #f4f9fc;
            --safe-green: #2ecc71;
        }

        .highlight-brand {
            font-weight: 700;
            color: #48cae4; /* Matches your accent cyan */
            text-shadow: 0 0 10px rgba(72, 202, 228, 0.4);
            letter-spacing: 1px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* Gradient Background: Cyan -> Ocean -> Deep Blue */
            background: linear-gradient(180deg, 
                        var(--accent-cyan) 0%, 
                        var(--ocean-blue) 40%, 
                        var(--deep-blue) 100%);
            background-attachment: fixed; /* Para hindi napuputol ang gradient habang nag-scroll */
            color: var(--soft-white); /* Ginawang white ang default text para mababasa sa dark background */
            margin: 0;
        }

        /* --- UNIFIED HEADER --- */
        .waves-navbar {
            background: var(--ocean-blue);
            padding: 35px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
        }

        .user-greeting {
            color: white;
            font-size: 1.2rem;
            font-weight: 400;
            vertical-align: middle;
            flex: 1; /* Aligns Hi, User to the far left */
        }

        .nav-menu-center {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex: 2; /* Keeps menu in the center */
        }

        .logout-wrapper {
            flex: 1;
            display: flex;
            justify-content: flex-end; /* Aligns Logout to the far right */
        }

        .nav-link-custom {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 50px;
            transition: 0.3s;
            white-space: nowrap;
        }

        .nav-link-custom:hover {
            color: var(--accent-cyan);
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link-custom.active {
            background: var(--accent-cyan);
            color: var(--deep-blue);
            font-weight: 600;
        }

        .btn-logout-custom {
            color: #ff6b6b;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 8px 18px;
            border: 1px solid rgba(255, 107, 107, 0.3);
            border-radius: 50px;
            transition: 0.3s;
        }

        .btn-logout-custom:hover {
            background: #ff6b6b;
            color: white;
        }

        /* --- CONTENT SECTIONS --- */
        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), 
                        url('<?= base_url('images/background.png') ?>'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 120px 40px;
            color: white;
            border-radius: 0 0 80px 80px;
            margin-bottom: 60px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .title-line {
            height: 4px;
            width: 60px;
            background: var(--accent-cyan);
            margin: 10px auto;
            border-radius: 10px;
        }

        .activities-flex-container {
            display: flex;
            justify-content: center; /* Naka-center ang buong grupo ng boxes */
            gap: 20px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding: 20px 0;
            text-align: center;
        }

        .activity-box {
            flex: 1;
            min-width: 280px; /* Nilakihan nang kaunti para kasya ang H2 */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            overflow: hidden;
            transition: 0.4s ease;
            display: flex;
            flex-direction: column;
        }

        .activity-box:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent-cyan);
        }

        .activity-img {
            height: 180px; /* Fixed height para sa pictures */
            background-size: cover;
            background-position: center;
        }

        /* Styling specifically for the Activity H2 */
        .activity-box h2 {
            font-size: 1rem; /* Tamang laki para sa H2 sa loob ng card */
            margin-bottom: 10px;
            text-align: center;
        }

        .btn-view-details {
            display: inline-block; /* Mahalaga ito para sumunod sa text-center */
            background: var(--accent-cyan);
            color: var(--deep-blue) !important;
            padding: 12px 40px; /* Mas malapad na padding para sa centered look */
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: 0.3s ease;
            box-shadow: 0 4px 15px rgba(72, 202, 228, 0.3);
        }

        .btn-view-details:hover {
            background: white;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
        }

        .centered-data-wrapper {
            max-width: 800px; /* Nilimitahan ang lapad para maging compact at maganda ang alignment */
            margin: 0 auto;
        }

        .sea-data-container {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border-radius: 30px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .data-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .data-item:last-child {
            border-bottom: none;
        }

        .data-label {
            font-size: 1rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .data-value {
            font-weight: 700;
            font-size: 1.5rem; /* Mas malaking font para sa data */
            color: var(--accent-cyan);
        }

        .btn-action {
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease; /* Smooth transition para sa lahat ng changes */
            text-transform: uppercase; /* Para magmukhang professional na menu */
            letter-spacing: 1px;
            border: none;
            display: inline-flex;
            align-items: center;
            background: #48cae4;;
        }

        /* Hover Effect: Lalaki nang konti at tataas (Floating effect) */
        .btn-action:hover {
            transform: translateY(-5px); /* Tatalon paitaas */
            box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important; /* Lalalim ang anino */
            filter: brightness(1.1); /* Lilinaw nang konti ang kulay */
        }

        /* Active Effect: Kapag pinindot (Clicking feel) */
        .btn-action:active {
            transform: translateY(-1px); /* Bababa nang konti pag click */
        }

        /* Siguraduhin na ang mga H2 at titles ay puti o light cyan */
        h2, h5, .section-header h2 {
            color: white !important;
        }

        /* Footer adjustment para mag-blend sa Deep Blue */
        footer {
            background: var(--deep-blue);
            color: rgba(255, 255, 255, 0.6) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        /* CTA Box Styling */
        .cta-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 40px;
            padding: 60px 40px;
            text-align: center;
            margin-top: 100px; /* Space mula sa taas */
            margin-bottom: -50px; /* "Floating" effect para pumatong sa footer */
            position: relative;
            z-index: 5;
            color: white;
        }

        /* Footer Styling */
        footer {
            background: var(--deep-blue);
            padding: 100px 0 40px 0; /* Padding para sa floating CTA box */
            color: rgba(255, 255, 255, 0.6) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0 auto 20px auto; /* Naka-center ang margin */
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap; /* Para hindi masira sa mobile */
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--accent-cyan);
            transform: translateY(-2px);
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .social-icons i {
            color: rgba(255, 255, 255, 0.7);
            transition: 0.3s;
            cursor: pointer;
        }

        .social-icons i:hover {
            color: var(--accent-cyan);
            transform: scale(1.2);
        }

        /* interactive Floating Scroll Button (Center Right) */
        #scrollBtn {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            width: 50px; /* Nilakihan nang konti para mas maluwag */
            height: 150px; /* Mas mahaba para mas pill-shaped look */
            background: rgba(10, 88, 114, 0.85); /* Bahagyang mas malinaw ang background */
            backdrop-filter: blur(10px); /* Mas blurred ang background */
            border: 3px solid var(--accent-cyan); /* Mas makapal na border */
            border-radius: 60px; /* Mas rounded pill shape */
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-cyan);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4); /* Mas malalim na anino */
        }

        #scrollBtn:hover {
            background: var(--accent-cyan);
            color: var(--deep-blue);
            right: 25px; /* Konting galaw pabalik pag ni-hover */
        }

        /* NILAKIHAN NATIN ITO: Ang arrow icon sa loob */
        #scrollBtn i {
            font-size: 2.5rem; /* Mas malaking icon para mas kita */
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            margin: 0 auto; /* Naka-center vertical at horizontal */
        }

        /* Rotation for Upward Arrow */
        .rotate-up {
            transform: rotate(180deg);
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

        <div class="logout-wrapper">
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
            <a href="<?= base_url('user/activities') ?>" class="btn btn-primary btn-action shadow-lg text-white">
                <i class="fa-solid fa-magnifying-glass me-2"></i> Explore Activities
            </a>

            <a href="<?= base_url('user/safety') ?>" class="btn btn-info text-white btn-action shadow-lg">
                <i class="fa-solid fa-cloud-sun-rain me-2"></i> Check Sea Conditions
            </a>

            <a href="<?= base_url('user/booking') ?>" class="btn btn-light btn-action shadow-lg">
                <i class="fa-solid fa-calendar-check me-2"></i> Book Adventure
            </a>
        </div>
    </div>
</header>

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
                <a href="<?= base_url('user/activities') ?>#<?= $act[3] ?>" class="btn-view-details">
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
                <div class="data-item">
                    <span class="data-label"><i class="fa-solid fa-wind me-3 text-info"></i> Wind Speed</span>
                    <span class="data-value">10 knots</span>
                </div>
                
                <div class="data-item">
                    <span class="data-label"><i class="fa-solid fa-water me-3 text-info"></i> Wave Height</span>
                    <span class="data-value">0.9 meters</span>
                </div>
                
                <div class="data-item">
                    <span class="data-label"><i class="fa-solid fa-stopwatch me-3 text-info"></i> Wave Period</span>
                    <span class="data-value">5 seconds</span>
                </div>
                
                <div class="data-item">
                    <span class="data-label"><i class="fa-solid fa-shield-halved me-3 text-info"></i> Safety Status</span>
                    <span class="data-value text-success">🟢 SAFE FOR ACTIVITIES</span>
                </div>
                
                <div class="text-center mt-5">
                    <a href="<?= base_url('user/safety') ?>" class="btn-view-details">
                        View Full Detailed Report <i class="fa-solid fa-chevron-right ms-2"></i>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="container">
        <div class="cta-box shadow-lg">
            <h2 class="fw-bold mb-3">Ready for your next water adventure?</h2>
            <p class="opacity-75 mb-4">The waves are waiting. Check availability and book your slot today!</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?= base_url('user/booking') ?>" class="btn btn-info text-white btn-action px-5 shadow">
                    <i class="fa-solid fa-calendar-check me-2"></i> Book Now
                </a>
            </div>
        </div>
    </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
        function smartScroll() {
            const scrollIcon = document.getElementById("scrollIcon");
            // Check kung malapit na sa dulo (200px buffer)
            const isAtBottom = (window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 200);

            if (isAtBottom || scrollIcon.classList.contains("rotate-up")) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                // Interactive jump: 600px pababa
                window.scrollBy({ top: 600, left: 0, behavior: 'smooth' });
            }
        }

        window.addEventListener('scroll', function() {
            const scrollIcon = document.getElementById("scrollIcon");
            const scrollBtn = document.getElementById("scrollBtn");
            
            // Kalkulahin ang scroll percentage
            const scrollTotal = document.documentElement.scrollHeight - window.innerHeight;
            const scrollValue = window.scrollY / scrollTotal;
            
            // Kapag lumampas sa 80% ng page, iikot ang arrow ↑
            if (scrollValue > 0.8) {
                scrollIcon.classList.add("rotate-up");
                scrollBtn.style.background = "#48cae4"; // Accent Cyan
                scrollIcon.style.color = "#052c39";    // Deep Blue
            } else {
                scrollIcon.classList.remove("rotate-up");
                scrollBtn.style.background = "rgba(10, 88, 114, 0.8)";
                scrollIcon.style.color = "#48cae4";
            }
        });
    </script>

<div id="scrollBtn" onclick="smartScroll()" title="Navigate Page">
    <i class="fa-solid fa-arrow-down" id="scrollIcon"></i>
</div>

</body>
</html>