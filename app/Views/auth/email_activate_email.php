<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activate Your Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .button {
            display: inline-block;
            background-color: #4F46E5;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #6c757d;
        }
        .code {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 18px;
            text-align: center;
            margin: 20px 0;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Chege OS</h1>
        <p>Welcome to your project management platform!</p>
    </div>

    <div class="content">
        <h2>Hello <?= esc($user->first_name ?? $user->username) ?>!</h2>

        <p>Thank you for registering with Chege OS. To complete your account setup and start managing your projects, please verify your email address.</p>

        <div style="text-align: center;">
            <a href="<?= site_url('auth/verify-email?token=' . $code . '&email=' . urlencode($user->email)) ?>" class="button">Activate My Account</a>
        </div>

        <p>If the button doesn't work, you can copy and paste this link into your browser:</p>
        <p><a href="<?= site_url('auth/verify-email?token=' . $code . '&email=' . urlencode($user->email)) ?>"><?= site_url('auth/verify-email?token=' . $code . '&email=' . urlencode($user->email)) ?></a></p>

        <div class="code">
            Verification Code: <strong><?= $code ?></strong>
        </div>

        <p><strong>Important:</strong> This verification link will expire in 24 hours for security reasons.</p>

        <p>If you did not create this account, please ignore this email.</p>

        <div class="footer">
            <p>Best regards,<br>The Chege OS Team</p>
            <p>This email was sent from <?= $ipAddress ?> on <?= date('F j, Y \a\t g:i A', strtotime($date)) ?></p>
        </div>
    </div>
</body>
</html>
