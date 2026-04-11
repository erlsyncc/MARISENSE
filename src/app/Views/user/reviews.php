<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Reviews | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; }

        /* Navbar */
        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .user-greeting { color: white; font-size: 1.2rem; font-weight: 400; flex: 1; }
        .nav-menu-center { display: flex; gap: 10px; justify-content: center; flex: 2; }
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; }
        .nav-link-custom { color: rgba(255,255,255,0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255,255,255,0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255,107,107,0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }
        
        /* Hero */
        .welcome-hero {
            background: linear-gradient(rgba(5,44,57,0.5), rgba(5,44,57,0.7)), url('<?= base_url('images/reviews_bg.png') ?>');
            background-size: cover; background-position: center; background-attachment: fixed;
            padding: 150px 40px; color: white; border-radius: 0 0 80px 80px; margin-bottom: 60px;
        }

        /* Rating Summary */
        .rating-summary-card { background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 30px; padding: 30px; border: 1px solid rgba(255,255,255,0.1); margin: 0 auto 50px auto; max-width: 1100px; }

        /* Review Grid */
        .reviews-grid-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px 60px;
        }
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        @media (max-width: 992px) { .reviews-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 600px) { .reviews-grid { grid-template-columns: 1fr; } }

        /* Review Card (full DB card) */
        .review-feed-card {
            background: white;
            color: var(--deep-blue);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .review-feed-card:hover { transform: translateY(-7px); box-shadow: 0 18px 45px rgba(0,0,0,0.3); }

        /* Card photo */
        .card-review-photo {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
        }
        .card-review-placeholder {
            width: 100%;
            height: 190px;
            background: linear-gradient(135deg, var(--ocean-blue), var(--deep-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(72,202,228,0.5);
        }

        .card-review-body { padding: 20px 22px; flex: 1; display: flex; flex-direction: column; }
        .card-rev-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .rev-user-info { display: flex; align-items: center; gap: 10px; }
        .rev-avatar { width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--accent-cyan); }
        .rev-username { font-weight: 700; font-size: 0.88rem; color: var(--deep-blue); }
        .rev-date { font-size: 0.72rem; color: rgba(5,44,57,0.45); margin-top: 1px; }
        .rev-stars { color: #f5a623; font-size: 0.82rem; text-align: right; }
        .rev-text { font-size: 0.86rem; color: rgba(5,44,57,0.78); line-height: 1.6; font-style: italic; flex: 1; margin-bottom: 14px; }
        .rev-badges { display: flex; gap: 8px; flex-wrap: wrap; }
        .badge-activity { background: var(--ocean-blue); color: white; padding: 4px 12px; border-radius: 50px; font-size: 0.73rem; font-weight: 600; }
        .badge-safety { background: #e8f5e9; color: #2e7d32; padding: 4px 12px; border-radius: 50px; font-size: 0.73rem; font-weight: 600; }
        .badge-unsafe-feel { background: #fdecea; color: #c62828; padding: 4px 12px; border-radius: 50px; font-size: 0.73rem; font-weight: 600; }

        /* Empty state */
        .empty-reviews { text-align: center; padding: 60px 20px; opacity: 0.6; }

        /* Stars */
        .stars-outer { position: relative; display: inline-block; font-size: 1.5rem; color: rgba(255,255,255,0.2); }
        .stars-inner { position: absolute; top: 0; left: 0; white-space: nowrap; overflow: hidden; width: 98%; color: #ffc107; }

        /* Filter */
        .filter-select { background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); border-radius: 50px; padding: 8px 20px; cursor: pointer; outline: none; }
        .filter-select option { background: var(--ocean-blue); color: white; }

        /* Share form */
        .feedback-card { background: rgba(5,44,57,0.4); border: 2px dashed var(--accent-cyan); border-radius: 40px; padding: 50px; margin: 80px clamp(20px, 10vw, 192px); }
        .sub-rating-row { display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.05); padding: 10px 20px; border-radius: 15px; margin-bottom: 10px; }
        .star-input { color: #ffc107; cursor: pointer; font-size: 1.5rem; margin-right: 5px; }
        .form-control-custom { background: white !important; border-radius: 15px; padding: 15px; border: none; color: var(--deep-blue) !important; }
        .form-control-custom::placeholder { color: rgba(5,44,57,0.4) !important; }
        .btn-post { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border-radius: 50px; padding: 15px 50px; border: none; transition: 0.3s; font-size: 1.1rem; }
        .btn-post:hover { background: white; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

        /* Image preview */
        .image-preview-wrapper { margin-top: 15px; display: none; position: relative; width: 100%; max-width: 200px; }
        .image-preview-wrapper img { width: 100%; border-radius: 15px; border: 2px solid var(--accent-cyan); box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
        .remove-preview { position: absolute; top: -10px; right: -10px; background: #ff6b6b; color: white; border-radius: 50%; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.8rem; }

        /* Footer */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255,255,255,0.6) !important; border-top: 1px solid rgba(255,255,255,0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255,255,255,0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

        /* Scroll btn */
        #scrollBtn { position: fixed; right: 20px; top: 50%; transform: translateY(-50%); z-index: 1000; width: 50px; height: 150px; background: rgba(10,88,114,0.85); backdrop-filter: blur(10px); border: 3px solid var(--accent-cyan); border-radius: 60px; display: flex; align-items: center; justify-content: center; color: var(--accent-cyan); cursor: pointer; transition: 0.3s; box-shadow: 0 15px 35px rgba(0,0,0,0.4); }
        #scrollBtn:hover { background: var(--accent-cyan); color: var(--deep-blue); right: 25px; }
        #scrollBtn i { font-size: 2.5rem; transition: transform 0.5s cubic-bezier(0.68,-0.55,0.27,1.55); margin: 0 auto; }
        .rotate-up { transform: rotate(180deg); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        /* Tooltip Style */
        .tooltip-btn {
            position: relative;
            cursor: pointer;
        }

        .tooltip-btn::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 125%; /* Lalabas sa taas ng button */
            left: 50%;
            transform: translateX(-50%);
            background: #052c39;
            color: #48cae4;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s ease;
            border: 1px solid #48cae4;
            pointer-events: none;
            z-index: 10;
        }

        .tooltip-btn:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: 115%; /* Slight animation */
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
            <a href="<?= base_url('user/safety') ?>" class="nav-link-custom">Safety & Sea Conditions</a>
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom">Book & Reserve</a>
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom active">Reviews</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-2">Hear from Our Happy Adventurers</h1>
        <p class="lead mb-0 opacity-90 mx-auto" style="max-width: 800px;">Read real experiences from our guests and share your own water adventure.</p>
    </div>
</header>

<?php
// 1. I-define ang hardcoded reviews
$staticReviews = [
    [
        'username'    => 'Cardo Dalisay',
        'activity'    => 'Banana Boat',
        'rating'      => 5,
        'review_text' => 'Napakasaya! Safe kahit may konting alon. Very accommodating din ang mga staff.',
        'safe_feel'   => 'yes',
        'photo_url'   => 'https://scontent.fmnl22-1.fna.fbcdn.net/v/t39.30808-6/572804802_846688217920118_7400127582885222591_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeHKUGolkrfTOLUVbTEI50luSvb9aHED1nxK9v1ocQPWfFSxku6bpuccFk_bE-sSC8GFXXhnFMNh14G5WxlY2D0F&_nc_ohc=nAwP4c6fMgUQ7kNvwEC54xu&_nc_oc=AdprUKxGOs74ueZyPgTUIm72zCsdht6izEtKANUD_265_ry7DOR84fdkxurSUfegWWM&_nc_zt=23&_nc_ht=scontent.fmnl22-1.fna&_nc_gid=DfvNZaRjqHWOoycpNdB48A&_nc_ss=7a3a8&oh=00_Af0rvTUbxUqtcs1Fm49kEEJrhqxMww0nedzbBE7wTWKsnA&oe=69DE6595',
        'created_at'  => '2026-03-15 10:00:00',
    ],
    [
        'username'    => 'Maria Clara',
        'activity'    => 'Jet Ski',
        'rating'      => 4,
        'review_text' => 'Maganda ang experience pero medyo malakas ang alon. Buti na lang real-time ang monitoring ng MARISENSE!',
        'safe_feel'   => 'yes',
        'photo_url'   => 'https://scontent.fmnl22-1.fna.fbcdn.net/v/t39.30808-6/659754567_975447061710899_134557125449451855_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=106&ccb=1-7&_nc_sid=7b2446&_nc_eui2=AeHtn0-hlActf50cJ7FmpU3BWqrzzn6PbvhaqvPOfo9u-KlSTjI2PqxS_EPsv6a3pR_j1fXTa-bF4z02t1QKeZoS&_nc_ohc=ROWDwym0XcMQ7kNvwHoVnRI&_nc_oc=AdocTCzQ_YKfwHooVJbm5LStGk2L2DAivbIPkl8Ez5EEnJRxc5aAabuBWoUDwNdgMWs&_nc_zt=23&_nc_ht=scontent.fmnl22-1.fna&_nc_gid=mmvMr5qY7mD2TjXsvL5Gjg&_nc_ss=7a3a8&oh=00_Af0cx45jRYNg8zDz7YUi57R_S2m0iasDs64mLptr__ZAUg&oe=69DE6B40',
        'created_at'  => '2026-03-12 14:30:00',
    ],
    [
        'username'    => 'Juan dela Cruz',
        'activity'    => 'Kayaking',
        'rating'      => 5,
        'review_text' => 'Relaxing at super masaya! Perfect para sa buong pamilya. Babalik kami ulit.',
        'safe_feel'   => 'yes',
        'photo_url'   => 'https://tse3.mm.bing.net/th/id/OIP.uEerkLhRkdWbUvjO7w2ltQHaE7?rs=1&pid=ImgDetMain&o=7&rm=3',
        'created_at'  => '2026-03-10 09:00:00',
    ],
];

// 2. Merge agad ang static at dynamic reviews
$displayReviews = array_merge($staticReviews, ($reviews ?? []));

// 3. Re-calculate Summary stats based sa combined reviews
$totalReviews = count($displayReviews);
$sumRating = 0;
foreach ($displayReviews as $r) {
    $sumRating += (int)($r['rating'] ?? 5);
}
$newAvg = $totalReviews > 0 ? $sumRating / $totalReviews : 5.0;

$filledWidth = ($newAvg / 5) * 100 . '%';
$displayAvg  = number_format($newAvg, 1);
?>

<div class="rating-summary-card">
    <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
        <div class="d-flex align-items-center gap-3">
            <span class="opacity-75 small">Overall:</span>
            <span class="fw-bold text-warning fs-4"><?= $displayAvg ?> / 5</span>
            <div class="stars-outer">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <div class="stars-inner" style="width:<?= $filledWidth ?>">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
            </div>
            <span class="opacity-60 small">(<?= $totalReviews ?> review<?= $totalReviews !== 1 ? 's' : '' ?>)</span>
        </div>

        <div class="d-flex align-items-center gap-2">
            <label class="small fw-bold">Activity:</label>
            <select class="filter-select" id="activityFilter">
                <option value="all">All Activities</option>
                <option value="Jet Ski">Jet Ski</option>
                <option value="Banana Boat">Banana Boat</option>
                <option value="Kayaking">Kayaking</option>
                <option value="Flying Saucer">Flying Saucer</option>
            </select>
        </div>
        <div class="d-flex align-items-center gap-2">
            <label class="small fw-bold">Stars:</label>
            <select class="filter-select" id="starFilter">
                <option value="all">All Stars</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
                <option value="2">2 Stars</option>
                <option value="1">1 Star</option>
            </select>
        </div>
    </div>
</div>

<div class="reviews-grid-wrapper">
    <div id="noReviewsMessage" class="empty-reviews" style="display: none;">
        <i class="fa-solid fa-water" style="font-size: 3rem; margin-bottom: 10px;"></i>
        <h3>No reviews found</h3>
        <p>Try adjusting your filters to see more adventures.</p>
    </div>
    <div class="reviews-grid" id="reviewContainer">
        <?php foreach ($displayReviews as $rev): 
            // ... (keep your existing foreach logic here) ...
            $stars   = (int)($rev['rating'] ?? 5);
            $name    = esc($rev['username'] ?? 'Guest');
            $act     = esc($rev['activity'] ?? '');
            $text    = esc($rev['review_text'] ?? '');
            $safe    = strtolower($rev['safe_feel'] ?? 'yes');
            $date    = isset($rev['created_at']) ? date('F d, Y', strtotime($rev['created_at'])) : '';
            
            $photoSrc = null;
            if (!empty($rev['photo_url'])) {
                $photoSrc = $rev['photo_url'];
            } elseif (!empty($rev['photo'])) {
                $photoSrc = base_url('uploads/reviews/' . esc($rev['photo']));
            }

            $actIcon = match(strtolower($act)) {
                'jet ski'       => 'fa-person-water-polo',
                'banana boat'   => 'fa-ship',
                'kayaking'      => 'fa-water',
                'flying saucer' => 'fa-circle-radiation',
                default         => 'fa-water',
            };
        ?>
            <div class="review-feed-card" data-activity="<?= $act ?>" data-star="<?= $stars ?>">
                <?php if ($photoSrc): ?>
                    <img src="<?= $photoSrc ?>" class="card-review-photo">
                <?php else: ?>
                    <div class="card-review-placeholder"><i class="fa-solid <?= $actIcon ?>"></i></div>
                <?php endif; ?>
                <div class="card-review-body">
                    <div class="card-rev-header">
                        <div class="rev-user-info">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($name) ?>&background=0a5872&color=fff&size=80" class="rev-avatar">
                            <div>
                                <div class="rev-username"><?= $name ?></div>
                                <div class="rev-date"><?= $date ?></div>
                            </div>
                        </div>
                        <div class="rev-stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fa-<?= $i <= $stars ? 'solid' : 'regular' ?> fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <p class="rev-text">"<?= $text ?>"</p>
                    <div class="rev-badges">
                        <span class="badge-activity"><i class="fa-solid <?= $actIcon ?> me-1"></i><?= $act ?></span>
                        <span class="<?= ($safe === 'yes' || $safe === 'Yes') ? 'badge-safety' : 'badge-unsafe-feel' ?>">
                            <i class="fa-solid <?= ($safe === 'yes' || $safe === 'Yes') ? 'fa-circle-check' : 'fa-circle-xmark' ?> me-1"></i>
                            <?= ($safe === 'yes' || $safe === 'Yes') ? 'Felt Safe' : 'Had Concerns' ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- =====================================================================
     SHARE YOUR ADVENTURE FORM
     ===================================================================== -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="feedback-card">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-white">Share Your Adventure</h2>
                </div>

                <form action="<?= base_url('user/post-review') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Select Activity</label>
                                <select class="form-select form-control-custom" name="activity" required>
                                    <option value="Banana Boat">Banana Boat</option>
                                    <option value="Jet Ski">Jet Ski</option>
                                    <option value="Kayaking">Kayaking</option>
                                    <option value="Flying Saucer">Flying Saucer</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Rating</label>
                                <div class="sub-rating-row">
                                    <div id="starInputGroup">
                                        <input type="hidden" name="stars" id="selectedStars" value="5">
                                        <i class="fa-solid fa-star star-input" data-value="1"></i>
                                        <i class="fa-solid fa-star star-input" data-value="2"></i>
                                        <i class="fa-solid fa-star star-input" data-value="3"></i>
                                        <i class="fa-solid fa-star star-input" data-value="4"></i>
                                        <i class="fa-solid fa-star star-input" data-value="5"></i>
                                    </div>
                                    <span id="starCount" class="fw-bold text-warning">5 Stars</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Did you feel safe?</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="safe_feel" id="s1" value="Yes" checked><label class="form-check-label" for="s1">Yes</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="safe_feel" id="s2" value="No"><label class="form-check-label" for="s2">No</label></div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Your Review</label>
                                <textarea name="comment" class="form-control form-control-custom" rows="4" placeholder="How was your adventure?" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Upload Photo <span class="opacity-50 fw-normal">(Optional)</span></label>
                                <input type="file" name="review_photo" id="reviewPhotoInput" class="form-control form-control-custom" accept="image/*">
                                <div class="image-preview-wrapper" id="previewWrapper">
                                    <span class="remove-preview" onclick="resetImage()"><i class="fa-solid fa-xmark"></i></span>
                                    <img src="#" id="imagePreview" alt="Preview">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" 
                                    class="btn-post shadow-lg tooltip-btn" 
                                    data-tooltip="Share your experience with others!">
                                <i class="fa-solid fa-paper-plane me-2"></i>Post Review
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text mb-4 opacity-75">For inquiries, message us through our social media platforms.</div>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100077368436521" target="_blank" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://instagram.com" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fa-brands fa-twitter"></i></a>
        </div>
        <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
</footer>

<div id="scrollBtn" onclick="smartScroll()"><i class="fa-solid fa-arrow-down" id="scrollIcon"></i></div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // === SUCCESS POPUP ===
    <?php if (session()->getFlashdata('success')): ?>
    Swal.fire({
        title: 'Review Posted!',
        text: "<?= session()->getFlashdata('success') ?>",
        icon: 'success',
        confirmButtonColor: '#0a5872',
        background: '#f4f9fc',
    });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    Swal.fire({
        title: 'Error',
        text: "<?= session()->getFlashdata('error') ?>",
        icon: 'error',
        confirmButtonColor: '#0a5872',
    });
    <?php endif; ?>

    // === IMAGE PREVIEW ===
    const photoInput    = document.getElementById('reviewPhotoInput');
    const previewWrapper = document.getElementById('previewWrapper');
    const imagePreview  = document.getElementById('imagePreview');

    photoInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.src = e.target.result;
                previewWrapper.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // === FILTER LOGIC ===
    const activityFilter = document.getElementById('activityFilter');
    const starFilter     = document.getElementById('starFilter');
    const reviewCards    = document.querySelectorAll('.review-feed-card');

    function applyFilters() {
    const actVal  = activityFilter.value;
    const starVal = starFilter.value;
    const reviewCards = document.querySelectorAll('.review-feed-card');
    const noReviewsMsg = document.getElementById('noReviewsMessage');
    
    let visibleCount = 0;

    reviewCards.forEach(card => {
        const cardAct  = card.getAttribute('data-activity');
        const cardStar = card.getAttribute('data-star');
        const matchAct  = (actVal === 'all' || actVal === cardAct);
        const matchStar = (starVal === 'all' || starVal === cardStar);

        if (matchAct && matchStar) {
            card.style.display = 'flex';
            card.style.animation = 'fadeIn 0.4s forwards';
            visibleCount++; // Bilangin kung ilan ang nakikita
        } else {
            card.style.display = 'none';
        }
    });

    // Ipakita o itago ang "No Reviews" message base sa count
    if (visibleCount === 0) {
        noReviewsMsg.style.display = 'block';
    } else {
        noReviewsMsg.style.display = 'none';
    }
}
    activityFilter.addEventListener('change', applyFilters);
    starFilter.addEventListener('change', applyFilters);

    // === STAR RATING INPUT ===
    const stars     = document.querySelectorAll('.star-input');
    const starInput = document.getElementById('selectedStars');
    const starText  = document.getElementById('starCount');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const val = parseInt(this.getAttribute('data-value'));
            starInput.value = val;
            starText.innerText = val + (val > 1 ? ' Stars' : ' Star');
            stars.forEach(s => {
                const sv = parseInt(s.getAttribute('data-value'));
                s.classList.toggle('fa-solid',  sv <= val);
                s.classList.toggle('fa-regular', sv > val);
            });
        });
    });
});

function resetImage() {
    document.getElementById('reviewPhotoInput').value = '';
    document.getElementById('previewWrapper').style.display = 'none';
}

function smartScroll() {
    const icon = document.getElementById('scrollIcon');
    if (icon.classList.contains('rotate-up')) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        window.scrollBy({ top: 600, behavior: 'smooth' });
    }
}

window.addEventListener('scroll', function () {
    const icon = document.getElementById('scrollIcon');
    const btn  = document.getElementById('scrollBtn');
    const pct  = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
    if (pct > 0.8) {
        icon.classList.add('rotate-up');
        btn.style.background = '#48cae4';
        icon.style.color = '#052c39';
    } else {
        icon.classList.remove('rotate-up');
        btn.style.background = 'rgba(10,88,114,0.85)';
        icon.style.color = '#48cae4';
    }
});
</script>

</body>
</html>