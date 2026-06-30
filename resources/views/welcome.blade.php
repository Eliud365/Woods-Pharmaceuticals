<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Woods Pharmaceuticals</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Figtree', 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #1a3557 0%, #22436e 50%, #1a3557 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            padding: 40px;
            width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            text-align: center;
        }
        .mark {
            width: 56px; height: 56px;
            background: #1a3557;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        h1 { font-size: 20px; font-weight: 700; color: #1a3557; margin-bottom: 6px; }
        .sub { font-size: 13px; color: #64748b; margin-bottom: 4px; }
        .location { font-size: 12px; color: #94a3b8; margin-bottom: 28px; }
        .divider { height: 1px; background: #dde3ec; margin-bottom: 24px; }
        .desc { font-size: 13px; color: #64748b; margin-bottom: 20px; }
        .btn {
            display: block;
            background: #1a3557;
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background .15s;
        }
        .btn:hover { background: #22436e; }
        .footer { font-size: 11px; color: #94a3b8; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="mark">W</div>
        <h1>Woods Pharmaceuticals</h1>
        <p class="sub">Pharmacy Management System</p>
        <p class="location">📍 Nairobi, Kenya</p>
        <div class="divider"></div>
        <p class="desc">Please log in to access the system dashboard.</p>
        <a href="/login" class="btn">Sign In</a>
        <p class="footer">© {{ date('Y') }} Woods Pharmaceuticals. All rights reserved.</p>
    </div>
</body>
</html>