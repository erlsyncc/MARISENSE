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
            <a href="<?= base_url('user/calendar') ?>" class="nav-link-custom">Calendar</a>
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
    $activities = [
        [
            'name' => 'Jet Ski',
            'desc' => 'Ride across the open sea on a powerful jet ski. Perfect for thrill-seekers who enjoy speed and ocean adventure.',
            'details' => ['Duration: 15 minutes', 'Max Riders: 1–2 persons', 'Gear: Life vest', 'Difficulty: Moderate'],
            'images' => ['jetski1.jpg', 'jetski2.jpg', 'jetski3.jpg', 'jetski4.jpg']
        ],
        [
            'name' => 'Banana Boat',
            'desc' => 'A fun group ride on an inflatable banana-shaped boat pulled by a speedboat. Expect splashes and laughter.',
            'details' => ['Duration: 10 minutes', 'Max Riders: 6 persons', 'Difficulty: Easy', 'Best For: Groups'],
            'images' => ['banana1.jpg', 'banana2.jpg', 'banana3.jpg', 'banana4.jpg']
        ],
        [
            'name' => 'Kayaking',
            'desc' => 'Paddle along the calm waters and enjoy the scenic view of Matabungkay Beach.',
            'details' => ['Duration: 30 minutes', 'Max Riders: 1–2 persons', 'Difficulty: Easy'],
            'images' => ['kayak1.jpg', 'kayak2.jpg', 'kayak3.jpg', 'kayak4.jpg']
        ],
        [
            'name' => 'Flying Saucer',
            'desc' => 'An exciting inflatable ride that spins and glides across the waves.',
            'details' => ['Duration: 10 minutes', 'Max Riders: 4 persons', 'Difficulty: Moderate'],
            'images' => ['flying1.jpg', 'flying2.jpg', 'flying3.jpg', 'flying4.jpg']
        ]
    ];

    foreach($activities as $item): ?>
    
    <div class="d-flex flex-column align-items-start">
        <h1 class="activity-title"><?= $item['name'] ?></h1>
        <div class="activity-line"></div>
    </div>

    <div class="activity-container shadow-lg">
        <div class="row">
            <div class="col-lg-7 vertical-gallery">
                <?php foreach($item['images'] as $img): ?>
                    <img src="<?= base_url('images/' . $img) ?>" alt="<?= $item['name'] ?>">
                <?php endforeach; ?>
            </div>

            <div class="col-lg-5">
                <div class="info-panel p-lg-4">
                    <h2 class="fw-bold text-info mb-4">About the Activity</h2>
                    <p class="lead opacity-80 mb-4"><?= $item['desc'] ?></p>
                    
                    <div class="details-grid mb-4">
                        <?php foreach($item['details'] as $detail): ?>
                            <span class="detail-badge"><i class="fa-solid fa-check-circle me-2"></i><?= $detail ?></span>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-5 border-top border-secondary pt-4">
                        <p class="small opacity-60">Ready to ride?</p>
                        <a href="<?= base_url('user/booking') ?>" class="btn-book-now">Book <?= $item['name'] ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

    <div class="alert bg-transparent border-warning text-center p-5 rounded-4 mb-5" style="border: 2px dashed #ffc107 !important;">
        <h4 class="fw-bold text-warning mb-3"><i class="fa-solid fa-triangle-exclamation me-2"></i> Safety First</h4>
        <p class="mb-0 opacity-75">All activities are monitored by <strong>MARISENSE</strong>. We may suspend operations during high tide or strong winds.</p>
    </div>
</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text mb-4 opacity-75">For inquiries, message us through our social media platforms.</div>
        <div class="social-icons mb-4">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
</footer>

<script src="<?= base_url('bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>