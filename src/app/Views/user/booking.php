<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking | Waves Water Sports</title>
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

        .booking-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px); border-radius: 30px; padding: 40px; border: 1px solid rgba(255, 255, 255, 0.2); max-width: 800px; margin: 0 auto; }
        .form-control, .form-select { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); color: white; border-radius: 12px; padding: 12px; }
        .form-control:focus, .form-select:focus { background: rgba(255, 255, 255, 0.1); border-color: var(--accent-cyan); color: white; box-shadow: none; }
        .btn-submit { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border-radius: 50px; padding: 15px; width: 100%; border: none; transition: 0.3s; }
        .btn-submit:hover { transform: scale(1.02); background: white; }

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
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom active">Book & Reserve</a>
            <a href="<?= base_url('user/calendar') ?>" class="nav-link-custom">Calendar</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<div class="container py-5">
    <div class="booking-card shadow-lg">
        <h2 class="fw-bold text-center mb-4">Reserve Your Adventure</h2>
        <form action="<?= base_url('user/submit_reservation') ?>" method="POST">
            <div class="row g-3">
                <div class="col-md-6"><label class="small opacity-75">Full Name</label><input type="text" class="form-control" value="<?= auth()->user()->username ?>" readonly></div>
                <div class="col-md-6"><label class="small opacity-75">Selected Activity</label>
                    <select class="form-select">
                        <option>Jet Ski</option><option>Banana Boat</option><option>Kayaking</option><option>Flying Saucer</option>
                    </select>
                </div>
                <div class="col-md-4"><label class="small opacity-75">Date</label><input type="date" class="form-control"></div>
                <div class="col-md-4"><label class="small opacity-75">Time</label><input type="time" class="form-control"></div>
                <div class="col-md-4"><label class="small opacity-75">Participants</label><input type="number" class="form-control" min="1"></div>
                <div class="col-12"><label class="small opacity-75">Special Requests (Optional)</label><textarea class="form-control" rows="3"></textarea></div>
                <div class="col-12 mt-4"><button type="submit" class="btn-submit shadow-lg">Submit Reservation</button></div>
            </div>
        </form>
    </div>
</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="footer-inquiry-text">For inquiries, message us through our social media platforms.</div>
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
        <div class="copyright-text">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
</footer>

</body>
</html>