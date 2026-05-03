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
        body {font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--ocean-blue) 0%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh}
        .highlight-brand {font-weight: 700;color: #48cae4;text-shadow: 0 0 10px rgba(72, 202, 228, 0.4);letter-spacing: 1px;}
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
        .btn-help-custom {color: #48cae4; font-weight: 600;font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(72,202,228,0.5);border-radius: 50px;background: rgba(72,202,228,0.08);cursor: pointer;transition: 0.3s;}
        .btn-help-custom:hover { background: rgba(72,202,228,0.2);border-color: var(--accent-cyan);}
        /* ============================================================
           ADDED: HELP MODAL STYLES
           ============================================================ */
        #helpModal { position: fixed;top: 0; left: 0;width: 100%; height: 100%; background: rgba(5,44,57,0.88);backdrop-filter: blur(8px); z-index: 9999; display: flex; align-items: center;justify-content: center;padding: 20px; animation: fadeInModal 0.25s ease;}
        #helpModal.d-none { display: none !important; }
        @keyframes fadeInModal {from { opacity: 0; transform: scale(0.96); } to   { opacity: 1; transform: scale(1); }}
        .help-modal-box { background: #0a3d52; border: 1px solid rgba(72,202,228,0.35);border-radius: 30px; padding: 40px;max-width: 780px; width: 100%;box-shadow: 0 30px 60px rgba(0,0,0,0.5);}
        .help-modal-header {  display: flex;justify-content: space-between;align-items: center;margin-bottom: 28px;}
        .help-modal-title {color: #48cae4; font-size: 1.3rem; font-weight: 700;margin: 0;}
        .btn-close-help { background: none;border: 1px solid rgba(255,255,255,0.25);color: white;border-radius: 50px;padding: 6px 20px;cursor: pointer;font-size: 0.85rem;transition: 0.3s;}
        .btn-close-help:hover { background: rgba(255,255,255,0.1); }
        .help-grid {display: grid;grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 600px) { .help-grid { grid-template-columns: 1fr; } }
        .help-item { background: rgba(255,255,255,0.05); border-left: 4px solid #48cae4;border-radius: 14px; padding: 18px 20px; transition: 0.3s;}
        .help-item:hover { background: rgba(72,202,228,0.08); transform: translateX(4px); }
        .help-item strong { color: #48cae4;display: block;margin-bottom: 8px;font-size: 0.92rem;}
        .help-item p { color: rgba(255,255,255,0.75); font-size: 0.85rem; margin: 0;line-height: 1.6;}
        .help-modal-footer { margin-top: 28px; text-align: center;color: rgba(255,255,255,0.4);font-size: 0.8rem;}
        /* ============================================================ */
        .welcome-hero {background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)),  url('<?= base_url('images/coveract.png') ?>');  background-size: cover;background-position: center;background-attachment: fixed;padding: 145px 40px;color: white;border-radius: 0 0 80px 80px; margin-bottom: 60px;}
        /* Activity Section Styles */
        .activity-title { font-size: 2rem; text-align: center; font-weight: 700; color: white; margin-bottom: 5px; }
        .activity-line { height: 5px; width: 100px; background: var(--accent-cyan); border-radius: 10px; margin: 0 auto 40px auto; }
        .activity-container {  background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1);  border-radius: 40px;  padding: 50px;  margin-bottom: 100px; 
        }
        /* Vertical Image List */
        .vertical-gallery img { width: 100%; height: 450px;object-fit: cover; border-radius: 25px; margin-bottom: 20px;box-shadow: 0 10px 30px rgba(0,0,0,0.3);transition: 0.4s ease;}
        .vertical-gallery img:hover { transform: scale(1.02); }
        .info-panel { position: sticky; top: 120px; }
        .detail-badge {  background: rgba(72, 202, 228, 0.15); border: 1px solid var(--accent-cyan); color: var(--accent-cyan);  padding: 8px 20px; border-radius: 50px; font-size: 0.9rem;  display: inline-block; margin-bottom: 12px; margin-right: 8px; }
        .btn-book-now {background: var(--accent-cyan); color: var(--deep-blue);font-weight: 700; padding: 15px 40px; border-radius: 50px;text-decoration: none;transition: 0.3s; display: inline-block;margin-top: 20px; border: none; text-transform: uppercase; letter-spacing: 1px; }
        .btn-book-now:hover { background: white; color: var(--deep-blue); transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        /* Footer Styles */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }
        /* Gallery setup */
        .vertical-gallery { display: grid;grid-template-columns: repeat(2, 1fr);grid-template-rows: repeat(2, 180px);gap: 12px;}
        .vertical-gallery img { width: 100%; height: 100%; object-fit: cover; border-radius: 15px;box-shadow: 0 4px 12px rgba(0,0,0,0.2);transition: 0.3s ease; }
        /* Container adjustment */
        .activity-container { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px);  border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 30px; padding: 30px;margin-bottom: 60px;max-width: 1100px; margin-left: auto; margin-right: auto; }
        /* Info Panel adjustment */
        .info-panel {display: flex;flex-direction: column; justify-content: center;   height: 100%;
        }
        .activities-wrapper {padding-left: 10%; padding-right: 10%; margin-top: 50px;}
        @media (min-width: 1200px) {.activities-wrapper { padding-left: 150px;padding-right: 150px; } }
        /* Safety Section Styling */
        .safety-banner { border: 2px dashed #ffc107 !important;background: rgba(255, 193, 7, 0.05);border-radius: 30px; padding: 50px; max-width: 900px; margin: 0 auto 100px auto; position: relative; overflow: hidden;}
        .safety-wrapper {  max-width: 1300px; margin: 80px auto; text-align: center;padding: 40px;border: 2px dashed #ffc107;border-radius: 30px; background: rgba(255, 193, 7, 0.05);}
        .yellow-line-move {height: 4px; width: 80px;background: #ffc107; margin: 15px auto;border-radius: 10px;position: relative;overflow: hidden;}
        .yellow-line-move::after {content: ""; position: absolute;top: 0; left: -100%;width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);animation: shine 2s infinite;}
        @keyframes shine { 0% { left: -100%; }100% { left: 100%; }}
        #scrollBtn {position: fixed;right: 20px;top: 50%; transform: translateY(-50%); z-index: 1000;  width: 50px;height: 150px; background: rgba(10, 88, 114, 0.85);backdrop-filter: blur(10px);border: 3px solid var(--accent-cyan);border-radius: 60px;display: flex; align-items: center;justify-content: center;color: var(--accent-cyan);cursor: pointer;transition: all 0.3s ease;box-shadow: 0 15px 35px rgba(0,0,0,0.4);}
        #scrollBtn:hover { background: var(--accent-cyan);color: var(--deep-blue);right: 25px;}
        #scrollBtn i {font-size: 2.5rem;transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55); margin: 0 auto; }
        .rotate-up {transform: rotate(180deg);}
        html {scroll-behavior: smooth;}
        .tooltip-btn { position: relative; cursor: pointer;}
        .tooltip-btn::after { content: attr(data-tooltip);position: absolute;bottom: 120%; left: 50%;transform: translateX(-50%); background: var(--deep-blue); color: white;padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; white-space: nowrap;opacity: 0;visibility: hidden;transition: 0.3s ease; pointer-events: none;border: 1px solid var(--accent-cyan);z-index: 1050;box-shadow: 0 5px 15px rgba(0,0,0,0.3);}
        .tooltip-btn:hover::after { opacity: 1; visibility: visible; }
        /* ── SEARCH ICON BUTTON ── */
        .btn-search-custom {color: #48cae4;  font-size: 1.1rem; padding: 8px 12px;border: 1px solid rgba(72,202,228,0.5);border-radius: 50px;background: rgba(72,202,228,0.08);cursor: pointer;transition: 0.3s; display: flex;align-items: center;justify-content: center;}
        .btn-search-custom:hover {background: rgba(72,202,228,0.2); border-color: #48cae4;}
        /* ── SEARCH OVERLAY ── */
        #searchOverlay { position: fixed; top: 0; left: 0;width: 100%; height: 100%;background: rgba(5,44,57,0.92); backdrop-filter: blur(10px); z-index: 99999;display: flex; flex-direction: column;align-items: center; padding-top: 100px; animation: fadeInSearch 0.2s ease;}
        #searchOverlay.d-none { display: none !important; }
        @keyframes fadeInSearch {from { opacity: 0; transform: translateY(-10px); } to   { opacity: 1; transform: translateY(0); }}
        .search-overlay-inner {width: 100%; max-width: 640px;padding: 0 20px;}
        .search-overlay-bar { display: flex;align-items: center; gap: 12px;background: #0a3d52;  border: 1.5px solid rgba(72,202,228,0.5); border-radius: 16px; padding: 14px 18px; margin-bottom: 12px;}
        .search-overlay-bar i {color: #48cae4;font-size: 1rem;flex-shrink: 0;}
        .search-overlay-input { flex: 1;background: none; border: none;outline: none; color: #fff; font-size: 1rem;font-family: 'Poppins', sans-serif; }
        .search-overlay-input::placeholder { color: rgba(255,255,255,0.35); }
        .btn-close-search { background: none;border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.6);border-radius: 50px; padding: 5px 14px;font-size: 0.78rem;cursor: pointer; font-family: 'Poppins', sans-serif; transition: 0.2s;white-space: nowrap;}
        .btn-close-search:hover { background: rgba(255,255,255,0.1); color: #fff; }
        .search-results-box {background: #0a3d52; border: 1px solid rgba(72,202,228,0.25);border-radius: 16px;overflow: hidden; max-height: 420px;overflow-y: auto;}
        .sdn-section-label {font-size: 0.62rem;font-weight: 700;text-transform: uppercase;letter-spacing: 1.5px;color: rgba(72,202,228,0.7);padding: 10px 16px 4px;background: rgba(72,202,228,0.05);}
        .sdn-item {display: flex;align-items: center;gap: 12px;padding: 11px 16px;border-bottom: 1px solid rgba(255,255,255,0.05);text-decoration: none;color: #fff;transition: 0.15s;}
        .sdn-item:last-child { border-bottom: none; }
        .sdn-item:hover { background: rgba(72,202,228,0.1); }
        .sdn-icon {width: 34px; height: 34px;border-radius: 9px;background: rgba(72,202,228,0.12);display: flex; align-items: center; justify-content: center;color: #48cae4;flex-shrink: 0;}
        .sdn-title { font-size: 0.85rem; font-weight: 600; line-height: 1.2; }
        .sdn-sub   { font-size: 0.72rem; color: rgba(255,255,255,0.45); margin-top: 2px; }
        .sdn-no-result {text-align: center;padding: 30px;color: rgba(255,255,255,0.4);font-size: 0.88rem;}
        .sdn-hint {text-align: center; padding: 20px;color: rgba(255,255,255,0.3);font-size: 0.8rem;}
        .sdn-highlight {background: rgba(72,202,228,0.25);color: #48cae4;border-radius: 2px;padding: 0 2px;}
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
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <!-- UPDATED: added Help button beside Logout -->
        <div class="logout-wrapper">
            <!-- SEARCH ICON -->
            <button class="btn-search-custom" onclick="openSearch()" title="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <!-- HELP -->
            <button class="btn-help-custom" onclick="document.getElementById('helpModal').classList.remove('d-none')">
                <i class="fa-solid fa-circle-question me-1"></i> Help
            </button>
            <!-- LOGOUT -->
            <a href="<?= base_url('logout') ?>" class="btn-logout-custom">
                <i class="fa-solid fa-power-off me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">Discover Exciting Water Activities</h1>
        <p class="lead mb-0 opacity-90 mx-auto" style="max-width: 800px;">
            Experience thrilling adventures at Matabungkay Beach—from high-speed jet skiing to fun group rides. Choose your perfect activity and get ready for an unforgettable day on the water.
        </p>
    </div>
</header>

<div class="container">
    <?php foreach($activities as $item):
    // Build images array: cover first, then extra images from DB
    $coverImg   = $item['image'] ?? null;
    $extraImgs  = ! empty($item['images']) ? json_decode($item['images'], true) : [];
    $allImages  = array_filter(array_merge(
        $coverImg ? [$coverImg] : [],
        is_array($extraImgs) ? $extraImgs : []
    ));
    // Pad to 4 slots with cover image if fewer uploaded
    while (count($allImages) < 4 && $coverImg) {
        $allImages[] = $coverImg;
    }
    $allImages = array_slice($allImages, 0, 4);

    // Format price display
    $priceLabel = number_format((float)$item['price'], 2);
    if (($item['price_type'] ?? 'flat') === 'per_person') {
        $priceLabel .= ' / person';
    } else {
        $priceLabel .= ' / session';
    }

    // Build details array from DB fields
    $details = [];
    if (! empty($item['duration']))   $details[] = 'Duration: ' . $item['duration'] . ' mins';
    if (! empty($item['max_riders'])) $details[] = 'Max Riders: ' . $item['max_riders'];
    if (! empty($item['gear']))       $details[] = 'Gear: ' . $item['gear'];
    if (! empty($item['difficulty'])) $details[] = 'Difficulty: ' . $item['difficulty'];
?>

    <div id="<?= strtolower(str_replace(' ', '-', $item['name'])) ?>" class="text-center w-100 mt-5">
        <h1 class="activity-title"><?= esc($item['name']) ?></h1>
        <div class="activity-line"></div>
    </div>

    <div class="container px-md-5">
        <div class="activity-container shadow-lg">
            <div class="row align-items-center">

                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="vertical-gallery">
                        <?php foreach($allImages as $img): ?>
                            <img src="<?= base_url('images/' . esc($img)) ?>" alt="<?= esc($item['name']) ?>">
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="info-panel p-lg-4">
                        <h2 class="fw-bold text-info mb-4">About the Activity:</h2>
                        <p class="lead opacity-80 mb-4" style="font-size: 1.1rem;">
                            <?= esc($item['description'] ?? 'No description available.') ?>
                        </p>

                        <!-- Price Badge -->
                        <div class="mb-3">
                            <span class="detail-badge" style="font-size:1rem; font-weight:700;">
                                <i class="fa-solid fa-peso-sign me-1"></i><?= $priceLabel ?>
                            </span>
                        </div>

                        <div class="details-grid mb-4">
                            <?php foreach($details as $detail): ?>
                                <span class="detail-badge">
                                    <i class="fa-solid fa-check-circle me-2"></i><?= esc($detail) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                        <div class="mt-4 border-top border-secondary pt-4 text-center">
                            <a href="<?= base_url('user/booking?activity=' . urlencode($item['name'])) ?>"
                               class="btn-book-now tooltip-btn"
                               data-tooltip="Click here to book <?= esc($item['name']) ?>">
                                Book <?= esc($item['name']) ?>
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

<script src="<?= base_url('bootstrap5/js/bootstrap.bundle.min.js') ?>"></script>

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
        /* ═══════════════════════════════════
   GLOBAL SEARCH — User Side
   Add before </body> on every user page.
═══════════════════════════════════ */
(function () {
    const BASE = (typeof CI_BASE_URL !== 'undefined') ? CI_BASE_URL : '/';

    const SEARCH_INDEX = [
        /* HOME */
        { section: 'Home', title: 'Home Dashboard',     sub: 'Activities, sea conditions & reviews at a glance', icon: 'fa-house',           url: BASE + 'user/home' },
        { section: 'Home', title: 'Live Buoy Data',     sub: 'Real-time MARISENSE buoy monitoring widget',       icon: 'fa-satellite-dish',  url: BASE + 'user/home' },
        { section: 'Home', title: 'Find Us on Map',     sub: 'Matabungkay Beach, Lian, Batangas',                icon: 'fa-location-dot',    url: BASE + 'user/home' },
        { section: 'Home', title: 'About Us',           sub: 'About Waves Water Sports and our commitments',     icon: 'fa-circle-info',     url: BASE + 'user/home' },
        /* ACTIVITIES */
        { section: 'Activities', title: 'All Activities',   sub: 'Browse all available water sports',                    icon: 'fa-person-swimming',  url: BASE + 'user/activities' },
        { section: 'Activities', title: 'Jet Ski',          sub: 'High-speed water adventure',                           icon: 'fa-water',            url: BASE + 'user/activities#jet-ski' },
        { section: 'Activities', title: 'Banana Boat',      sub: 'Fun group ride for families and friends',              icon: 'fa-ship',             url: BASE + 'user/activities#banana-boat' },
        { section: 'Activities', title: 'Kayaking',         sub: 'Explore calm coastal waters peacefully',               icon: 'fa-sailboat',         url: BASE + 'user/activities#kayaking' },
        { section: 'Activities', title: 'Flying Saucer',    sub: 'Glide and spin thrillingly on the water surface',      icon: 'fa-circle-radiation', url: BASE + 'user/activities#flying-saucer' },
        /* BOOK & RESERVE */
        { section: 'Book & Reserve', title: 'Book an Activity',    sub: 'Select your water sport and reserve a slot',   icon: 'fa-calendar-check', url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'Choose Date & Time',  sub: 'Pick an available date and time slot',         icon: 'fa-clock',          url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'GCash Payment',       sub: 'Pay 50% down payment or full via GCash',       icon: 'fa-peso-sign',      url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'Number of Participants', sub: 'Set number of riders per activity',          icon: 'fa-users',          url: BASE + 'user/booking' },
        { section: 'Book & Reserve', title: 'Special Requests',    sub: 'Add health concerns or special needs',          icon: 'fa-note-sticky',    url: BASE + 'user/booking' },
        /* MY BOOKINGS */
        { section: 'My Bookings', title: 'My Reservations',  sub: 'View all your active and past bookings',          icon: 'fa-list-check',      url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Booking Status',   sub: 'Pending, Confirmed, Completed, Cancelled',        icon: 'fa-circle-check',    url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Pay Balance',      sub: 'Pay remaining balance via GCash',                  icon: 'fa-credit-card',     url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Booking Code',     sub: 'Find booking by code or activity name',            icon: 'fa-barcode',         url: BASE + 'user/my-bookings' },
        { section: 'My Bookings', title: 'Cancel Booking',   sub: 'Free cancellation up to 24 hrs before schedule',   icon: 'fa-ban',             url: BASE + 'user/my-bookings' },
        /* SAFETY */
        { section: 'Safety & Sea Conditions', title: 'Sea Conditions Overview', sub: 'Full MARISENSE live data dashboard',              icon: 'fa-tower-broadcast', url: BASE + 'user/safety' },
        { section: 'Safety & Sea Conditions', title: 'Wind Speed',              sub: 'Current wind speed reading in knots',              icon: 'fa-wind',            url: BASE + 'user/safety#marisense-section' },
        { section: 'Safety & Sea Conditions', title: 'Wave Height',             sub: 'Live buoy wave height in meters',                  icon: 'fa-water',           url: BASE + 'user/safety#marisense-section' },
        { section: 'Safety & Sea Conditions', title: 'Wave Period',             sub: 'Wave frequency measured in seconds',               icon: 'fa-wave-square',     url: BASE + 'user/safety#marisense-section' },
        { section: 'Safety & Sea Conditions', title: 'Safety Status',           sub: 'Safe / Moderate / Unsafe activity indicator',      icon: 'fa-shield-halved',   url: BASE + 'user/safety' },
        { section: 'Safety & Sea Conditions', title: 'About MARISENSE',         sub: 'Smart marine monitoring system overview',          icon: 'fa-circle-info',     url: BASE + 'user/safety' },
        { section: 'Safety & Sea Conditions', title: 'Safety Protocol',         sub: 'Wind and wave thresholds for activity suspension', icon: 'fa-triangle-exclamation', url: BASE + 'user/safety' },
        /* REVIEWS */
        { section: 'Reviews', title: 'Read Reviews',    sub: 'Browse feedback from fellow adventurers',              icon: 'fa-star',          url: BASE + 'user/reviews' },
        { section: 'Reviews', title: 'Write a Review',  sub: 'Share your experience after completing an activity',   icon: 'fa-pen-to-square', url: BASE + 'user/reviews' },
        { section: 'Reviews', title: 'Star Rating',     sub: 'Rate your activity experience from 1 to 5 stars',      icon: 'fa-star-half-stroke', url: BASE + 'user/reviews' },
        { section: 'Reviews', title: 'Felt Safe',       sub: 'Indicate whether you felt safe during the activity',   icon: 'fa-shield-halved', url: BASE + 'user/reviews' },
    ];

    function escRe(s) { return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'); }

    function hl(text, q) {
        if (!q) return text;
        return text.replace(new RegExp('(' + escRe(q) + ')', 'gi'),
            '<span class="sdn-highlight">$1</span>');
    }

    window.openSearch = function () {
        document.getElementById('searchOverlay').classList.remove('d-none');
        setTimeout(function () {
            var inp = document.getElementById('globalSearchInput');
            if (inp) { inp.value = ''; inp.focus(); }
            document.getElementById('searchResultsBox').innerHTML =
                '<div class="sdn-hint"><i class="fa-solid fa-magnifying-glass me-2"></i>Start typing to search the entire system…</div>';
        }, 60);
    };

    window.closeSearch = function () {
        document.getElementById('searchOverlay').classList.add('d-none');
    };

    window.runGlobalSearch = function (q) {
        var box = document.getElementById('searchResultsBox');
        q = q.trim();

        if (!q) {
            box.innerHTML = '<div class="sdn-hint"><i class="fa-solid fa-magnifying-glass me-2"></i>Start typing to search the entire system…</div>';
            return;
        }

        var hits = SEARCH_INDEX.filter(function (it) {
            return (it.title + ' ' + it.sub + ' ' + it.section)
                .toLowerCase().includes(q.toLowerCase());
        }).slice(0, 14);

        if (!hits.length) {
            box.innerHTML = '<div class="sdn-no-result"><i class="fa-solid fa-circle-xmark me-2" style="color:rgba(255,100,100,0.6);"></i>No results found for <strong>"' + q + '"</strong></div>';
            return;
        }

        var sections = [...new Set(hits.map(function (h) { return h.section; }))];
        var html = '';
        sections.forEach(function (sec) {
            html += '<div class="sdn-section-label"><i class="fa-solid fa-folder-open me-1"></i>' + sec + '</div>';
            hits.filter(function (h) { return h.section === sec; }).forEach(function (it) {
                html += '<a class="sdn-item" href="' + it.url + '" onclick="closeSearch()">'
                      + '<div class="sdn-icon"><i class="fa-solid ' + it.icon + '" style="font-size:13px;"></i></div>'
                      + '<div><div class="sdn-title">' + hl(it.title, q) + '</div>'
                      + '<div class="sdn-sub">' + hl(it.sub, q) + '</div></div>'
                      + '</a>';
            });
        });

        box.innerHTML = html;
    };

    /* Close on Escape or clicking the backdrop */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSearch();
    });

    document.getElementById('searchOverlay').addEventListener('click', function (e) {
        if (e.target === this) closeSearch();
    });
})();
    </script>
    

<div id="scrollBtn" onclick="smartScroll()" title="Navigate Page">
    <i class="fa-solid fa-arrow-down" id="scrollIcon"></i>
</div>

<script>const CI_BASE_URL = "<?= base_url() ?>";</script>
<!-- GLOBAL SEARCH OVERLAY -->
<div id="searchOverlay" class="d-none">
    <div class="search-overlay-inner">
        <div class="search-overlay-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input class="search-overlay-input"
                   id="globalSearchInput"
                   type="text"
                   placeholder="Search activities, bookings, sea conditions…"
                   autocomplete="off"
                   oninput="runGlobalSearch(this.value)">
            <button class="btn-close-search" onclick="closeSearch()">
                <i class="fa-solid fa-xmark me-1"></i> Close
            </button>
        </div>
        <div id="searchResultsBox" class="search-results-box">
            <div class="sdn-hint">
                <i class="fa-solid fa-magnifying-glass me-2"></i>
                Start typing to search the entire system…
            </div>
        </div>
    </div>
</div>
<!-- END GLOBAL SEARCH OVERLAY -->
</body>
</html>