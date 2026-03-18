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

        .waves-navbar { background: var(--ocean-blue); padding: 35px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .header-container { display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .nav-link-custom { color: rgba(255, 255, 255, 0.8); text-decoration: none; padding: 8px 16px; border-radius: 50px; transition: 0.3s; }
        .nav-link-custom.active { background: var(--accent-cyan); color: var(--deep-blue); font-weight: 600; }

        .welcome-hero {
            background: linear-gradient(rgba(5, 44, 57, 0.6), rgba(5, 44, 57, 0.8)), url('<?= base_url('images/coveract.png') ?>'); 
            background-size: cover; background-position: center; padding: 120px 40px; text-align: center; border-radius: 0 0 80px 80px; margin-bottom: 50px;
        }

        /* Container & Cards */
        .booking-main-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 30px; margin-bottom: 80px; }
        .step-card { background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 30px; padding: 30px; margin-bottom: 25px; }
        .summary-card { background: white; color: var(--deep-blue); border-radius: 30px; padding: 30px; position: sticky; top: 120px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }

        /* Selected Activity Styling */
        .selected-activity-box { background: var(--ocean-blue); border-radius: 20px; padding: 25px; border-left: 8px solid var(--accent-cyan); position: relative; }
        .btn-change-act { position: absolute; top: 20px; right: 20px; background: rgba(255,255,255,0.1); color: white; border: 1px solid white; border-radius: 50px; padding: 5px 15px; font-size: 0.8rem; text-decoration: none; transition: 0.3s; }
        .btn-change-act:hover { background: white; color: var(--deep-blue); }

        /* Calendar & Time Slots */
        .calendar-days-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; text-align: center; }
        .day-box { aspect-ratio: 1; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-weight: 600; cursor: pointer; transition: 0.3s; background: rgba(255,255,255,0.1); }
        .day-box.available { background: var(--accent-cyan); color: var(--deep-blue); }
        .day-box.booked { background: #ff6b6b; color: white; cursor: not-allowed; opacity: 0.6; }
        .day-box.today { border: 2px solid white; }

        .time-slot-btn { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; border-radius: 12px; padding: 10px; transition: 0.3s; width: 100%; text-align: center; margin-bottom: 10px; cursor: pointer; }
        .time-slot-btn:hover, .time-slot-btn.active { background: var(--accent-cyan); color: var(--deep-blue); border-color: var(--accent-cyan); font-weight: 600; }

        /* Safety Check */
        .safety-badge { padding: 10px 20px; border-radius: 50px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; }
        .safe-bg { background: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745; }
        .unsafe-warning { background: #ff4d4d; color: white; padding: 15px; border-radius: 15px; text-align: center; font-weight: 600; }

        .form-control-custom { background: white; border-radius: 15px; padding: 12px; border: none; }
        .btn-confirm { background: var(--ocean-blue); color: white; width: 100%; padding: 18px; border-radius: 50px; border: none; font-weight: 700; font-size: 1.1rem; transition: 0.3s; }
        .btn-confirm:hover { background: var(--accent-cyan); color: var(--deep-blue); transform: translateY(-3px); }

        @media (max-width: 992px) { .booking-main-grid { grid-template-columns: 1fr; } .summary-card { position: static; } }
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
            <a href="<?= base_url('user/my-bookings') ?>" class="nav-link-custom">My Bookings</a>
        </div>
        <div class="logout-wrapper"><a href="<?= base_url('logout') ?>" class="btn-logout-custom">Logout</a></div>
    </div>
</nav>

<header class="welcome-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Book Your Water Adventure</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 800px;">Complete your reservation for your chosen activity at Matabungkay Beach. Select your schedule and confirm your booking.</p>
    </div>
</header>

<div class="container">
    <div class="booking-main-grid">
        
        <div class="steps-column">
            
            <div class="step-card">
                <h5 class="fw-bold mb-4 text-info"><i class="fa-solid fa-person-surfing me-2"></i> Selected Activity</h5>
                <div class="selected-activity-box">
                    <a href="<?= base_url('user/activities') ?>" class="btn-change-act">Change Activity</a>
                    <h3 class="fw-bold text-white mb-2">Jet Ski</h3>
                    <p class="small opacity-75 mb-3">Ride across the open sea on a powerful jet ski. Perfect for thrill-seekers.</p>
                    <div class="row text-white small g-2">
                        <div class="col-6"><i class="fa-solid fa-clock me-2"></i> Duration: 15 mins</div>
                        <div class="col-6"><i class="fa-solid fa-users me-2"></i> Max Riders: 1-2 persons</div>
                        <div class="col-6"><i class="fa-solid fa-vest me-2"></i> Gear: Life Vest</div>
                        <div class="col-6"><i class="fa-solid fa-gauge-high me-2"></i> Difficulty: Moderate</div>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <h5 class="fw-bold mb-4"><i class="fa-regular fa-calendar-days me-2 text-info"></i> 1. Choose Date</h5>
                <div class="calendar-days-grid mb-3">
                    <div class="fw-bold text-info">S</div><div class="fw-bold">M</div><div class="fw-bold">T</div><div class="fw-bold">W</div><div class="fw-bold">T</div><div class="fw-bold">F</div><div class="fw-bold text-info">S</div>
                    <div class="day-box available today">16</div><div class="day-box available">17</div><div class="day-box booked">18</div>
                    <div class="day-box available">19</div><div class="day-box available">20</div><div class="day-box available">21</div><div class="day-box available">22</div>
                </div>
                <div class="d-flex gap-3 small opacity-75 justify-content-center">
                    <span><i class="fa-solid fa-circle text-info"></i> Available</span>
                    <span><i class="fa-solid fa-circle text-danger"></i> Fully Booked</span>
                </div>
            </div>

            <div class="step-card">
                <h5 class="fw-bold mb-4"><i class="fa-regular fa-clock me-2 text-info"></i> 2. Select Time Slot</h5>
                <div class="row g-2 text-center">
                    <div class="col-md-4"><div class="time-slot-btn">09:00 AM</div></div>
                    <div class="col-md-4"><div class="time-slot-btn active">10:00 AM</div></div>
                    <div class="col-md-4"><div class="time-slot-btn">11:00 AM</div></div>
                    <div class="col-md-4"><div class="time-slot-btn">01:00 PM</div></div>
                    <div class="col-md-4"><div class="time-slot-btn">02:00 PM</div></div>
                    <div class="col-md-4"><div class="time-slot-btn">03:00 PM</div></div>
                </div>
                <div class="mt-3 text-center small text-info"><i class="fa-solid fa-circle-info me-1"></i> Slots Available: 3</div>
            </div>

            <div class="step-card">
                <div class="row g-4">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-users me-2 text-info"></i> 3. Participants</h5>
                        <select class="form-select form-control-custom">
                            <option>1 Person</option>
                            <option>2 Persons</option>
                        </select>
                        <small class="opacity-50">(Max: 2 persons for Jet Ski)</small>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-pen-to-square me-2 text-info"></i> 4. Additional Requests</h5>
                        <textarea class="form-control form-control-custom" rows="2" placeholder="Special requests, health concerns..."></textarea>
                    </div>
                </div>
            </div>

            <div class="step-card border-warning">
                <h5 class="fw-bold mb-4 text-warning"><i class="fa-solid fa-tower-broadcast me-2"></i> Current Sea Conditions (MARISENSE)</h5>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="row g-3 small opacity-90">
                            <div class="col-4">Wind: 10 knots</div>
                            <div class="col-4">Wave: 0.9m</div>
                            <div class="col-4">Period: 5s</div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="safety-badge safe-bg"><i class="fa-solid fa-circle-check"></i> SAFE</div>
                    </div>
                </div>
                </div>
        </div>

        <div class="summary-column">
            <div class="summary-card">
                <h4 class="fw-bold mb-4 border-bottom pb-2">Booking Summary</h4>
                <div class="mb-3 d-flex justify-content-between">
                    <span class="opacity-75">Activity:</span>
                    <span class="fw-bold">Jet Ski</span>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <span class="opacity-75">Date:</span>
                    <span class="fw-bold">March 16, 2026</span>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <span class="opacity-75">Time:</span>
                    <span class="fw-bold">10:00 AM – 11:00 AM</span>
                </div>
                <div class="mb-4 d-flex justify-content-between">
                    <span class="opacity-75">Participants:</span>
                    <span class="fw-bold">1</span>
                </div>
                
                <div class="p-3 bg-light rounded-4 mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Activity Fee:</span>
                        <span class="fw-bold">₱2,500</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-info">
                        <span>Service Charge:</span>
                        <span class="fw-bold">₱150</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between h5 fw-bold mb-0">
                        <span>Total:</span>
                        <span class="text-primary">₱2,650</span>
                    </div>
                </div>

                <div class="form-check mb-4 small">
                    <input class="form-check-input" type="checkbox" id="guidelines" required>
                    <label class="form-check-label" for="guidelines">I agree to safety guidelines and rules.</label>
                </div>

                <button class="btn-confirm">Confirm Reservation</button>
            </div>
        </div>

    </div>
</div>

<footer class="text-center">
    <div class="container d-flex flex-column align-items-center">
        <div class="copyright-text opacity-50">&copy; 2026 Waves Water Sports | Tech by <span class="text-info fw-bold">MARISENSE</span></div>
    </div>
</footer>

</body>
</html>