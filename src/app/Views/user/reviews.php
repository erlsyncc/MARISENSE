<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Reviews | Waves Water Sports</title>
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
            background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), 
                        url('<?= base_url('images/reviews_bg.png') ?>'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 150px 40px;
            color: white;
            border-radius: 0 0 80px 80px;
            margin-bottom: 60px;
        }

        /* Rating Summary Card */
        .rating-summary-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 30px; padding: 30px; border: 1px solid rgba(255,255,255,0.1); margin-bottom: 50px; }
        .big-rating { font-size: 3.5rem; font-weight: 700; color: #ffc107; }

        /* Filter Buttons */
        .filter-btn { background: rgba(255, 255, 255, 0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 8px 25px; border-radius: 50px; transition: 0.3s; margin: 5px; }
        .filter-btn:hover, .filter-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 600; }

        /* Review Feed Cards */
        .review-feed-card { background: white; color: var(--deep-blue); border-radius: 25px; padding: 30px; margin-bottom: 25px; transition: 0.3s; position: relative; }
        .review-feed-card:hover { transform: scale(1.02); }
        .badge-activity { background: var(--ocean-blue); color: white; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; }
        .badge-safety { background: #e8f5e9; color: #2e7d32; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: 600; }

        /* Share Adventure Form */
        .feedback-card { background: rgba(5, 44, 57, 0.4); border: 2px dashed var(--accent-cyan); border-radius: 40px; padding: 50px; margin-top: 80px; }
        .sub-rating-row { display: flex; align-items: center; justify-content: space-between; background: rgba(255,255,255,0.05); padding: 10px 20px; border-radius: 15px; margin-bottom: 10px; }
        .star-input { color: #ffc107; cursor: pointer; font-size: 1.2rem; }
        
        .form-control-custom { background: white; border-radius: 15px; padding: 15px; border: none; }
        .btn-post { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border-radius: 50px; padding: 15px 50px; border: none; transition: 0.3s; font-size: 1.1rem; }
        .btn-post:hover { background: white; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

        /* Footer Styles */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

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
        html {
            scroll-behavior: smooth;
        }

        /* Star Rating styling */
        .stars-outer {
            position: relative;
            display: inline-block;
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.2); /* Kulay ng empty stars */
        }

        .stars-inner {
            position: absolute;
            top: 0;
            left: 0;
            white-space: nowrap;
            overflow: hidden;
            width: 93%; /* Ito ang magdedetermine ng kulay (4.9 / 5 = 98%) */
            color: #ffc107; /* Kulay ng filled stars */
        }

        /* Custom Select Styling */
        .filter-select {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 8px 20px;
            cursor: pointer;
            outline: none;
            appearance: auto; /* Para lumabas yung default arrow */
        }

        .filter-select option {
            background: var(--ocean-blue);
            color: white;
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
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom  active">Reviews</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">Hear from Our Happy Adventurers</h1>
        <p class="lead mb-0 opacity-90 mx-auto" style="max-width: 800px;">Read real experiences from our guests and share your own water adventure. Your feedback helps us improve safety, service, and overall experience.</p>
    </div>
</header>

<div class="rating-summary-card">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
            
            <div class="d-flex align-items-center gap-3">
                <div class="text-start">
                    <div class="label opacity-75 small">Overall Rating</div>
                    <div class="big-rating mb-0" style="font-size: 2.5rem; line-height: 1;">4.9 <small style="font-size: 1rem;">/ 5</small></div>
                </div>
                <div class="stars-outer">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    <div class="stars-inner">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <label class="fw-bold small mb-0">Filter by Activity:</label>
                <select class="filter-select" id="activityFilter">
                    <option value="all">All Activities</option>
                    <option value="Jet Ski">Jet Ski</option>
                    <option value="Banana Boat">Banana Boat</option>
                    <option value="Kayaking">Kayaking</option>
                </select>
            </div>

            <div class="d-flex align-items-center gap-2">
                <label class="fw-bold small mb-0">Filter by Stars:</label>
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
</div>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <div class="review-feed-card shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name=Juan+Dela+Cruz&background=0a5872&color=fff" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="fw-bold mb-0">Juan Dela Cruz</h6>
                            <small class="opacity-50">March 15, 2026</small>
                        </div>
                    </div>
                    <div class="text-warning small">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <p class="mb-3">“Napakasaya! Safe kahit may konting alon. Very accommodating din ang mga staff.”</p>
                <div class="d-flex gap-2">
                    <span class="badge-activity">Activity: Banana Boat</span>
                    <span class="badge-safety"><i class="fa-solid fa-circle-check me-1"></i> Safety: ✔ Safe</span>
                </div>
            </div>

            <div class="review-feed-card shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name=Maria+Santos&background=0a5872&color=fff" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="fw-bold mb-0">Maria Santos</h6>
                            <small class="opacity-50">March 12, 2026</small>
                        </div>
                    </div>
                    <div class="text-warning small">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i>
                    </div>
                </div>
                <p class="mb-3">“Maganda experience pero medyo malakas alon nung hapon. Buti na lang real-time ang monitoring ng MARISENSE.”</p>
                <div class="d-flex gap-2">
                    <span class="badge-activity">Activity: Jet Ski</span>
                    <span class="badge-safety"><i class="fa-solid fa-circle-check me-1"></i> Safety: ✔ Safe</span>
                </div>
            </div>

        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="feedback-card">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-white">Share Your Adventure</h2>
                    <div class="activity-line bg-accent-cyan mx-auto"></div>
                </div>

                <form action="<?= base_url('user/post-review') ?>" method="POST" enctype="multipart/form-data">
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
                                <label class="form-label text-info fw-bold">Rate Your Experience</label>
                                <div class="sub-rating-row">
                                    <span>Safety</span>
                                    <div class="text-warning"><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                                </div>
                                <div class="sub-rating-row">
                                    <span>Staff Friendlyness</span>
                                    <div class="text-warning"><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                                </div>
                                <div class="sub-rating-row">
                                    <span>Fun Level</span>
                                    <div class="text-warning"><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Did you feel safe?</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="safe_feel" id="s1" value="Yes" checked><label class="form-check-label" for="s1">Yes</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="safe_feel" id="s2" value="No"><label class="form-check-label" for="s2">No</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="safe_feel" id="s3" value="Moderate"><label class="form-check-label" for="s3">Moderate</label></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Your Review</label>
                                <textarea class="form-control form-control-custom" rows="4" placeholder="How was your adventure?"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-info fw-bold">Upload Photo (Optional)</label>
                                <input type="file" class="form-control form-control-custom">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = {
        activity: 'all',
        star: 'all'
    };

    const filterButtons = document.querySelectorAll('.filter-btn');
    const reviewCards = document.querySelectorAll('.review-feed-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const filterType = this.getAttribute('data-filter');
            const filterValue = this.getAttribute('data-value');

            // 1. Update active button UI
            document.querySelectorAll(`.filter-btn[data-filter="${filterType}"]`).forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // 2. Store filter value
            filters[filterType] = filterValue;

            // 3. Filter the cards
            reviewCards.forEach(card => {
                const cardActivity = card.getAttribute('data-activity');
                const cardStar = card.getAttribute('data-star');

                const activityMatch = (filters.activity === 'all' || filters.activity === cardActivity);
                const starMatch = (filters.star === 'all' || filters.star === cardStar);

                if (activityMatch && starMatch) {
                    card.style.display = 'block';
                    // Optional: Add a small animation
                    card.style.animation = 'fadeIn 0.5s';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

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