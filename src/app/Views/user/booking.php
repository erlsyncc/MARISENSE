<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Session | Waves Water Sports</title>
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

        /* CALENDAR SECTION (Top Part) */
        .calendar-main-wrapper {
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 30px;
            padding: 30px; max-width: 1000px; margin: 0 auto 40px auto;
        }
        .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .calendar-days-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center; }
        .day-box { 
            aspect-ratio: 1; display: flex; align-items: center; justify-content: center; 
            border-radius: 12px; font-weight: 600; transition: 0.3s; background: rgba(255,255,255,0.1); 
        }
        .day-box.booked { background: #ff6b6b; color: white; position: relative; }
        .day-box.booked::after { content: 'FULL'; position: absolute; bottom: 5px; font-size: 0.6rem; }
        .day-box.available { background: var(--accent-cyan); color: var(--deep-blue); cursor: pointer; }
        .day-box.available:hover { transform: scale(1.1); background: white; }

        /* BOOKING FORM SECTION (Bottom Part) */
        .booking-card {
            background: white; color: var(--deep-blue); border-radius: 30px; padding: 40px;
            max-width: 1000px; margin: 0 auto 80px auto; box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .form-label { font-weight: 600; color: var(--ocean-blue); }
        .form-control, .form-select { border-radius: 12px; padding: 12px; border: 2px solid #eee; }

        /* Package Selection Cards (Horizontal Scroll gaya ng inspo mo) */
        .package-scroll { display: flex; gap: 20px; overflow-x: auto; padding: 20px 0; scrollbar-width: thin; }
        .package-item { 
            min-width: 250px; background: #f8f9fa; border: 2px solid #eee; 
            border-radius: 20px; padding: 20px; cursor: pointer; transition: 0.3s; 
        }
        .package-item:hover, .package-item.selected { border-color: var(--accent-cyan); background: #e0f7fa; transform: translateY(-5px); }
        .package-price { font-size: 1.5rem; font-weight: 700; color: var(--ocean-blue); }

        .btn-reserve {
            background: var(--ocean-blue); color: white; font-weight: 700; border-radius: 50px;
            padding: 15px; width: 100%; border: none; transition: 0.3s; text-transform: uppercase;
        }
        .btn-reserve:hover { background: var(--accent-cyan); color: var(--deep-blue); }

        .btn-book-now:hover { background: white; color: var(--deep-blue); transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        /* Footer Styles */
        footer { background: var(--deep-blue); padding: 100px 0 40px 0; color: rgba(255, 255, 255, 0.6) !important; border-top: 1px solid rgba(255, 255, 255, 0.1); width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .social-icons { display: flex; justify-content: center; gap: 20px; margin-bottom: 25px; }
        .social-icons i { color: rgba(255, 255, 255, 0.7); transition: 0.3s; cursor: pointer; font-size: 1.5rem; }
        .social-icons i:hover { color: var(--accent-cyan); transform: scale(1.2); }

        /* Specific Calendar Colors */
        .day-box.available { 
            background: #48cae4 !important; /* Accent Cyan */
            color: #052c39 !important; 
            cursor: pointer; 
        }

        .day-box.booked { 
            background: #ff6b6b !important; /* Soft Red */
            color: white !important; 
            cursor: not-allowed;
            opacity: 0.8;
        }

        .day-box.today { 
            border: 3px solid #ffffff !important; 
            box-shadow: 0 0 10px rgba(255,255,255,0.5);
            transform: scale(1.05);
            z-index: 1;
        }

        /* Legend Updates */
        .legend-today { border: 2px solid white; display: inline-block; width: 15px; height: 15px; border-radius: 3px; margin-right: 5px; }

        .section-header {
            text-align: center;
            margin-top: 3rem;
            margin-bottom: 2rem;
            width: 100%;
        }
        .section-header p {
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
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
            <a href="<?= base_url('user/booking') ?>" class="nav-link-custom active">Book & Reserve</a>
            <a href="<?= base_url('user/reviews') ?>" class="nav-link-custom">Reviews</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Plan Your Adventure</h1>
        <p class="lead">Check availability and secure your slot in seconds.</p>
    </div>
</header>

<div class="container">
    
    <div class="section-header">
        <h2 class="fw-bold text-white">1. Check Availability</h2>
        <p class="text-white opacity-75">Select a date to see available water activities</p>
    </div>

    <div class="calendar-main-wrapper shadow-lg">
        <div class="calendar-header">
            <h4 class="mb-0 fw-bold" id="currentMonthYear"><i class="fa-regular fa-calendar-check me-2"></i></h4>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="changeMonth(-1)"> < </button>
                <button class="btn btn-sm btn-light rounded-circle shadow-sm" onclick="changeMonth(1)"> > </button>
            </div>
        </div>

        <div class="calendar-days-grid mb-2">
            <div class="fw-bold text-info">Sun</div><div class="fw-bold text-white">Mon</div><div class="fw-bold text-white">Tue</div>
            <div class="fw-bold text-white">Wed</div><div class="fw-bold text-white">Thu</div><div class="fw-bold text-white">Fri</div><div class="fw-bold text-info">Sat</div>
        </div>

        <div class="calendar-days-grid" id="calendarDays"></div>

        <div class="mt-4 d-flex justify-content-center gap-4">
            <small><i class="fa-solid fa-square text-info"></i> Available</small>
            <small><i class="fa-solid fa-square text-danger"></i> Fully Booked</small>
            <small><span class="legend-today"></span> Today</small>
        </div>
    </div>

    <div class="section-header">
        <h2 class="fw-bold text-white">2. Reservation Details</h2>
        <p class="text-white opacity-75">Fill out the form below to complete your booking</p>
    </div>

    <div class="booking-card">
        <form action="<?= base_url('booking/submit') ?>" method="POST">
            
            <div class="row g-4">
                <div class="col-12">
                    <label class="form-label">Select Activity Package</label>
                    <div class="package-scroll">
                        <div class="package-item selected">
                            <span class="badge bg-info mb-2">Solo</span>
                            <div class="fw-bold">Jet Ski Solo</div>
                            <div class="package-price">₱2,500</div>
                            <small class="text-muted">15 Minutes + Safety Gear</small>
                        </div>
                        <div class="package-item">
                            <span class="badge bg-primary mb-2">Group</span>
                            <div class="fw-bold">Banana Boat (5 pax)</div>
                            <div class="package-price">₱3,500</div>
                            <small class="text-muted">10 Minutes + Photo Ops</small>
                        </div>
                        <div class="package-item">
                            <span class="badge bg-warning mb-2">Adventure</span>
                            <div class="fw-bold">Full Water Day</div>
                            <div class="package-price">₱5,000</div>
                            <small class="text-muted">Kayak + Jetski + Saucer</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Selected Date</label>
                    <input type="text" class="form-control bg-light" value="March 16, 2026" readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Preferred Time Slot</label>
                    <select class="form-select">
                        <option>09:00 AM - 10:00 AM</option>
                        <option>10:30 AM - 11:30 AM</option>
                        <option>01:00 PM - 02:00 PM</option>
                        <option>03:00 PM - 04:00 PM</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Additional Requests / Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Special requirements, health concerns, etc."></textarea>
                </div>

                <div class="col-12 mt-4">
                    <div class="p-3 rounded-4 bg-light mb-4">
                        <div class="d-flex justify-content-between">
                            <span>Activity Fee:</span>
                            <span class="fw-bold">₱2,500.00</span>
                        </div>
                        <div class="d-flex justify-content-between text-info">
                            <span>Service Charge:</span>
                            <span class="fw-bold">₱150.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between h5 fw-bold">
                            <span>Total Amount:</span>
                            <span>₱2,650.00</span>
                        </div>
                    </div>
                    <button type="submit" class="btn-reserve">Confirm Reservation</button>
                </div>
            </div>
        </form>
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
let date = new Date();

function renderCalendar() {
    date.setDate(1);
    const monthDays = document.getElementById("calendarDays");
    const monthYear = document.getElementById("currentMonthYear");
    
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();
    const firstDayIndex = date.getDay();
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();
    const nextDays = 7 - lastDayIndex - 1;

    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    monthYear.innerHTML = `<i class="fa-regular fa-calendar-check me-2"></i> ${months[date.getMonth()]} ${date.getFullYear()}`;

    let days = "";

    // Empty boxes for previous month
    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="day-box empty"></div>`;
    }

    // Actual days of the month
    for (let i = 1; i <= lastDay; i++) {
        let isToday = (i === new Date().getDate() && date.getMonth() === new Date().getMonth() && date.getFullYear() === new Date().getFullYear()) ? "today" : "";
        
        // Example: Naka-hardcode muna ang 'booked' sa 3 at 6 para makita mo ang kulay
        let status = (i === 3 || i === 6) ? "booked" : "available";
        
        days += `<div class="day-box ${status} ${isToday}" onclick="selectDate(${i})">${i}</div>`;
    }

    monthDays.innerHTML = days;
}

function changeMonth(dir) {
    date.setMonth(date.getMonth() + dir);
    renderCalendar();
}

function selectDate(day) {
    // Dito mo i-uupdate yung input field sa baba pag nag click ng date
    const selectedMonth = date.getMonth() + 1;
    const selectedYear = date.getFullYear();
    const fullDate = `${months[date.getMonth()]} ${day}, ${selectedYear}`;
    
    // Hanapin yung input field ng Selected Date at palitan ang value
    const dateInput = document.querySelector('input[value="March 16, 2026"]');
    if(dateInput) dateInput.value = fullDate;
}

renderCalendar();
</script>

</body>
</html>