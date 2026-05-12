<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Waves Water Sports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        min-height: 100vh;
        background: radial-gradient(circle at center, #7ac2e8, #5a87af);
        overflow-y: auto;
        padding: 20px;
        transition: background 0.1s ease;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .forgot-container {
        display: flex;
        width: 900px;
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(5, 44, 57, 0.15);
        animation: fadeInUp 1s ease-out forwards;
        z-index: 10;
    }

    .visual-side {
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

    .visual-side h2 {
        font-weight: 700;
        font-size: 3.5rem;
        z-index: 2;
        letter-spacing: 2px;
        margin-bottom: 5px;
        line-height: 1;
    }

    .visual-side p {
        font-weight: 300;
        opacity: 0.9;
        z-index: 2;
        font-size: 0.9rem;
    }

    .form-area {
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

    .btn-submit {
        background: linear-gradient(45deg, var(--accent-cyan), #0077b6);
        border: none;
        border-radius: 50px;
        padding: 14px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0, 119, 182, 0.2);
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(0, 119, 182, 0.3);
        color: white;
    }

    .back-link {
        margin-top: 25px;
        text-align: center;
    }

    .back-link a {
        text-decoration: none;
        color: #adb5bd;
        font-size: 0.85rem;
        transition: 0.3s;
    }

    .back-link a:hover {
        color: var(--ocean-blue);
    }

    .info-text {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 25px;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .forgot-container {
            width: 95%;
            flex-direction: column;
        }
        .visual-side {
            min-height: 300px;
        }
        .form-area {
            padding: 40px 30px;
        }
    }
</style>
</head>
<body>

<div class="forgot-container">
    <div class="visual-side" id="interactiveZone">
        <canvas id="particleCanvas"></canvas>
        <h2>RESET</h2>
        <p>Get back to your account securely.</p>
    </div>

    <div class="form-area">
        <h3 class="fw-bold mb-1">Forgot Your Password?</h3>
        <p class="info-text">
            No worries! Enter your email address and we'll send you a link to reset your password.
        </p>

        <?php if($session->getFlashdata('error')): ?>
            <div class="small fw-bold mb-3" style="color: #ff4d4d; border-left: 3px solid #ff4d4d; padding-left: 10px;">
                <?= $session->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if($session->getFlashdata('message')): ?>
            <div class="small fw-bold mb-3" style="color: #28a745; border-left: 3px solid #28a745; padding-left: 10px;">
                ✓ <?= $session->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="/auth/send-magic-link">
            <div class="form-group-custom">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com" required autofocus>
            </div>

            <button type="submit" class="btn btn-submit w-100">Send Reset Link</button>
        </form>

        <div class="back-link">
            <a href="/login">← Back to Login</a>
        </div>
    </div>
</div>

<script>
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

</body>
</html>
