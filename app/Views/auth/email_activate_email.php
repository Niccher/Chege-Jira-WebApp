<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Your Account</title>
    <style>
        body {
            font-family: 'Open Sans', Arial, sans-serif;
            line-height: 1.6;
            color: #393939;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f7fa;
        }
        .header {
            background-color: #438eb9; /* Ace Primary Blue */
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 4px 4px 0 0;
            border-bottom: 3px solid #2679b5;
        }
        .content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 0 0 4px 4px;
            border: 1px solid #d5e4f1;
            border-top: none;
        }
        .button {
            display: inline-block;
            background-color: #87b87f; /* Ace Success Green */
            color: white !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            border-bottom: 2px solid #629b58;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
        .code {
            background-color: #f4f9fc;
            padding: 15px;
            border: 1px dashed #438eb9;
            border-radius: 4px;
            font-family: monospace;
            font-size: 18px;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 2px;
            color: #2679b5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-weight: 300;">Chege OS</h1>
        <p style="margin: 5px 0 0 0; opacity: 0.9;">Project & Productivity Tracker</p>
    </div>

    <div class="content">
        <h2 style="color: #438eb9; margin-top: 0;">Hello <?= esc($user->first_name ?? $user->username) ?>!</h2>

        <p>Thank you for registering with Chege OS. To complete your account setup and access your dashboard, please verify your email address.</p>

        <div style="text-align: center;">
            <a href="<?= site_url('auth/verify-email?token=' . $code . '&email=' . urlencode($user->email)) ?>" class="button">Activate My Account</a>
        </div>

        <p>If the button doesn't work, you can copy and paste this link into your browser:</p>
        <p style="word-break: break-all;"><a href="<?= site_url('auth/verify-email?token=' . $code . '&email=' . urlencode($user->email)) ?>" style="color: #438eb9;"><?= site_url('auth/verify-email?token=' . $code . '&email=' . urlencode($user->email)) ?></a></p>

        <div class="code">
            Verification Code: <strong><?= $code ?></strong>
        </div>

        <p><strong>Important:</strong> This verification link will expire in 24 hours for security reasons.</p>

        <p style="font-size: 13px; color: #777;">If you did not create this account, please ignore this email.</p>

        <div class="footer">
            <p>Best regards,<br><strong>The Chege OS Team</strong></p>
            <p>This email was sent from <?= $ipAddress ?> on <?= date('F j, Y \a\t g:i A', strtotime($date)) ?></p>
        </div>
    </div>
</body>
</html>
