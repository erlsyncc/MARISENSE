<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(135deg, #0a5872, #052c39);
            padding: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #0a5872, #052c39);
            color: white;
            padding: 32px 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .header p {
            margin: 8px 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        .content {
            padding: 32px 24px;
            background: white;
        }
        .greeting {
            margin-bottom: 24px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #052c39;
        }
        .message {
            margin-bottom: 28px;
            line-height: 1.8;
            color: #555;
        }
        .verify-button-wrapper {
            text-align: center;
            margin: 32px 0;
        }
        .verify-button {
            display: inline-block;
            background: linear-gradient(45deg, #48cae4, #0077b6);
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 12px rgba(0, 119, 182, 0.2);
        }
        .verify-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 119, 182, 0.3);
        }
        .link-text {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-size: 0.85rem;
            color: #999;
            word-break: break-all;
        }
        .link-text strong {
            color: #555;
        }
        .footer {
            background: #f8f9fa;
            padding: 24px;
            text-align: center;
            color: #999;
            font-size: 0.85rem;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 8px 0;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 16px;
            margin: 24px 0;
            border-radius: 4px;
            font-size: 0.9rem;
            color: #856404;
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="header">
        <h1><i style="font-size: 1.8rem;">🌊</i> Waves</h1>
        <p>Water Sports Adventures</p>
    </div>

    <div class="content">
        <div class="greeting">
            Hi <?= esc($username) ?>,
        </div>

        <div class="message">
            Welcome to Waves Water Sports! We're excited to have you join our community. 
            To get started, please verify your email address by clicking the button below:
        </div>

        <div class="verify-button-wrapper">
            <a href="<?= $verifyLink ?>" class="verify-button">
                Verify Email Address
            </a>
        </div>

        <div class="link-text">
            Or copy and paste this link in your browser:<br>
            <strong><?= $verifyLink ?></strong>
        </div>

        <div class="warning">
            <strong>⏱️ This link expires in 24 hours.</strong> If you don't verify within this time, 
            you'll need to request a new verification email.
        </div>

        <div class="message">
            If you didn't create this account, please ignore this email.
        </div>
    </div>

    <div class="footer">
        <p>© <?= date('Y') ?> Waves Water Sports. All rights reserved.</p>
        <p>If you have questions, contact us at support@marisense.local</p>
    </div>
</div>

</body>
</html>
