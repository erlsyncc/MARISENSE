<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Cancellation Notice</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1f2937;">
    <p>Hi <?= esc($username ?? 'Guest') ?>,</p>

    <p>
        Your booking <strong><?= esc($bookingCode ?? 'N/A') ?></strong> scheduled for
        <strong><?= esc($scheduledAt ?? 'N/A') ?></strong> has been automatically cancelled due to
        <strong>Unsafe Maritime Conditions</strong>.
    </p>

    <p>
        For your safety, activities are temporarily paused while hazardous conditions persist.
        Refunds or rescheduling options will be processed, and our team will follow up with you.
    </p>

    <p>Thank you for your understanding.</p>
    <p><strong>Waves Water Sports Team</strong></p>
</body>
</html>
