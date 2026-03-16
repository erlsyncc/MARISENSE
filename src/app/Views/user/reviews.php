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
            background: linear-gradient(rgba(5, 44, 57, 0.6), rgba(5, 44, 57, 0.8)), 
                        url('<?= base_url('images/coveract.png') ?>'); 
            background-size: cover; background-position: center; background-attachment: fixed;
            padding: 120px 40px; color: white; border-radius: 0 0 80px 80px;
            text-align: center; display: flex; flex-direction: column; align-items: center;
        }

        /* Review Cards Styling */
        .testimonial-card {
            background: white; color: var(--deep-blue); border-radius: 25px; padding: 40px 30px;
            text-align: center; height: 100%; position: relative; transition: 0.3s;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); margin-top: 50px;
        }
        .testimonial-card:hover { transform: translateY(-10px); }
        
        .testimonial-avatar {
            width: 90px; height: 90px; border-radius: 50%; border: 5px solid var(--accent-cyan);
            object-fit: cover; position: absolute; top: -45px; left: 50%; transform: translateX(-50%);
            background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .testimonial-text { font-style: italic; font-size: 0.95rem; line-height: 1.6; margin-top: 30px; min-height: 80px; }
        .testimonial-author { border-top: 1px solid #eee; padding-top: 15px; margin-top: 20px; }
        .testimonial-name { font-weight: 700; color: var(--ocean-blue); margin-bottom: 5px; }
        .star-color { color: #ffc107; }

        /* Feedback Form Section */
        .feedback-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 30px; padding: 40px; }
        .form-label { font-weight: 600; color: var(--accent-cyan); }
        .feedback-textarea { border-radius: 15px; border: none; padding: 20px; background: white; color: var(--deep-blue); }
        
        /* Star Rating Input */
        .star-rating { display: flex; flex-direction: row-reverse; justify-content: center; gap: 10px; font-size: 2.5rem; }
        .star-rating input { display: none; }
        .star-rating label { color: rgba(255, 255, 255, 0.3); cursor: pointer; transition: 0.2s; }
        .star-rating input:checked ~ label, .star-rating label:hover, .star-rating label:hover ~ label { color: #ffc107; }

        .btn-submit { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border-radius: 50px; padding: 12px 40px; border: none; transition: 0.3s; }
        .btn-submit:hover { background: white; transform: scale(1.05); }

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
            <a href="<?= base_url('user/activities') ?>" class="nav-link-custom">Activities</a>
            <a href="<?= base_url('user/safety') ?>" class="nav-link-custom">Safety & Sea Conditions</a>
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom">Book & Reserve</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom active">Reviews</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Guest Experiences</h1>
        <p class="lead">Hear the thrill and joy from our adventurers.</p>
    </div>
</header>

<div class="container py-5">
    <div class="row g-5 mb-5">
        <?php if (!empty($recentTestimonials)): ?>
            <?php foreach ($recentTestimonials as $testimonial): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <?php 
                            $avatar = !empty($testimonial['profile_pic']) 
                                ? base_url('uploads/profile_pics/'.$testimonial['profile_pic']) 
                                : "https://ui-avatars.com/api/?name=".urlencode($testimonial['fullname'])."&background=0a5872&color=fff";
                        ?>
                        <img src="<?= $avatar ?>" class="testimonial-avatar shadow">
                        <div class="testimonial-text">
                            "<?= esc($testimonial['comments']) ?>"
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-name"><?= esc($testimonial['fullname']) ?></div>
                            <div class="small">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fa-solid fa-star <?= $i <= $testimonial['rating'] ? 'star-color' : 'text-muted' ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-8">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Share Your Adventure</h2>
                <p class="opacity-75">Your feedback helps us make Waves Water Sports even better!</p>
            </div>

            <div class="feedback-card">
                <form action="<?= site_url('feedback/submit') ?>" method="post" id="feedbackForm">
                    <?= csrf_field() ?>
                    
                    <div class="text-center mb-4">
                        <label class="form-label d-block">Overall Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required/><label for="star5">★</label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4">★</label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3">★</label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2">★</label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1">★</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tell us about your experience</label>
                        <textarea class="form-control feedback-textarea" name="feedback" rows="5" placeholder="What was your favorite activity? How was our staff?" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-submit shadow">Post Review</button>
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

</body>
</html>