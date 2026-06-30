<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login – Woods Pharmaceuticals</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/app-TeZODcw5.css">
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
        .login-box {
            background: #fff;
            border-radius: 14px;
            padding: 36px 40px;
            width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 24px;
        }
        .login-logo .mark {
            width: 50px; height: 50px;
            background: #1a3557;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .login-logo h2 { font-size: 16px; font-weight: 700; color: #1a3557; margin: 0; }
        .login-logo p { font-size: 11.5px; color: #64748b; margin-top: 3px; }
        .divider { height: 1px; background: #dde3ec; margin: 18px 0; }
        .login-title { font-size: 20px; font-weight: 700; color: #1a2740; margin-bottom: 4px; }
        .login-sub { font-size: 13px; color: #64748b; margin-bottom: 20px; }
        .field { margin-bottom: 14px; }
        .field label { display: block; font-size: 12px; font-weight: 600; color: #1a2740; margin-bottom: 5px; }
        .field input {
            width: 100%; padding: 10px 14px;
            border: 1.5px solid #dde3ec;
            border-radius: 8px;
            font-size: 13.5px;
            outline: none;
            font-family: inherit;
            color: #1a2740;
            transition: border-color .15s;
        }
        .field input:focus { border-color: #4a90d9; }
        .remember {
            display: flex; align-items: center; gap: 6px;
            font-size: 12.5px; color: #64748b; margin-bottom: 16px;
        }
        .remember input { width: 14px; height: 14px; }
        .login-btn {
            width: 100%; padding: 11px;
            background: #1a3557; color: #fff;
            border: none; border-radius: 8px;
            font-size: 14px; font-weight: 600;
            cursor: pointer; font-family: inherit;
            transition: background .15s;
        }
        .login-btn:hover { background: #22436e; }
        .login-footer {
            text-align: center; font-size: 12px;
            color: #94a3b8; margin-top: 16px;
        }
        .error-msg {
            background: #fee2e2; border: 1px solid #fecaca;
            color: #b91c1c; padding: 10px 14px;
            border-radius: 8px; font-size: 12.5px; margin-bottom: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-logo">
            <div class="mark">W</div>
            <h2>Woods Pharmaceuticals</h2>
            <p>Inventory &amp; Sales Management System</p>
        </div>
        <div class="divider"></div>
        <p class="login-title">Welcome back</p>
        <p class="login-sub">Sign in to access your dashboard</p>

        @if($errors->any())
            <div class="error-msg">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
            </div>
            <div class="field">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <div class="remember">
                <input type="checkbox" name="remember"> Remember me on this device
            </div>
            <button type="submit" class="login-btn">Sign In</button>
        </form>

        <p class="login-footer">© {{ date('Y') }} Woods Pharmaceuticals · All rights reserved</p>
    </div>
</body>
</html>