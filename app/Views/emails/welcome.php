<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to <?= esc(setting('App.siteName')) ?></title>
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
            background-color: #438eb9; 
            color: white !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
            border-bottom: 2px solid #2679b5;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
        .feature-list {
            padding-left: 20px;
        }
        .feature-list li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-weight: 300;">Welcome to <?= esc(setting('App.siteName')) ?>!</h1>
    </div>

    <div class="content">
        <h2 style="color: #438eb9; margin-top: 0;">Hi <?= esc($user->first_name ?? $user->username) ?>,</h2>

        <p>Welcome aboard! Your account has been successfully created. We are excited to have you on <?= esc(setting('App.siteName')) ?>, your new self-hosted project and productivity tracker.</p>

        <p>Here are a few things you can do to get started:</p>
        
        <ul class="feature-list">
            <li><strong>Create a Project:</strong> Start organizing your work immediately.</li>
            <li><strong>Kanban Boards:</strong> Track tasks visually across different stages.</li>
            <li><strong>Time Tracking:</strong> Log hours spent on tasks to measure productivity.</li>
        </ul>

        <div style="text-align: center;">
            <a href="<?= site_url('home') ?>" class="button">Go to Dashboard</a>
        </div>

        <p>If you have any questions or need help setting up, simply reply to this email or check our documentation.</p>

        <div class="footer">
            <p>Happy shipping!<br><strong>The <?= esc(setting('App.siteName')) ?> Team</strong></p>
        </div>
    </div>
</body>
</html>
