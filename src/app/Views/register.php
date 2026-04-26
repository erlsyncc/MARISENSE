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
            min-height: 100vh;
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
            width: 980px;
            max-height: 95vh;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(5, 44, 57, 0.2);
            animation: fadeInUp 0.8s ease-out forwards;
            z-index: 10;
        }
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
        .register-form-area {
            flex: 1.2;
            padding: 36px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }
        .form-group-custom { margin-bottom: 14px; }
        .form-label {
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--ocean-blue);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 3px;
            display: block;
        }
        .label-hint {
            font-size: 0.68rem;
            color: #888;
            font-weight: 400;
            letter-spacing: 0;
            text-transform: none;
            margin-left: 4px;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #e9ecef;
            border-radius: 0;
            padding: 8px 0;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            background: transparent;
            width: 100%;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: var(--accent-cyan);
            outline: none;
        }
        /* Password strength bar */
        .password-strength-bar {
            height: 4px;
            border-radius: 4px;
            margin-top: 6px;
            transition: all 0.4s ease;
            width: 0%;
            background: #ccc;
        }
        .strength-weak    { width: 33%; background: #e74c3c; }
        .strength-medium  { width: 66%; background: #f39c12; }
        .strength-strong  { width: 100%; background: #27ae60; }
        .password-strength-label {
            font-size: 0.68rem;
            margin-top: 3px;
            font-weight: 600;
        }
        .strength-text-weak   { color: #e74c3c; }
        .strength-text-medium { color: #f39c12; }
        .strength-text-strong { color: #27ae60; }

        /* Password requirements checklist */
        .pw-requirements {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 10px 14px;
            margin-top: 8px;
            font-size: 0.72rem;
        }
        .pw-req-item {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #aaa;
            margin-bottom: 3px;
            transition: color 0.3s;
        }
        .pw-req-item:last-child { margin-bottom: 0; }
        .pw-req-item.met { color: #27ae60; }
        .pw-req-item i { font-size: 0.65rem; }

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
            width: 100%;
        }
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0, 119, 182, 0.3);
            color: white;
        }
        .login-link {
            font-size: 0.85rem;
            margin-top: 16px;
            color: #6c757d;
            text-align: center;
        }
        .login-link a {
            color: var(--accent-cyan);
            text-decoration: none;
            font-weight: 700;
        }
        .login-link a:hover { color: #0077b6; text-decoration: underline; }
        @media (max-width: 768px) {
            .register-container { width: 95%; flex-direction: column; max-height: none; }
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
        <p class="text-muted small mb-3">Sign up to start booking your activities. We'll send you a verification email.</p>

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
                <label class="form-label">
                    Username
                    <span class="label-hint">— Your unique display name</span>
                </label>
                <input type="text" name="username" class="form-control"
                       value="<?= old('username') ?>"
                       placeholder="e.g. wave_rider_2026" required minlength="3">
            </div>

            <div class="form-group-custom">
                <label class="form-label">
                    Email Address
                    <span class="label-hint">— Used for login &amp; notifications</span>
                </label>
                <input type="email" name="email" class="form-control"
                       value="<?= old('email') ?>"
                       placeholder="name@example.com" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label">
                            Password
                            <span class="label-hint">— Min. 8 characters</span>
                        </label>
                        <input type="password" name="password" id="passwordField"
                               class="form-control"
                               placeholder="••••••••" required minlength="8"
                               oninput="checkPasswordStrength(this.value)">
                        <div class="password-strength-bar" id="strengthBar"></div>
                        <div class="password-strength-label" id="strengthLabel"></div>
                        <div class="pw-requirements" id="pwRequirements">
                            <div class="pw-req-item" id="req-len">
                                <i class="fa-solid fa-circle-xmark"></i> At least 8 characters
                            </div>
                            <div class="pw-req-item" id="req-upper">
                                <i class="fa-solid fa-circle-xmark"></i> One uppercase letter
                            </div>
                            <div class="pw-req-item" id="req-num">
                                <i class="fa-solid fa-circle-xmark"></i> One number
                            </div>
                            <div class="pw-req-item" id="req-special">
                                <i class="fa-solid fa-circle-xmark"></i> One special character (!@#$…)
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label">
                            Confirm Password
                            <span class="label-hint">— Re-type to verify</span>
                        </label>
                        <input type="password" name="password_confirm" id="confirmField"
                               class="form-control"
                               placeholder="••••••••" required
                               oninput="checkConfirmMatch()">
                        <div class="password-strength-label" id="matchLabel"></div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-register">Create My Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="<?= url_to('login') ?>">Login Here</a>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script>
    document.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth) * 100;
        const y = (e.clientY / window.innerHeight) * 100;
        document.body.style.background = `radial-gradient(circle at ${x}% ${y}%, #7ac2e8, #5a87af)`;
    });

    function checkPasswordStrength(val) {
        const bar   = document.getElementById('strengthBar');
        const label = document.getElementById('strengthLabel');

        const hasLen     = val.length >= 8;
        const hasUpper   = /[A-Z]/.test(val);
        const hasNum     = /[0-9]/.test(val);
        const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val);

        // Update requirement indicators
        setReq('req-len',     hasLen);
        setReq('req-upper',   hasUpper);
        setReq('req-num',     hasNum);
        setReq('req-special', hasSpecial);

        const score = [hasLen, hasUpper, hasNum, hasSpecial].filter(Boolean).length;

        bar.className = 'password-strength-bar';
        label.className = 'password-strength-label';

        if (val.length === 0) {
            bar.style.width = '0';
            label.textContent = '';
        } else if (score <= 1) {
            bar.classList.add('strength-weak');
            label.classList.add('strength-text-weak');
            label.textContent = '⚠ Weak password';
        } else if (score === 2 || score === 3) {
            bar.classList.add('strength-medium');
            label.classList.add('strength-text-medium');
            label.textContent = '~ Medium strength';
        } else {
            bar.classList.add('strength-strong');
            label.classList.add('strength-text-strong');
            label.textContent = '✔ Strong password';
        }

        checkConfirmMatch();
    }

    function setReq(id, met) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.toggle('met', met);
        el.querySelector('i').className = met
            ? 'fa-solid fa-circle-check'
            : 'fa-solid fa-circle-xmark';
    }

    function checkConfirmMatch() {
        const pw  = document.getElementById('passwordField').value;
        const con = document.getElementById('confirmField').value;
        const lbl = document.getElementById('matchLabel');
        if (con.length === 0) { lbl.textContent = ''; return; }
        if (pw === con) {
            lbl.className = 'password-strength-label strength-text-strong';
            lbl.textContent = '✔ Passwords match';
        } else {
            lbl.className = 'password-strength-label strength-text-weak';
            lbl.textContent = '✖ Passwords do not match';
        }
    }

    // Bubble Particles
    const canvas = document.getElementById('particleCanvas');
    const ctx = canvas.getContext('2d');
    const zone = document.getElementById('interactiveZone');
    let particles = [];

    function resize() { canvas.width = zone.offsetWidth; canvas.height = zone.offsetHeight; }
    window.addEventListener('resize', resize);
    resize();

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
            ctx.fillStyle = `rgba(255,255,255,${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    function init() { particles = []; for (let i = 0; i < 40; i++) particles.push(new Particle()); }
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animate);
    }
    init(); animate();
</script>
</body>
</html>