<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    .login-container {
        display: flex;
        width: 900px;
        height: 600px; /* Increased height to accommodate new links */
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(5, 44, 57, 0.15);
        animation: fadeInUp 1s ease-out forwards;
        z-index: 10;
    }

    /* Left Side: Interactive Visual */
    .login-visual {
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

    .login-visual h2 {
        font-weight: 700;
        font-size: 3.5rem;
        z-index: 2;
        letter-spacing: 2px;
        margin-bottom: 5px;
        line-height: 1;
    }

    .login-visual p {
        font-weight: 300;
        opacity: 0.9;
        z-index: 2;
        font-size: 0.9rem;
    }

    /* Right Side: Form Area */
    .login-form-area {
        flex: 1.2;
        padding: 50px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .form-group-custom {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--ocean-blue);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 5px;
        display: block;
    }

    .form-control {
        border: none;
        border-bottom: 2px solid #e9ecef;
        border-radius: 0;
        padding: 10px 0;
        transition: all 0.3s ease;
        font-size: 1rem;
        background: transparent;
        width: 100%;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: var(--accent-cyan);
    }

    .extra-options {
        display: flex;
        justify-content: flex-end;
        margin-top: -10px;
        margin-bottom: 20px;
    }

    .extra-options a {
        font-size: 0.8rem;
        color: var(--ocean-blue);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease; /* Smooth transition */
    }

    .extra-options a:hover {
        color: var(--accent-cyan); 
        text-shadow: 0 0 8px rgba(72, 202, 228, 0.6); /* Lighting effect */
    }

    /* Hover effect para sa Create Account link */
    .create-account-text a {
        color: var(--accent-cyan);
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .create-account-text a:hover {
        color: #0077b6; 
        text-shadow: 0 0 10px rgba(0, 119, 182, 0.4); /* Glow effect */
        text-decoration: underline;
    }

    .btn-login {
        background: linear-gradient(45deg, var(--accent-cyan), #0077b6);
        border: none;
        border-radius: 50px;
        padding: 14px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0, 119, 182, 0.2);
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(0, 119, 182, 0.3);
        color: white;
    }

    .create-account-text {
        font-size: 0.85rem;
        margin-top: 20px;
        color: #6c757d;
    }

    .create-account-text a {
        color: var(--accent-cyan);
        text-decoration: none;
        font-weight: 700;
    }

    .back-link {
        margin-top: 25px;
    }

    .back-link a {
        text-decoration: none;
        color: #adb5bd;
        font-size: 0.85rem;
        transition: 0.3s;
    }

    .back-link a:hover { color: var(--ocean-blue); }

    @media (max-width: 768px) {
        .login-container { width: 95%; height: auto; flex-direction: column; }
    }
</style>
</head>
<body>

<div class="login-container">
    <div class="login-visual" id="interactiveZone">
        <canvas id="particleCanvas"></canvas>
        <h2>WAVES</h2>
        <p>Your journey to the blue begins here.</p>
    </div>

    <div class="login-form-area">
        <h3 class="fw-bold mb-1">Welcome Back!</h3>
        <p class="text-muted small mb-4">Please log in to manage your bookings.</p>

        <?php if($session->getFlashdata('error')): ?>
        <div class="small fw-bold mb-3" style="color: #ff4d4d; border-left: 3px solid #ff4d4d; padding-left: 10px;">
            <?= $session->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

        <form method="post" action="/loginAuth">
            <div class="form-group-custom">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
            </div>

            <div class="form-group-custom">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="extra-options">
                <a href="<?= url_to('magic-link') ?>">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-login w-100">Login to Dashboard</button>
        </form>

        <div class="text-center create-account-text">
            Don't have an account? <a href="<?= url_to('register') ?>">Create Account</a>
        </div>

        <div class="back-link text-center">
            <a href="/">← Return to Home Screen</a>
        </div>
    </div>
</div>

<script>
    // Particle and mouse effect logic remains the same for consistency
    document.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth) * 100;
        const y = (e.clientY / window.innerHeight) * 100;
        document.body.style.background = `radial-gradient(circle at ${x}% ${y}%, #7ac2e8, #5a87af)`;
    });

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
            const dx = mouse.x - this.x;
            const dy = mouse.y - this.y;
            const distance = Math.sqrt(dx*dx + dy*dy);
            if (distance < 80) {
                this.x -= dx/20;
                this.y -= dy/20;
            }
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
        for (let i = 0; i < 50; i++) particles.push(new Particle());
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animate);
    }

    init();
    animate();
</script>

<script>
    // Check kung may 'message' flashdata mula sa controller
    <?php if (session()->getFlashdata('message')) : ?>
        Swal.fire({
            title: 'Success!',
            text: "<?= session()->getFlashdata('message') ?>",
            icon: 'success',
            confirmButtonColor: '#0a5872',
            confirmButtonText: 'Great!'
        });
    <?php endif; ?>
</script>

</body>
</html>