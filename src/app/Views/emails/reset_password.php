<div style="font-family:Arial,Helvetica,sans-serif;line-height:1.6;color:#163447;max-width:600px;">
    <div style="background:#0a5872;color:white;padding:20px;border-radius:8px 8px 0 0;text-align:center;">
        <h2 style="margin:0;font-size:28px;font-weight:700;">Password Reset Request</h2>
    </div>

    <div style="background:#f8fbfd;padding:30px;border-radius:0 0 8px 8px;border:1px solid #dbe7ef;border-top:none;">
        <p style="margin:0 0 16px;">Hi <?= esc($username) ?>,</p>
        
        <p style="margin:0 0 16px;">
            We received a request to reset your password for your Waves Water Sports account. 
            Click the button below to create a new password.
        </p>

        <div style="text-align:center;margin:24px 0;">
            <a href="<?= esc($resetLink) ?>" style="display:inline-block;background:#48cae4;color:white;padding:12px 30px;text-decoration:none;border-radius:25px;font-weight:600;transition:background 0.3s;">
                Reset Password
            </a>
        </div>

        <p style="margin:0 0 16px;font-size:13px;color:#666;">
            Or copy and paste this link in your browser:
        </p>
        <p style="margin:0 0 16px;font-size:12px;color:#0a5872;word-break:break-all;">
            <?= esc($resetLink) ?>
        </p>

        <hr style="border:none;border-top:1px solid #dbe7ef;margin:20px 0;">

        <p style="margin:0 0 8px;font-size:13px;color:#666;">
            <strong>⏰ This link expires in 1 hour</strong>
        </p>

        <p style="margin:0 0 8px;font-size:13px;color:#666;">
            If you didn't request a password reset, you can safely ignore this email. 
            Your account is secure as long as your current password is not shared.
        </p>

        <hr style="border:none;border-top:1px solid #dbe7ef;margin:20px 0;">

        <p style="margin:0;font-size:12px;color:#999;">
            Best regards,<br>
            <strong>Waves Water Sports</strong>
        </p>
    </div>
</div>
