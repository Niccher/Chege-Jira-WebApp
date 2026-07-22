<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page Not Found</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Space Grotesk', sans-serif; border-radius: 0 !important; }
        body {
            background: #0a0a0a; color: #f3f4f6;
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 2rem;
            background-image: linear-gradient(#262626 1px, transparent 1px),
                              linear-gradient(90deg, #262626 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .error-box { max-width: 500px; width: 100%; text-align: center; }
        .error-code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 7rem; font-weight: 700; line-height: 1;
            color: #6b7280; margin-bottom: 1rem;
        }
        .error-box h1 { font-weight: 700; margin-bottom: 0.75rem; }
        .error-box p { color: #9ca3af; margin-bottom: 2rem; line-height: 1.7; }
        .btn-error {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 2rem; background: #ef4444; color: #000;
            font-weight: 700; text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace; font-size: 0.85rem;
            text-decoration: none; border: 2px solid #ef4444;
            transition: all 0.2s ease;
        }
        .btn-error:hover {
            background: transparent; color: #ef4444;
            box-shadow: 4px 4px 0 #ef4444; transform: translate(-2px, -2px);
        }
        .search-box {
            display: flex; gap: 0.5rem; margin-top: 1.5rem;
            justify-content: center;
        }
        .search-box input {
            background: rgba(255,255,255,0.05);
            border: 1px solid #262626; color: #f3f4f6;
            padding: 0.6rem 1rem; font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem; flex: 1; max-width: 300px;
        }
        .search-box input:focus {
            outline: none; border-color: #ef4444;
        }
        .search-box button {
            background: #ef4444; color: #000; border: none;
            padding: 0.6rem 1rem; font-family: 'JetBrains Mono', monospace;
            font-weight: 700; cursor: pointer;
        }
        .error-detail {
            margin-top: 2rem; padding-top: 1.5rem;
            border-top: 1px dashed #262626;
            font-family: 'JetBrains Mono', monospace; font-size: 0.8rem;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <div class="error-code">404</div>
        <h1>Page Not Found</h1>
        <p>The page you are looking for does not exist or has been moved. Check the URL or navigate back.</p>
        <a href="/" class="btn-error"><i class="fas fa-arrow-left"></i> Back to Home</a>
        <div class="error-detail">
            <?php if (ENVIRONMENT !== 'production' && isset($message) && $message): ?>
                <?= nl2br(esc($message)) ?>
            <?php else: ?>
                The requested URL was not found on this server.
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
