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
            background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), 
                        url('<?= base_url('images/reviews_bg.png') ?>'); 
            background-size: cover; background-position: center; background-attachment: fixed;
            padding: 150px 40px; color: white; border-radius: 0 0 80px 80px; margin-bottom: 60px;
        }

        /* Rating Summary Card */
        .rating-summary-card { 
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); 
            border-radius: 30px; padding: 30px; border: 1px solid rgba(255,255,255,0.1); 
            margin: 0 auto 50px auto; max-width: 1100px; 
        }

        /* Review Feed Cards */
        .review-feed-card { background: white; color: var(--deep-blue); border-radius: 25px; padding: 30px; margin-bottom: 25px; transition: 0.3s; position: relative; min-width: 400px; flex: 0 0 auto; }
        .review-feed-card:hover { transform: scale(1.02); }
        .badge-activity { background: var(--ocean-blue); color: white; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; }
        .badge-safety { background: #e8f5e9; color: #2e7d32; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: 600; }

        /* Share Adventure Form */
        .feedback-card { background: rgba(5, 44, 57, 0.4); border: 2px dashed var(--accent-cyan); border-radius: 40px; padding: 50px; margin: 80px clamp(20px, 10vw, 192px); }
        .sub-rating-row { display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.05); padding: 10px 20px; border-radius: 15px; margin-bottom: 10px; }
        .star-input { color: #ffc107; cursor: pointer; font-size: 1.5rem; margin-right: 5px; }
        .form-control-custom { background: white !important; border-radius: 15px; padding: 15px; border: none; }
        .btn-post { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border-radius: 50px; padding: 15px 50px; border: none; transition: 0.3s; font-size: 1.1rem; }
        .btn-post:hover { background: white; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

        /* Stars Styling */
        .stars-outer { position: relative; display: inline-block; font-size: 1.5rem; color: rgba(255, 255, 255, 0.2); }
        .stars-inner { position: absolute; top: 0; left: 0; white-space: nowrap; overflow: hidden; width: 98%; color: #ffc107; }

        /* Custom Select */
        .filter-select { background: rgba(255, 255, 255, 0.1); color: white; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50px; padding: 8px 20px; cursor: pointer; outline: none; }
        .filter-select option { background: var(--ocean-blue); color: white; }

        .horizontal-review-row { display: flex; overflow-x: auto; gap: 25px; padding: 20px 0; scroll-behavior: smooth; }
        .side-spaced-container { padding-left: 10%; padding-right: 10%; }
        
        #scrollBtn { position: fixed; right: 20px; top: 50%; transform: translateY(-50%); z-index: 1000; width: 50px; height: 150px; background: rgba(10, 88, 114, 0.85); backdrop-filter: blur(10px); border: 3px solid var(--accent-cyan); border-radius: 60px; display: flex; align-items: center; justify-content: center; color: var(--accent-cyan); cursor: pointer; transition: 0.3s; box-shadow: 0 15px 35px rgba(0,0,0,0.4); }
        .rotate-up { transform: rotate(180deg); }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .image-preview-wrapper {
            margin-top: 15px;
            display: none; /* Hidden by default */
            position: relative;
            width: 100%;
            max-width: 200px;
        }
        .image-preview-wrapper img {
            width: 100%;
            border-radius: 15px;
            border: 2px solid var(--accent-cyan);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .remove-preview {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff6b6b;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.8rem;
        }
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

<div class="rating-summary-card">
    <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
        <div class="d-flex align-items-center gap-3">
            <span class="opacity-75 small">Overall:</span>
            <span class="fw-bold text-warning fs-4">4.9 / 5</span>
            <div class="stars-outer">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <div class="stars-inner"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <label class="small fw-bold">Activity:</label>
            <select class="filter-select" id="activityFilter">
                <option value="all">All Activities</option>
                <option value="Jet Ski">Jet Ski</option>
                <option value="Banana Boat">Banana Boat</option>
                <option value="Kayaking">Kayaking</option>
            </select>
        </div>

        <div class="d-flex align-items-center gap-2">
            <label class="small fw-bold">Stars:</label>
            <select class="filter-select" id="starFilter">
                <option value="all">All Stars</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars</option>
                <option value="3">3 Stars</option>
            </select>
        </div>
    </div>
</div>

<div class="container-fluid side-spaced-container mb-5">
    <div class="horizontal-review-row" id="reviewContainer">
        <div class="review-feed-card shadow-sm" data-activity="Banana Boat" data-star="5">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=Cardo+Dalisay&background=0a5872&color=fff" class="rounded-circle me-3" width="50">
                    <div><h3 class="fw-bold mb-0 fs-6">Cardo Dalisay</h3><small class="opacity-50">March 15, 2026</small></div>
                </div>
                <div class="text-warning small"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
            </div>
            <p>“Napakasaya! Safe kahit may konting alon. Very accommodating din ang mga staff.”</p>
            <div class="d-flex gap-2">
                <span class="badge-activity">Activity: Banana Boat</span>
                <span class="badge-safety"><i class="fa-solid fa-circle-check"></i> Safe</span>
            </div>
        </div>

        <div class="review-feed-card shadow-sm" data-activity="Jet Ski" data-star="4">
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <img src="https://ui-avatars.com/api/?name=Maria+Clara&background=0a5872&color=fff" class="rounded-circle me-3" width="50">
                    <div><h3 class="fw-bold mb-0 fs-6">Maria Clara</h3><small class="opacity-50">March 12, 2026</small></div>
                </div>
                <div class="text-warning small"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i></div>
            </div>
            <p>“Maganda experience pero medyo malakas alon. Buti na lang real-time ang monitoring.”</p>
            <div class="d-flex gap-2">
                <span class="badge-activity">Activity: Jet Ski</span>
                <span class="badge-safety"><i class="fa-solid fa-circle-check"></i> Safe</span>
            </div>
        </div>
    </div>
</div>

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
                                <label class="form-label text-info fw-bold">Upload Photo (Optional)</label>
                                <input type="file" name="review_photo" id="reviewPhotoInput" class="form-control form-control-custom" accept="image/*">
                                
                                <div class="image-preview-wrapper" id="previewWrapper">
                                    <span class="remove-preview" onclick="resetImage()"><i class="fa-solid fa-xmark"></i></span>
                                    <img src="#" id="imagePreview" alt="Preview">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn-post shadow-lg">Post Review</button>
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

<div id="scrollBtn" onclick="smartScroll()"><i class="fa-solid fa-arrow-down" id="scrollIcon"></i></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // === 1. SUCCESS POPUP (SweetAlert2) ===
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            title: 'Success!',
            text: "<?= session()->getFlashdata('success') ?>",
            icon: 'success',
            confirmButtonColor: '#0a5872',
            background: '#f4f9fc',
            borderRadius: '25px'
        });
    <?php endif; ?>

    // === 2. IMAGE PREVIEW LOGIC ===
    const photoInput = document.getElementById('reviewPhotoInput');
    const previewWrapper = document.getElementById('previewWrapper');
    const imagePreview = document.getElementById('imagePreview');

    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewWrapper.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });

    // === 3. FILTER LOGIC ===
    const activityFilter = document.getElementById('activityFilter');
    const starFilter = document.getElementById('starFilter');
    const reviewCards = document.querySelectorAll('.review-feed-card');

    function applyFilters() {
        const actVal = activityFilter.value;
        const starVal = starFilter.value;

        reviewCards.forEach(card => {
            const cardAct = card.getAttribute('data-activity');
            const cardStar = card.getAttribute('data-star');
            const matchAct = (actVal === 'all' || actVal === cardAct);
            const matchStar = (starVal === 'all' || starVal === cardStar);

            if (matchAct && matchStar) {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.5s forwards';
            } else {
                card.style.display = 'none';
            }
        });
    }
    activityFilter.addEventListener('change', applyFilters);
    starFilter.addEventListener('change', applyFilters);

    // === 4. STAR RATING INPUT ===
    const stars = document.querySelectorAll('.star-input');
    const starInput = document.getElementById('selectedStars');
    const starText = document.getElementById('starCount');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const val = this.getAttribute('data-value');
            starInput.value = val;
            starText.innerText = val + (val > 1 ? " Stars" : " Star");
            stars.forEach(s => {
                if(parseInt(s.getAttribute('data-value')) <= parseInt(val)) {
                    s.classList.replace('fa-regular', 'fa-solid');
                } else {
                    s.classList.replace('fa-solid', 'fa-regular');
                }
            });
        });
    });
});

// Function to remove selected image
function resetImage() {
    const photoInput = document.getElementById('reviewPhotoInput');
    const previewWrapper = document.getElementById('previewWrapper');
    photoInput.value = ""; // Clear input
    previewWrapper.style.display = 'none'; // Hide preview
}

function smartScroll() {
    const icon = document.getElementById("scrollIcon");
    if (icon.classList.contains("rotate-up")) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        window.scrollBy({ top: 600, behavior: 'smooth' });
    }
}

window.addEventListener('scroll', function() {
    const icon = document.getElementById("scrollIcon");
    const btn = document.getElementById("scrollBtn");
    const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollPercent = scrollHeight > 0 ? window.scrollY / scrollHeight : 0;
    
    if (scrollPercent > 0.8) {
        icon.classList.add("rotate-up");
        btn.style.background = "#48cae4";
    } else {
        icon.classList.remove("rotate-up");
        btn.style.background = "rgba(10, 88, 114, 0.85)";
    }
});
</script>

</body>
</html>