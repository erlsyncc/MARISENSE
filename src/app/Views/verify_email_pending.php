<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email | Waves Water Sports</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap5/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --deep-blue: #052c39;
            --ocean-blue: #0a5872;
            --accent-cyan: #48cae4;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--ocean-blue), var(--deep-blue));
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .verify-card {
            background: white;
            border-radius: 20px;
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(5, 44, 57, 0.2);
            text-align: center;
        }
        .verify-icon {
            font-size: 3.5rem;
            color: var(--accent-cyan);
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .verify-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--deep-blue);
            margin-bottom: 12px;
        }
        .verify-subtitle {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 8px;
            line-height: 1.6;
        }
        .email-display {
            background: rgba(72, 202, 228, 0.1);
            border: 1px solid rgba(72, 202, 228, 0.3);
            border-radius: 10px;
            padding: 12px;
            margin: 24px 0;
            font-weight: 600;
            color: var(--accent-cyan);
            word-break: break-all;
        }
        .alert {
            margin: 20px 0;
            border-radius: 10px;
        }
        .btn-primary {
            background: linear-gradient(45deg, var(--accent-cyan), #0077b6);
            border: none;
            border-radius: 50px;
            padding: 12px 32px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 119, 182, 0.3);
        }
        .btn-secondary-text {
            background: none;
            border: none;
            color: var(--accent-cyan);
            cursor: pointer;
            text-decoration: underline;
            font-weight: 600;
            padding: 0;
            margin-top: 16px;
        }
        .btn-secondary-text:hover {
            color: #0077b6;
        }
        .resend-form {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e9ecef;
        }
        .resend-form input {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.9rem;
            width: 100%;
            margin-bottom: 10px;
        }
        .resend-form input:focus {
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 3px rgba(72, 202, 228, 0.1);
            outline: none;
        }
        .small-text {
            font-size: 0.82rem;
            color: #999;
            margin-top: 12px;
        }
        .back-link {
            margin-top: 20px;
        }
        .back-link a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-link a:hover {
            color: var(--accent-cyan);
        }
    </style>
</head>
<body>

<div class="verify-card">
    <div class="verify-icon">
        <i class="fa-solid fa-envelope"></i>
    </div>
    
    <h2 class="verify-title">Check Your Email</h2>
    <p class="verify-subtitle">We've sent a verification link to:</p>
    
    <div class="email-display">
        <?= esc($email ?? 'your email') ?>
    </div>

    <?php if (session('message')): ?>
        <div class="alert alert-success" role="alert">
            <?= session('message') ?>
        </div>
    <?php endif; ?>

    <?php if (session('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <p class="verify-subtitle">
        Click the link in the email to verify your account. The link expires in 24 hours.
    </p>

    <div class="small-text">
        <i class="fa-solid fa-info-circle"></i> 
        Didn't receive the email? Check your spam folder.
    </div>

    <div class="resend-form">
        <p class="small-text">Need to resend the verification email?</p>
        <form action="<?= base_url('auth/resend-verification') ?>" method="post" style="display: none;" id="resendForm">
            <?= csrf_field() ?>
            <input type="email" name="email" value="<?= esc($email) ?>" required style="display: none;">
        </form>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('resendForm').submit()">
            <i class="fa-solid fa-redo-alt me-2"></i> Resend Verification Email
        </button>
    </div>

    <div class="back-link">
        <a href="<?= base_url('login') ?>">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
        </a>
    </div>
</div>

</body>
</html>
