<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; }
        
        .highlight-brand {
            font-weight: 700;
            color: #48cae4; /* Matches your accent cyan */
            text-shadow: 0 0 10px rgba(72, 202, 228, 0.4);
            letter-spacing: 1px;
        }
        
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

        /* Hero Header */
        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.6), rgba(5, 44, 57, 0.8)), 
                        url('<?= base_url('images/coveract.png') ?>'); 
            background-size: cover; background-position: center; background-attachment: fixed;
            padding: 120px 40px; color: white; border-radius: 0 0 80px 80px;
            text-align: center; display: flex; flex-direction: column; align-items: center;
        }

        /* Activity Section Styles */
        .activity-title { font-size: 2rem; text-align: center; font-weight: 700; color: white; margin-bottom: 5px; }
        .activity-line { height: 5px; width: 100px; background: var(--accent-cyan); border-radius: 10px; margin: 0 auto 40px auto; }
        
        .activity-container { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 40px; 
            padding: 50px; 
            margin-bottom: 100px; 
        }

        /* Vertical Image List */
        .vertical-gallery img {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 25px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: 0.4s ease;
        }
        .vertical-gallery img:hover { transform: scale(1.02); }

        .info-panel { position: sticky; top: 120px; }
        .detail-badge { 
            background: rgba(72, 202, 228, 0.15); 
            border: 1px solid var(--accent-cyan); 
            color: var(--accent-cyan); 
            padding: 8px 20px; 
            border-radius: 50px; 
            font-size: 0.9rem; 
            display: inline-block; 
            margin-bottom: 12px; 
            margin-right: 8px; 
        }

        .btn-book-now {
            background: var(--accent-cyan);
            color: var(--deep-blue);
            font-weight: 700;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
            margin-top: 20px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-book-now:hover { background: white; color: var(--deep-blue); transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        /* Footer Styles */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

        /* Gallery setup - ginawang mas maliit ang rows */
        .vertical-gallery {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 180px); /* Binabaan mula 220px para mas compact */
            gap: 12px;
        }

        .vertical-gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px; /* Mas malinis na corner */
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: 0.3s ease;
        }

        /* Container adjustment */
        .activity-container { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 30px; 
            padding: 30px; /* Binawasan ang padding para hindi masyadong malaki ang puting space */
            margin-bottom: 60px; /* Binawasan ang layo ng bawat activity section */
            max-width: 1100px; /* Nilimitahan ang lapad para maging "centered" focus */
            margin-left: auto;
            margin-right: auto;
        }

        /* Info Panel adjustment */
        .info-panel {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Pantay sa gitna ng pictures */
            height: 100%;
        }

        /* Idagdag ito sa <style> section */
        .activities-wrapper {
            padding-left: 10%;  /* Dynamic space sa left */
            padding-right: 10%; /* Dynamic space sa right */
            margin-top: 50px;
        }

        /* Para sa mas malalaking screen (Desktop), mas lalakihan natin ang space */
        @media (min-width: 1200px) {
            .activities-wrapper {
                padding-left: 150px;
                padding-right: 150px;
            }
        }

        /* Safety Section Styling */
        .safety-banner {
            border: 2px dashed #ffc107 !important;
            background: rgba(255, 193, 7, 0.05);
            border-radius: 30px;
            padding: 50px;
            max-width: 900px;
            margin: 0 auto 100px auto;
            position: relative;
            overflow: hidden;
        }

        .safety-wrapper {
            max-width: 1300px;
            margin: 80px auto; /* Centered container */
            text-align: center;
            padding: 40px;
            border: 2px dashed #ffc107;
            border-radius: 30px;
            background: rgba(255, 193, 7, 0.05);
        }

        .yellow-line-move {
            height: 4px;
            width: 80px;
            background: #ffc107;
            margin: 15px auto; /* Centered line */
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
    </style>
</head>
<body>

<nav class="waves-navbar">
    <div class="container header-container">
        <div class="user-greeting"><i class="fa-solid fa-circle-user me-2 text-info"></i> Hi, <span class="fw-bold"><?= auth()->user()->username ?></span></div>
        <div class="nav-menu-center d-none d-lg-flex">
            <a href="<?= base_url('user/home') ?>" class="nav-link-custom">Home</a>
            <a href="<?= base_url('user/activities') ?>" class="nav-link-custom active">Activities</a>
            <a href="<?= base_url('user/safety') ?>" class="nav-link-custom">Safety & Sea Conditions</a>
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom">Book & Reserve</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Water Adventures at Waves Water Sports</h1>
        <p class="lead mb-0 opacity-90 mx-auto" style="max-width: 800px;">
            Discover thrilling water activities designed for fun, excitement, and unforgettable experiences at Matabungkay Beach.
        </p>
    </div>
</header>

<div class="container">
    <?php 
// 1. Siguraduhin na nandito itong array na ito sa itaas ng foreach
$activities = [
    [
        'name' => 'Jet Ski',
        'desc' => 'Ride across the open sea on a powerful jet ski. Perfect for thrill-seekers who enjoy speed and ocean adventure.',
        'details' => [' Duration: 15 minutes', ' Max Riders: 1–2 persons', ' Gear: Life vest', ' Difficulty: Moderate'],
        'images' => ['jetski.jpg', 'jetski1.jpg', 'jetski2.jpg', 'jetski3.jpg']
    ],
    [
        'name' => 'Banana Boat',
        'desc' => 'A fun group ride on an inflatable banana-shaped boat pulled by a speedboat. Expect splashes and laughter.',
        'details' => [' Duration: 10 minutes', ' Max Riders: 6 persons', ' Difficulty: Easy', ' Best For: Groups'],
        'images' => ['bananaboats.jpg', 'banana1.jpg', 'banana2.jpg', 'banana3.jpg']
    ],
    [
        'name' => 'Kayaking',
        'desc' => 'Paddle along the calm waters and enjoy the scenic view of Matabungkay Beach.',
        'details' => [' Duration: 30 minutes', ' Max Riders: 1–2 persons', ' Difficulty: Easy'],
        'images' => ['kayak.jpg', 'kayak1.jpg', 'kayak2.jpg', 'kayak3.jpg']
    ],
    [
        'name' => 'Flying Saucer',
        'desc' => 'An exciting inflatable ride that spins and glides across the waves.',
        'details' => [' Duration: 10 minutes', ' Max Riders: 4 persons', ' Difficulty: Moderate'],
        'images' => ['flying.jpg', 'flying1.jpg', 'flying2.jpg', 'flying3.jpg']
    ]
];

// 2. Ngayon, safe na itong i-loop
foreach($activities as $item): ?>
    
    <div id="<?= strtolower(str_replace(' ', '-', $item['name'])) ?>" class="text-center w-100 mt-5">
        <h1 class="activity-title"><?= $item['name'] ?></h1>
        <div class="activity-line"></div>
    </div>

    <div class="container px-md-5">
        <div class="activity-container shadow-lg">
            <div class="row align-items-center">
                
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="vertical-gallery">
                        <?php foreach($item['images'] as $img): ?>
                            <img src="<?= base_url('images/' . $img) ?>" alt="<?= $item['name'] ?>">
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="info-panel p-lg-4">
                        <h2 class="fw-bold text-info mb-4">About the Activity: </h2>
                        <p class="lead opacity-80 mb-4" style="font-size: 1.1rem;"><?= $item['desc'] ?></p>
                        
                        <div class="details-grid mb-4">
                            <?php foreach($item['details'] as $detail): ?>
                                <span class="detail-badge">
                                    <i class="fa-solid fa-check-circle me-2"></i><?= $detail ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-4 border-top border-secondary pt-4 text-center">
                            <a href="<?= base_url('user/booking') ?>" class="btn-book-now w-100">
                                Book <?= $item['name'] ?>
                            </a>
                        </div>
                    </div>
                </div>

            </div> 
        </div> 
    </div>

<?php endforeach; ?>

    <div class="safety-wrapper shadow-sm">
        <h3 class="fw-bold text-warning mb-0">
            <i></i>⚠️ Safety First
        </h3>
        
        <div class="yellow-line-move"></div>
        
        <p class="mb-0 opacity-75" style="font-size: 1.1rem;">
            All activities are monitored by <span class="highlight-brand">MARISENSE</span>. 
            We may suspend operations during high tide or strong winds to ensure your protection.
        </p>
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

<script src="<?= base_url('bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>