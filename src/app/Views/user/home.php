<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --deep-blue: #052c39;
            --ocean-blue: #0a5872;
            --accent-cyan: #48cae4;
        }
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .navbar { background: var(--deep-blue); }
        .hero-section { 
            background: linear-gradient(135deg, var(--ocean-blue), var(--deep-blue));
            color: white;
            padding: 60px 0;
            border-radius: 0 0 50px 50px;
        }
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
        }
        .card-custom:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">WAVES</a>
        <div class="ms-auto">
            <span class="text-white me-3">Hello, <?= auth()->user()->username ?>!</span>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm rounded-pill">Logout</a>
        </div>
    </div>
</nav>

<div class="hero-section text-center">
    <div class="container">
        <h1 class="fw-bold">Welcome to Waves, <?= auth()->user()->username ?>!</h1>
        <p class="lead">Ready for your next water adventure?</p>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-custom p-4 text-center">
                <h5 class="fw-bold text-muted">My Bookings</h5>
                <h2 class="text-primary fw-bold">0</h2>
                <a href="#" class="btn btn-primary rounded-pill mt-2">View History</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-custom p-4 text-center border-primary border">
                <h5 class="fw-bold text-muted">Book Now</h5>
                <p class="small">Explore available water sports</p>
                <button class="btn btn-success rounded-pill mt-2">Explore Activities</button>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card card-custom p-4 text-center">
                <h5 class="fw-bold text-muted">Account Settings</h5>
                <p class="small">Update your profile info</p>
                <button class="btn btn-outline-secondary rounded-pill mt-2">Edit Profile</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>