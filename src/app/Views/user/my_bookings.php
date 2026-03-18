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
        .logout-wrapper { flex: 1; display: flex; justify-content: flex-end; }
        .nav-link-custom { color: rgba(255, 255, 255, 0.8); text-decoration: none; font-size: 1rem; font-weight: 500; padding: 8px 16px; border-radius: 50px; transition: 0.3s; white-space: nowrap; }
        .nav-link-custom:hover { color: var(--accent-cyan); background: rgba(255, 255, 255, 0.1); }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }
        .btn-logout-custom { color: #ff6b6b; text-decoration: none; font-weight: 600; font-size: 0.85rem; padding: 8px 18px; border: 1px solid rgba(255, 107, 107, 0.3); border-radius: 50px; transition: 0.3s; }
        .btn-logout-custom:hover { background: #ff6b6b; color: white; }
        /* Unified Hero Section */
        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.5), rgba(5, 44, 57, 0.7)), 
                        url('<?= base_url('images/marisensebg.png') ?>'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 150px 40px;
            color: white;
            border-radius: 0 0 80px 80px;
            margin-bottom: 60px;
        }
        .activity-line { height: 5px; width: 80px; background: var(--accent-cyan); border-radius: 10px; margin: 15px auto 0 auto; }

        /* Booking Table Container */
        .booking-main-container { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 30px; 
            padding: 40px; 
            margin-bottom: 100px;
            overflow-x: auto;
        }

        /* Table Styling */
        .custom-table { width: 100%; color: white; border-collapse: separate; border-spacing: 0 15px; }
        .custom-table thead th { border: none; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px; opacity: 0.7; padding: 10px 20px; }
        .custom-table tbody tr { background: rgba(255, 255, 255, 0.05); transition: 0.3s; }
        .custom-table tbody tr:hover { background: rgba(255, 255, 255, 0.1); transform: scale(1.01); }
        .custom-table td { padding: 20px; vertical-align: middle; border: none; }
        .custom-table td:first-child { border-radius: 20px 0 0 20px; }
        .custom-table td:last-child { border-radius: 0 20px 20px 0; }

        /* Status Badges */
        .badge-status { padding: 8px 16px; border-radius: 50px; font-weight: 600; font-size: 0.8rem; border: 1px solid transparent; }
        .status-pending { background: rgba(255, 193, 7, 0.1); color: #ffc107; border-color: #ffc107; }
        .status-confirmed { background: rgba(40, 167, 69, 0.1); color: #28a745; border-color: #28a745; }
        .status-completed { background: rgba(72, 202, 228, 0.1); color: #48cae4; border-color: #48cae4; }
        .status-cancelled { background: rgba(220, 53, 69, 0.1); color: #dc3545; border-color: #dc3545; }

        /* Action Buttons */
        .btn-view-details { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 700; border: none; padding: 8px 20px; border-radius: 50px; transition: 0.3s; }
        .btn-view-details:hover { background: white; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(72, 202, 228, 0.4); }

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
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
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
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="me-3 p-3 bg-info bg-opacity-10 rounded-circle text-info"><i class="fa-solid fa-jet-ski fa-lg"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Jetskiing (1 Hour)</h6>
                                <small class="opacity-50">Booking ID: #WVS-2026-001</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold">March 25, 2026</div>
                        <small class="opacity-70 text-info">10:30 AM</small>
                    </td>
                    <td><span class="badge-status status-confirmed"><i class="fa-solid fa-circle-check me-1"></i> Confirmed</span></td>
                    <td><span class="text-success fw-bold">Paid</span></td>
                    <td class="text-center"><button class="btn-view-details">View Details</button></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="me-3 p-3 bg-warning bg-opacity-10 rounded-circle text-warning"><i class="fa-solid fa-person-swimming fa-lg"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Banana Boat Riding</h6>
                                <small class="opacity-50">Booking ID: #WVS-2026-002</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold">March 28, 2026</div>
                        <small class="opacity-70 text-info">02:00 PM</small>
                    </td>
                    <td><span class="badge-status status-pending"><i class="fa-solid fa-clock me-1"></i> Pending</span></td>
                    <td><span class="text-warning fw-bold">Unpaid</span></td>
                    <td class="text-center"><button class="btn-view-details">View Details</button></td>
                </tr>

                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="me-3 p-3 bg-light bg-opacity-10 rounded-circle text-white"><i class="fa-solid fa-umbrella-beach fa-lg"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Kayaking (Standard)</h6>
                                <small class="opacity-50">Booking ID: #WVS-2026-003</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold">March 15, 2026</div>
                        <small class="opacity-70 text-info">09:00 AM</small>
                    </td>
                    <td><span class="badge-status status-completed"><i class="fa-solid fa-flag-checkered me-1"></i> Completed</span></td>
                    <td><span class="text-info fw-bold">Paid</span></td>
                    <td class="text-center"><button class="btn-view-details">View Details</button></td>
                </tr>
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