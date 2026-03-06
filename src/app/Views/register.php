<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --deep-blue: #052c39;
            --ocean-blue: #0a5872;
            --accent-cyan: #48cae4;
            --soft-white: #f0f8ff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: radial-gradient(circle at center, #7ac2e8, #5a87af);
            overflow: hidden;
            transition: background 0.1s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-container {
            display: flex;
            width: 950px;
            height: 580px; /* Reduced height for better fit */
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(5, 44, 57, 0.15);
            animation: fadeInUp 0.8s ease-out forwards;
            z-index: 10;
        }

        /* Left Side: Visual & Bubbles */
        .register-visual {
            flex: 1;
            background: linear-gradient(135deg, var(--ocean-blue), var(--deep-blue));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        canvas#particleCanvas {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
        }

        .register-visual h2 {
            font-weight: 700;
            font-size: 3rem;
            z-index: 2;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .register-visual p {
            font-weight: 300;
            opacity: 0.9;
            z-index: 2;
            font-size: 0.9rem;
        }

        /* Right Side: Form Area */
        .register-form-area {
            flex: 1.2;
            padding: 40px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-group-custom {
            margin-bottom: 15px; /* Tighter spacing */
        }

        .form-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--ocean-blue);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 4px;
            display: block;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #e9ecef;
            border-radius: 0;
            padding: 8px 0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            background: transparent;
            width: 100%;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--accent-cyan);
        }

        .btn-register {
            background: linear-gradient(45deg, var(--accent-cyan), #0077b6);
            border: none;
            border-radius: 50px;
            padding: 12px;
            font-weight: 600;
            color: white;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(0, 119, 182, 0.2);
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0, 119, 182, 0.3);
            color: white;
        }

        .login-link {
            font-size: 0.85rem;
            margin-top: 20px;
            color: #6c757d;
        }

        .login-link a {
            color: var(--accent-cyan);
            text-decoration: none;
            font-weight: 700;
            transition: 0.3s;
        }

        .login-link a:hover {
            color: #0077b6;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .register-container { width: 95%; height: auto; flex-direction: column; }
            .register-visual { padding: 30px; }
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="register-visual" id="interactiveZone">
        <canvas id="particleCanvas"></canvas>
        <h2>JOIN US</h2>
        <p>Start your sea adventure with Waves.</p>
    </div>

    <div class="register-form-area">
        <h3 class="fw-bold mb-1">Create Account</h3>
        <p class="text-muted small mb-3">Sign up to start booking your activities.</p>

        <?php if (session('errors')) : ?>
            <div class="alert alert-danger py-2 small mb-3">
                <ul class="mb-0 ps-3">
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('registerAuth') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group-custom">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= old('username') ?>" placeholder="Your unique username" required>
            </div>

            <div class="form-group-custom">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?= old('email') ?>" placeholder="name@example.com" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label">Confirm</label>
                        <input type="password" name="password_confirm" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-register w-100">Create My Account</button>
        </form>

        <div class="text-center login-link">
            Already have an account? <a href="<?= url_to('login') ?>">Login Here</a>
        </div>
    </div>
</div>

<script>
    // Mouse Interactive Background
    document.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth) * 100;
        const y = (e.clientY / window.innerHeight) * 100;
        document.body.style.background = `radial-gradient(circle at ${x}% ${y}%, #7ac2e8, #5a87af)`;
    });

    // Bubble Particles
    const canvas = document.getElementById('particleCanvas');
    const ctx = canvas.getContext('2d');
    const zone = document.getElementById('interactiveZone');
    let particles = [];
    let mouse = { x: null, y: null };

    function resize() {
        canvas.width = zone.offsetWidth;
        canvas.height = zone.offsetHeight;
    }
    window.addEventListener('resize', resize);
    resize();

    zone.addEventListener('mousemove', (e) => {
        const rect = zone.getBoundingClientRect();
        mouse.x = e.clientX - rect.left;
        mouse.y = e.clientY - rect.top;
    });

    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 3 + 1;
            this.speedX = Math.random() * 0.5 - 0.25;
            this.speedY = Math.random() * -1 - 0.5;
            this.opacity = Math.random() * 0.5 + 0.1;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            if (this.y < 0) this.y = canvas.height;
        }
        draw() {
            ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    function init() {
        particles = [];
        for (let i = 0; i < 40; i++) particles.push(new Particle());
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animate);
    }

    init();
    animate();
</script>

</body>
</html>