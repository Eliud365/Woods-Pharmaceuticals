<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Woods Pharmaceuticals') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/build/assets/app-TeZODcw5.css">
    <style>
        :root {
            --navy: #1a3557;
            --navy2: #22436e;
            --accent: #4a90d9;
            --bg: #f0f4f9;
            --surface: #fff;
            --border: #dde3ec;
            --text: #1a2740;
            --muted: #64748b;
            --hint: #94a3b8;
            --sidebar: 240px;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body { background: #f0f4f9; font-family: 'Figtree', 'Segoe UI', Arial, sans-serif; color: var(--text); margin: 0; }
        .sidebar {
            width: var(--sidebar); min-width: var(--sidebar);
            background: var(--navy); display: flex; flex-direction: column;
            min-height: 100vh; position: fixed; top: 0; left: 0; z-index: 100;
        }
        .sb-brand { padding: 22px 18px 18px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sb-brand .pill {
            width: 34px; height: 34px; background: var(--accent); border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 16px; font-weight: 700; margin-bottom: 10px;
        }
        .sb-brand h2 { font-size: 14px; font-weight: 600; color: #fff; line-height: 1.35; margin: 0; }
        .sb-brand p { font-size: 10.5px; color: rgba(255,255,255,0.4); margin-top: 2px; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 0; }
        .sb-nav { padding: 10px 0; flex: 1; }
        .sb-lbl { font-size: 9.5px; text-transform: uppercase; letter-spacing: .08em; color: rgba(255,255,255,0.28); padding: 10px 18px 4px; }
        .sb-item {
            display: flex; align-items: center; gap: 9px; padding: 9px 18px;
            font-size: 13px; color: rgba(255,255,255,0.62); cursor: pointer;
            border-left: 2px solid transparent; transition: all .12s; text-decoration: none;
        }
        .sb-item:hover { background: rgba(255,255,255,0.06); color: #fff; border-left-color: rgba(255,255,255,0.2); }
        .sb-item.active { background: rgba(74,144,217,0.18); color: #fff; border-left-color: var(--accent); font-weight: 500; }
        .sb-item.logout { color: rgba(248,113,113,0.75); }
        .sb-divider { height: 1px; background: rgba(255,255,255,0.07); margin: 6px 0; }
        .sb-footer { padding: 14px 18px; border-top: 1px solid rgba(255,255,255,0.07); display: flex; align-items: center; gap: 8px; }
        .sb-avatar {
            width: 30px; height: 30px; border-radius: 50%; background: var(--accent);
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 600; flex-shrink: 0;
        }
        .sb-user p { font-size: 12px; font-weight: 500; color: rgba(255,255,255,0.85); margin: 0; }
        .sb-user span { font-size: 10.5px; color: rgba(255,255,255,0.38); }
        .main-area { margin-left: var(--sidebar); min-height: 100vh; display: flex; flex-direction: column; background: #f0f4f9; width: calc(100% - var(--sidebar)); }
        .topbar {
            background: #ffffff; height: 56px; padding: 0 24px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid #dde3ec; position: sticky; top: 0; z-index: 50;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .topbar h1 { font-size: 18px; font-weight: 600; color: #1a2740; margin: 0; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-right .date { font-size: 12px; color: #64748b; }
        .body-area { padding: 24px; flex: 1; background: #f0f4f9; width: 100%; }

        /* Force light theme on all content */
        .body-area .bg-white, .body-area [class*="bg-white"] { background-color: #ffffff !important; }
        .body-area [class*="dark:bg-gray-800"] { background-color: #ffffff !important; }
        .body-area [class*="dark:bg-gray-700"] { background-color: #f8fafc !important; }
        .body-area [class*="dark:border-gray-700"] { border-color: #dde3ec !important; }
        .body-area [class*="dark:text-gray-200"] { color: #1a2740 !important; }
        .body-area [class*="dark:text-gray-300"] { color: #374151 !important; }
        .body-area [class*="text-gray-800"] { color: #1a2740 !important; }
        .body-area [class*="text-gray-700"] { color: #374151 !important; }
        .body-area [class*="text-gray-500"] { color: #64748b !important; }
        .body-area .bg-gray-100, .body-area [class*="bg-gray-100"] { background-color: #f8fafc !important; }
        .body-area .bg-orange-50 { background-color: #fff7ed !important; }
        .body-area .bg-yellow-50 { background-color: #fefce8 !important; }
        .body-area .bg-red-50 { background-color: #fef2f2 !important; }
        .body-area table thead { background-color: #f8fafc !important; }
        .body-area table thead th { color: #64748b !important; }
        .body-area table tbody td { color: #374151 !important; border-color: #f1f5f9 !important; }
        .body-area .shadow-sm { box-shadow: 0 1px 3px rgba(0,0,0,0.06) !important; }
        .body-area .sm\:rounded-lg { border-radius: 10px !important; border: 1px solid #dde3ec !important; }
    </style>
</head>
<body>
    <div style="display:flex">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sb-brand">
                <div class="pill">W</div>
                <h2>Woods Pharmaceuticals</h2>
                <p>Management System</p>
            </div>
            <nav class="sb-nav">
                <div class="sb-lbl">Main</div>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="sb-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
                    <a href="{{ route('medicines.index') }}" class="sb-item {{ request()->routeIs('medicines.*') ? 'active' : '' }}">💊 Medicines</a>
                    <a href="{{ route('sales.index') }}" class="sb-item {{ request()->routeIs('sales.*') ? 'active' : '' }}">🛒 Sales</a>
                    <a href="{{ route('suppliers.index') }}" class="sb-item {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">🚚 Suppliers</a>
                    <a href="{{ route('purchases.index') }}" class="sb-item {{ request()->routeIs('purchases.*') ? 'active' : '' }}">📦 Purchases</a>
                    <a href="{{ route('reports.index') }}" class="sb-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">📊 Reports</a>
                    <a href="{{ route('users.index') }}" class="sb-item {{ request()->routeIs('users.*') ? 'active' : '' }}">👥 Users</a>
                @endif

                @if(auth()->user()->isPharmacist())
                    <a href="{{ route('pharmacist.dashboard') }}" class="sb-item {{ request()->routeIs('pharmacist.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
                    <a href="{{ route('medicines.index') }}" class="sb-item {{ request()->routeIs('medicines.*') ? 'active' : '' }}">💊 Medicines</a>
                    <a href="{{ route('purchases.index') }}" class="sb-item {{ request()->routeIs('purchases.*') ? 'active' : '' }}">📦 Purchases</a>
                @endif

                @if(auth()->user()->isCashier())
                    <a href="{{ route('cashier.dashboard') }}" class="sb-item {{ request()->routeIs('cashier.dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
                    <a href="{{ route('sales.create') }}" class="sb-item {{ request()->routeIs('sales.create') ? 'active' : '' }}">🛒 New Sale</a>
                    <a href="{{ route('sales.index') }}" class="sb-item {{ request()->routeIs('sales.index') ? 'active' : '' }}">📋 My Sales</a>
                @endif

                <div class="sb-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sb-item logout" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">🔓 Logout</button>
                </form>
            </nav>
            <div class="sb-footer">
                <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                <div class="sb-user">
                    <p>{{ auth()->user()->name }}</p>
                    <span>{{ ucfirst(auth()->user()->role) }}</span>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-area">
            <header class="topbar">
                <h1>{{ $header ?? ($slot->isEmpty() ? 'Dashboard' : '') }}</h1>
                <div class="topbar-right">
                    <span class="date">{{ now()->format('l, d F Y') }}</span>
                    <a href="{{ route('profile.edit') }}" style="font-size:12px;color:#64748b;text-decoration:none;">⚙️ Profile</a>
                </div>
            </header>
            <div class="body-area">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script src="/build/assets/app-DO2nEFzp.js" defer></script>
</body>
</html>