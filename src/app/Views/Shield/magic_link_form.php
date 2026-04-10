<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --deep-blue: #052c39;
            --ocean-blue: #0a5872;
            --accent-cyan: #48cae4;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: radial-gradient(circle at center, #7ac2e8, #5a87af);
            margin: 0;
            overflow: hidden;
        }

        .reset-container {
            width: 450px;
            background: white;
            padding: 40px 50px;
            border-radius: 30px;
            box-shadow: 0 25px 50px rgba(5, 44, 57, 0.15);
            text-align: center;
            z-index: 10;
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
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--accent-cyan);
            background: transparent;
        }

        .btn-reset {
            background: linear-gradient(45deg, var(--accent-cyan), #0077b6);
            border: none;
            border-radius: 50px;
            padding: 14px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0, 119, 182, 0.2);
        }

        .btn-reset:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(0, 119, 182, 0.3);
            color: white;
        }

        .back-link a {
            text-decoration: none;
            color: #adb5bd;
            font-size: 0.85rem;
            transition: 0.3s;
            font-weight: 600;
        }

        .back-link a:hover { color: var(--ocean-blue); }
    </style>
</head>
<body>

<div class="reset-container">
    <h3 class="fw-bold mb-1">Magic Link</h3>
    <p class="text-muted small mb-4">Enter your email and we'll send a link to log you in instantly.</p>

    <?php if (session('error')) : ?>
        <div class="alert alert-danger small py-2"><?= session('error') ?></div>
    <?php elseif (session('message')) : ?>
        <div class="alert alert-success small py-2"><?= session('message') ?></div>
    <?php endif ?>

    <form action="<?= url_to('magic-link') ?>" method="post">
        <?= csrf_field() ?>
        <div class="text-start">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="example@mail.com" value="<?= old('email', auth()->user()->email ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-reset">Send Magic Link</button>
    </form>

    <div class="back-link mt-4">
        <a href="<?= base_url('login') ?>">← Back to Login</a>
    </div>
</div>

<script>
    // Mouse movement effect para tumugma sa Login page
    document.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth) * 100;
        const y = (e.clientY / window.innerHeight) * 100;
        document.body.style.background = `radial-gradient(circle at ${x}% ${y}%, #7ac2e8, #5a87af)`;
    });
</script>

</body>
</html>