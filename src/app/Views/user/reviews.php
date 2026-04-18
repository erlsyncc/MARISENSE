<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; min-height: 100vh; }
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
        .welcome-hero {background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), url('<?= base_url('images/reviews_bg.png') ?>'); background-size: cover; background-position: center;background-attachment: fixed;padding: 145px 40px;color: white;border-radius: 0 0 80px 80px;margin-bottom: 60px;}
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 20px; }
        .page-container { max-width: 1200px; margin: 0 auto 80px; padding: 0 24px; }
        /* Stats */
        .stats-strip { display: grid; grid-template-columns: repeat(3,1fr); gap: 14px; margin-bottom: 28px; }
        .stat-box { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 18px; padding: 20px; text-align: center; }
        .stat-value { font-size: 1.8rem; font-weight: 700; color: var(--accent-cyan); }
        .stat-label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.5); margin-top: 2px; }
        /* Reviews grid */
        .reviews-layout { display: grid; grid-template-columns: 1fr 400px; gap: 24px; align-items: start; }
        .reviews-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px; }
        .review-card { background: rgba(255,255,255,0.07); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 22px; transition: 0.3s; }
        .review-card:hover { transform: translateY(-3px); border-color: rgba(72,202,228,0.25); }
        .review-avatar { width: 40px; height: 40px; border-radius: 50%; background: rgba(72,202,228,0.15); display: flex; align-items: center; justify-content: center; font-size: 0.88rem; font-weight: 700; color: var(--accent-cyan); flex-shrink: 0; }
        .reviewer-name { font-size: 0.92rem; font-weight: 700; color: white; }
        .review-date { font-size: 0.72rem; color: rgba(255,255,255,0.4); }
        .stars { color: #ffc107; font-size: 0.85rem; }
        .review-text { font-size: 0.83rem; color: rgba(255,255,255,0.75); line-height: 1.65; margin: 10px 0; }
        .badge-activity { background: rgba(10,88,114,0.6); color: var(--accent-cyan); border: 1px solid rgba(72,202,228,0.25); padding: 3px 11px; border-radius: 50px; font-size: 0.7rem; font-weight: 600; }
        .badge-safe { background: rgba(40,167,69,0.12); color: #5ddb8a; border: 1px solid rgba(40,167,69,0.3); padding: 3px 11px; border-radius: 50px; font-size: 0.7rem; font-weight: 600; }
        .badge-unsafe { background: rgba(255,193,7,0.12); color: #ffc107; border: 1px solid rgba(255,193,7,0.3); padding: 3px 11px; border-radius: 50px; font-size: 0.7rem; font-weight: 600; }
        /* Write review form */
        .review-form-card { background: rgba(255,255,255,0.08); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.15); border-radius: 24px; padding: 28px; position: sticky; top: 82px; }
        .form-title { font-size: 1rem; font-weight: 700; margin-bottom: 4px; }
        .field-label { display: block; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--accent-cyan); margin-bottom: 6px; }
        .form-control-wave, .form-select-wave { width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; color: white; padding: 11px 14px; font-family: 'Poppins',sans-serif; font-size: 0.88rem; transition: 0.3s; outline: none; -webkit-appearance: none; }
        .form-control-wave:focus, .form-select-wave:focus { border-color: rgba(72,202,228,0.6); background: rgba(255,255,255,0.1); }
        .form-control-wave::placeholder { color: rgba(255,255,255,0.3); }
        .form-select-wave option { background: #073d52; }
        textarea.form-control-wave { resize: vertical; min-height: 90px; }
        .mb-field { margin-bottom: 14px; }
        /* Star rating input */
        .star-rating { display: flex; gap: 6px; flex-direction: row-reverse; justify-content: flex-end; }
        .star-rating input { display: none; }
        .star-rating label { font-size: 1.5rem; cursor: pointer; color: rgba(255,255,255,0.2); transition: 0.2s; }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label { color: #ffc107; }
        .btn-submit { background: linear-gradient(135deg, var(--accent-cyan), #0077b6); border: none; border-radius: 12px; padding: 12px; font-weight: 700; color: white; transition: 0.3s; width: 100%; font-size: 0.9rem; cursor: pointer; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,119,182,0.3); }
        /* Locked state */
        .review-locked { background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.15); border-radius: 16px; padding: 24px; text-align: center; }
        .review-locked i { font-size: 2rem; opacity: 0.4; display: block; margin-bottom: 12px; }
        .review-locked p { font-size: 0.85rem; opacity: 0.65; margin: 0 0 16px; }
        .btn-book-now { display: inline-flex; align-items: center; gap: 8px; background: rgba(72,202,228,0.15); border: 1px solid rgba(72,202,228,0.4); color: var(--accent-cyan); padding: 10px 22px; border-radius: 50px; font-weight: 700; font-size: 0.85rem; text-decoration: none; transition: 0.2s; }
        .btn-book-now:hover { background: var(--accent-cyan); color: var(--deep-blue); }
        .completed-list { max-height: 180px; overflow-y: auto; margin-bottom: 14px; }
        .completed-item { background: rgba(40,167,69,0.1); border: 1px solid rgba(40,167,69,0.25); border-radius: 10px; padding: 8px 12px; margin-bottom: 6px; font-size: 0.8rem; }
        .completed-item:last-child { margin-bottom: 0; }
        .filter-row { display: flex; gap: 8px; margin-bottom: 18px; flex-wrap: wrap; }
        .filter-btn { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.7); padding: 6px 16px; border-radius: 50px; font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .filter-btn.active, .filter-btn:hover { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); }
        .empty-state { text-align: center; padding: 40px; opacity: 0.5; }
        .empty-state i { font-size: 2rem; display: block; margin-bottom: 10px; }
        /* Footer Styles */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }
        @media (max-width: 992px) { .reviews-layout { grid-template-columns: 1fr; } .review-form-card { position: static; } }
    </style>
</head>
<body>

<nav class="waves-navbar">
    <div class="container header-container">
        <div class="user-greeting"><i class="fa-solid fa-circle-user me-2 text-info"></i> Hi, <span class="fw-bold"><?= auth()->user()->username ?></span></div>
        <div class="nav-menu-center d-none d-lg-flex">
            <a href="<?= base_url('user/home') ?>" class="nav-link-custom">Home</a>
            <a href="<?= base_url('user/activities') ?>" class="nav-link-custom">Activities</a>
            <a href="<?= base_url('user/safety') ?>" class="nav-link-custom">Safety & Sea Conditions</a>
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom">Book & Reserve</a>
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom active">Reviews</a>
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
        <h1 class="display-5 fw-bold mb-2">Adventure Reviews</h1>
        <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 800px;">
            Read helpful feedback from fellow adventurers to guide your choices better.
            And share your experience and help others discover the best activities available.
        </p>
    </div>
</header>

<div class="page-container">

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success rounded-4 mb-4"><i class="fa-solid fa-circle-check me-2"></i><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger rounded-4 mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- STATS -->
    <?php
        $totalReviews = count($reviews ?? []);
        $safeCount    = count(array_filter($reviews ?? [], fn($r) => strtolower($r['safe_feel'] ?? '') === 'yes'));
    ?>
    <div class="stats-strip">
        <div class="stat-box">
            <div class="stat-value"><?= $totalReviews ?></div>
            <div class="stat-label">Total Reviews</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" style="color:#ffc107;">
                <?= $totalReviews > 0 ? number_format(array_sum(array_column($reviews, 'rating')) / $totalReviews, 1) : '—' ?>
                <?php if ($totalReviews > 0): ?><i class="fa-solid fa-star" style="font-size:1.1rem;"></i><?php endif; ?>
            </div>
            <div class="stat-label">Average Rating</div>
        </div>
        <div class="stat-box">
            <div class="stat-value" style="color:#5ddb8a;"><?= $totalReviews > 0 ? round($safeCount / $totalReviews * 100) : 0 ?>%</div>
            <div class="stat-label">Felt Safe</div>
        </div>
    </div>

    <div class="reviews-layout">
        <!-- LEFT: Reviews feed -->
        <div>
            <div class="filter-row">
                <button class="filter-btn active" onclick="setFilter('all',this)">All Activities</button>
                <button class="filter-btn" onclick="setFilter('jet ski',this)">Jet Ski</button>
                <button class="filter-btn" onclick="setFilter('banana boat',this)">Banana Boat</button>
                <button class="filter-btn" onclick="setFilter('kayaking',this)">Kayaking</button>
                <button class="filter-btn" onclick="setFilter('flying saucer',this)">Flying Saucer</button>
            </div>
            <div class="reviews-grid" id="reviewsGrid">
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $r): ?>
                        <?php
                            $stars    = (int)($r['rating'] ?? 5);
                            $initials = strtoupper(substr($r['username'] ?? 'U', 0, 2));
                            $safeClass = strtolower($r['safe_feel'] ?? 'yes') === 'yes' ? 'badge-safe' : 'badge-unsafe';
                        ?>
                        <div class="review-card" data-activity="<?= strtolower($r['activity'] ?? '') ?>">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="review-avatar"><?= $initials ?></div>
                                <div>
                                    <div class="reviewer-name"><?= esc($r['username'] ?? 'Anonymous') ?></div>
                                    <div class="review-date"><?= isset($r['created_at']) ? date('M d, Y', strtotime($r['created_at'])) : '' ?></div>
                                </div>
                            </div>
                            <div class="stars mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fa-<?= $i <= $stars ? 'solid' : 'regular' ?> fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="review-text"><?= esc($r['review_text'] ?? '') ?></p>
                            <?php if (!empty($r['photo'])): ?>
                                <img src="<?= base_url('uploads/reviews/' . $r['photo']) ?>" class="img-fluid rounded-3 mb-3 shadow-sm" style="max-height:130px;cursor:pointer;border:1px solid rgba(255,255,255,0.1);" onclick="window.open(this.src)">
                            <?php endif; ?>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge-activity"><?= esc($r['activity'] ?? 'N/A') ?></span>
                                <span class="<?= $safeClass ?>"><i class="fa-solid fa-shield-halved me-1"></i>Felt <?= ucfirst(esc($r['safe_feel'] ?? 'Safe')) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state" style="grid-column:1/-1;">
                        <i class="fa-solid fa-star-half-stroke"></i>
                        <p>No reviews yet. Be the first to share your adventure!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT: Write a Review (only for users with completed bookings) -->
        <div>
            <div class="review-form-card">
                <?php
                    // Check if this user has any completed bookings
                    $db = \Config\Database::connect();
                    $completedBookings = $db->table('bookings')
                        ->where('user_id', auth()->user()->id)
                        ->where('status', 'completed')
                        ->get()->getResultArray();
                    $canReview = count($completedBookings) > 0;
                ?>

                <?php if ($canReview): ?>
                    <div class="form-title"><i class="fa-solid fa-pen-to-square me-2" style="color:var(--accent-cyan);"></i>Write a Review</div>
                    <p style="font-size:0.78rem;color:rgba(255,255,255,0.5);margin-bottom:16px;">Share your adventure experience!</p>

                    <?php if (!empty($completedBookings)): ?>
                    <div class="mb-field">
                        <label class="field-label">Your Completed Activities</label>
                        <div class="completed-list">
                            <?php foreach ($completedBookings as $cb): ?>
                            <div class="completed-item">
                                <i class="fa-solid fa-circle-check me-2" style="color:#5ddb8a;"></i>
                                <strong><?= esc($cb['activity_name']) ?></strong>
                                <span style="opacity:0.6;font-size:0.75rem;"> — <?= date('M d, Y', strtotime($cb['date'])) ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <form action="<?= base_url('user/post-review') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-field">
                            <label class="field-label">Activity</label>
                            <select name="activity" class="form-select-wave" required>
                                <option value="">— Select activity —</option>
                                <?php
                                    $doneActivities = array_unique(array_column($completedBookings, 'activity_name'));
                                    foreach ($doneActivities as $act):
                                ?>
                                <option value="<?= esc($act) ?>"><?= esc($act) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-field">
                            <label class="field-label">Your Rating</label>
                            <div class="star-rating">
                                <input type="radio" name="stars" id="s5" value="5"><label for="s5"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="stars" id="s4" value="4"><label for="s4"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="stars" id="s3" value="3" checked><label for="s3"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="stars" id="s2" value="2"><label for="s2"><i class="fa-solid fa-star"></i></label>
                                <input type="radio" name="stars" id="s1" value="1"><label for="s1"><i class="fa-solid fa-star"></i></label>
                            </div>
                        </div>

                        <div class="mb-field">
                            <label class="field-label">Your Review</label>
                            <textarea name="comment" class="form-control-wave" rows="4" placeholder="Describe your experience — the thrill, the crew, the view…" required minlength="5"></textarea>
                        </div>

                        <div class="mb-field">
                            <label class="field-label">Did You Feel Safe?</label>
                            <select name="safe_feel" class="form-select-wave" required>
                                <option value="Yes">Yes — I felt safe throughout</option>
                                <option value="No">No — Some concerns</option>
                            </select>
                        </div>

                        <div class="mb-field">
                            <label class="field-label">Upload a Photo <span style="font-weight:400;text-transform:none;opacity:0.6;">(optional)</span></label>
                            <input type="file" name="review_photo" accept="image/*" class="form-control form-control-sm" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);color:white;border-radius:10px;">
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-paper-plane me-2"></i> Submit Review
                        </button>
                    </form>

                <?php else: ?>
                    <!-- NOT eligible to review -->
                    <div class="form-title"><i class="fa-solid fa-lock me-2" style="color:var(--accent-cyan);"></i>Write a Review</div>
                    <div class="review-locked mt-3">
                        <i class="fa-solid fa-person-swimming"></i>
                        <p>You need to <strong>complete at least one water activity booking</strong> before you can post a review.</p>
                        <p style="font-size:0.78rem;opacity:0.5;margin-bottom:16px;">This ensures our reviews are from real adventurers who experienced Waves Water Sports!</p>
                        <a href="<?= base_url('user/booking') ?>" class="btn-book-now">
                            <i class="fa-solid fa-calendar-plus"></i> Book an Activity Now
                        </a>
                    </div>
                    <div style="margin-top:16px;background:rgba(255,193,7,0.08);border:1px solid rgba(255,193,7,0.2);border-radius:12px;padding:14px;font-size:0.78rem;color:rgba(255,255,255,0.6);">
                        <i class="fa-solid fa-circle-info me-2" style="color:#ffc107;"></i>
                        Once your booking status is marked <strong style="color:#ffc107;">Completed</strong> by our admin, you can share your review here.
                    </div>
                <?php endif; ?>
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
function setFilter(activity, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.review-card').forEach(c => {
        c.style.display = (activity === 'all' || c.dataset.activity.includes(activity)) ? '' : 'none';
    });
}
</script>
</body>
</html>