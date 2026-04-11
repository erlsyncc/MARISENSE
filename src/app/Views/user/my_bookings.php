<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --deep-blue: #052c39; --ocean-blue: #0a5872; --accent-cyan: #48cae4; --soft-white: #f4f9fc; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(180deg, var(--accent-cyan) 0%, var(--ocean-blue) 40%, var(--deep-blue) 100%); background-attachment: fixed; color: var(--soft-white); margin: 0; }

        .highlight-brand { font-weight: 700; color: #48cae4; text-shadow: 0 0 10px rgba(72, 202, 228, 0.4); }

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
        /* ============================================================ */

        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), 
                        url('<?= base_url('images/background.png') ?>'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 150px 40px;
            color: white;
            border-radius: 0 0 80px 80px;
            margin-bottom: 60px;
        }
        .activity-line { height: 5px; width: 80px; background: var(--accent-cyan); border-radius: 10px; margin: 15px auto 0 auto; }

        .booking-main-container { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 30px; 
            padding: 40px; 
            margin-bottom: 100px;
            overflow-x: auto;
        }

        .custom-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 15px; }
        .custom-table thead th { border: none; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; opacity: 0.7; padding: 10px 20px; }
        .custom-table tbody tr { background: rgba(255, 255, 255, 0.05); transition: 0.3s; }
        .custom-table tbody tr:hover { background: rgba(255, 255, 255, 0.1); transform: scale(1.01); }
        .custom-table td { padding: 20px; vertical-align: middle; border: none; }
        .custom-table td:first-child { border-radius: 20px 0 0 20px; }
        .custom-table td:last-child { border-radius: 0 20px 20px 0; }

        .badge-status { padding: 8px 16px; border-radius: 50px; font-weight: 600; font-size: 0.8rem; border: 1px solid transparent; }
        .status-pending { background: rgba(255, 193, 7, 0.1); color: #ffc107; border-color: #ffc107; }
        .status-confirmed { background: rgba(40, 167, 69, 0.1); color: #28a745; border-color: #28a745; }
        .status-completed { background: rgba(72, 202, 228, 0.1); color: #48cae4; border-color: #48cae4; }
        .status-cancelled { background: rgba(220, 53, 69, 0.1); color: #dc3545; border-color: #dc3545; }

        .btn-view-details { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border: none; padding: 8px 20px; border-radius: 50px; transition: 0.3s; }
        .btn-view-details:hover { background: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(72, 202, 228, 0.4); }

        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

        #scrollBtn {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            width: 50px;
            height: 150px;
            background: rgba(10, 88, 114, 0.85);
            backdrop-filter: blur(10px);
            border: 3px solid var(--accent-cyan);
            border-radius: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-cyan);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        #scrollBtn:hover {
            background: var(--accent-cyan);
            color: var(--deep-blue);
            right: 25px;
        }

        #scrollBtn i {
            font-size: 2.5rem;
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            margin: 0 auto;
        }

        .rotate-up {
            transform: rotate(180deg);
        }
        html {
            scroll-behavior: smooth;
        }
        .tooltip-btn { position: relative; }
        .tooltip-btn::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 120%; left: 50%;
            transform: translateX(-50%);
            background: #052c39; color: #48cae4;
            padding: 5px 10px; border-radius: 6px;
            font-size: 0.7rem; font-weight: 600;
            white-space: nowrap; opacity: 0; pointer-events: none;
            transition: 0.3s; border: 1px solid #48cae4;
        }
        .tooltip-btn:hover::after { opacity: 1; }

        .btn-view-details { 
            background: rgba(72, 202, 228, 0.15);
            color: var(--accent-cyan);
            border: 1px solid var(--accent-cyan);
            padding: 8px 20px; 
            border-radius: 50px; 
            transition: 0.3s;
            font-size: 0.85rem;
            cursor: pointer;
        }
        .btn-view-details:hover { 
            background: var(--accent-cyan); 
            color: var(--deep-blue);
            transform: translateY(-2px); 
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
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom active">My Bookings</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <!-- UPDATED: added Help button beside Logout -->
        <div class="logout-wrapper">
            <button class="btn-help-custom" onclick="document.getElementById('helpModal').classList.remove('d-none')">
                <i class="fa-solid fa-circle-question me-1"></i> Help
            </button>
            <a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a>
        </div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">Manage Your Bookings</h1>
        <p class="lead mb-0 opacity-90 mx-auto" style="max-width: 800px;">View and track your reserved activities. Stay updated on your schedules, booking status, and upcoming water adventures at Waves Water Sports.</p>
    </div>
</header>

<div class="container">
    <div class="booking-main-container shadow-lg">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Activity Details</th>
                    <th>Date & Time</th>
                    <th>Booking Status</th>
                    <th>Payment</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($bookings)): ?>
                <?php foreach ($bookings as $booking): ?>
                    <?php
                        $statusClass = match(strtolower($booking['status'])) {
                            'pending' => 'status-pending',
                            'confirmed', 'approved' => 'status-confirmed',
                            'completed' => 'status-completed',
                            'cancelled' => 'status-cancelled',
                            default => ''
                        };

                        $paymentLabel = ($booking['payment_status'] == 'paid') 
                            ? '<span class="text-success fw-bold">Paid</span>' 
                            : '<span class="text-warning fw-bold">Unpaid</span>';

                        $icon = match(strtolower($booking['activity_name'])) {
                            'jetskiing' => 'fa-jet-ski text-info',
                            'banana boat riding' => 'fa-person-swimming text-warning',
                            'kayaking' => 'fa-umbrella-beach text-light',
                            default => 'fa-water text-info'
                        };
                    ?>

                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3 p-3 bg-info bg-opacity-10 rounded-circle">
                                    <i class="fa-solid <?= $icon ?> fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?= esc($booking['activity_name']) ?></h6>
                                    <small class="opacity-50">Booking ID: #<?= esc($booking['booking_code']) ?></small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="fw-bold">
                                <?= date('F d, Y', strtotime($booking['date'])) ?>
                            </div>
                            <small class="opacity-70 text-info">
                                <?= date('h:i A', strtotime($booking['time'])) ?>
                            </small>
                        </td>

                        <td>
                            <span class="badge-status <?= $statusClass ?>">
                                <i class="fa-solid fa-circle-check me-1"></i>
                                <?= ucfirst($booking['status']) ?>
                            </span>
                        </td>

                        <td>
                            <?= $paymentLabel ?>
                        </td>

                        <td class="text-center">
                            <button 
                                class="btn-view-details tooltip-btn"
                                data-tooltip="Open full details"
                                onclick="viewDetails(<?= $booking['id'] ?>)"
                            >
                                <i class="fa-solid fa-eye me-1"></i> View Details
                            </button>
                        </td>
                    </tr>

                <?php endforeach; ?>

<?php else: ?>
    <tr>
        <td colspan="5" class="text-center py-5">
            <i class="fa-solid fa-calendar-xmark fa-2x mb-3 opacity-50"></i>
            <p class="mb-0">No bookings found.</p>
        </td>
    </tr>
<?php endif; ?>
</tbody>
        </table>
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

        function viewDetails(id) {
            window.location.href = "<?= base_url('user/booking-details/') ?>" + id;
        }

        /* ADDED: Close help modal when clicking outside the box */
        document.getElementById('helpModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('d-none');
            }
        });
    </script>

    <div id="scrollBtn" onclick="smartScroll()" title="Navigate Page">
        <i class="fa-solid fa-arrow-down" id="scrollIcon"></i>
    </div>

</body>
</html>