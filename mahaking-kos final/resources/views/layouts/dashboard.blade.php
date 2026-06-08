<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahaking Kos – @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --navy: #1a2035; --navy-light: #24305a;
            --gold: #C9A84C; --gold-light: #e0c06e; --gold-pale: #f5e9c8;
            --white: #ffffff; --gray: #8a8fa8; --gray-light: #e8e8ee;
            --red: #c0392b; --green: #27ae60;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
            --shadow-sm: 0 2px 8px rgba(26,32,53,.08);
            --shadow-md: 0 4px 20px rgba(26,32,53,.14);
            --shadow-lg: 0 8px 40px rgba(26,32,53,.18);
            --radius: 12px; --radius-sm: 8px;
        }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); background: #f0ece4; color: var(--navy); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; }
        button, input, select, textarea { font-family: var(--font-body); }

        /* ══ SHELL ══ */
        .shell { display: flex; min-height: 100vh; }

        /* ══ SIDEBAR ══ */
        .sidebar {
            width: 260px; flex-shrink: 0;
            background: var(--navy);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; height: 100vh;
            z-index: 100; transition: width .25s ease;
        }
        .sidebar.collapsed { width: 72px; }
        .sidebar.collapsed .sidebar-brand-text,
        .sidebar.collapsed .nav-label,
        .sidebar.collapsed .user-email,
        .sidebar.collapsed .logout-text { display: none; }
        .sidebar.collapsed .sidebar-nav a { justify-content: center; padding: 14px; }
        .sidebar.collapsed .sidebar-nav a i { margin: 0; }

        /* BRAND — Crown SVG selalu tampil */
        .sidebar-brand {
            display: flex; align-items: center; gap: 10px;
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(201,168,76,.15);
            min-height: 76px; overflow: hidden;
        }
        .crown-svg { width: 32px; height: 24px; flex-shrink: 0; }
        .sidebar-brand-text {
            font-family: var(--font-display); font-size: .95rem;
            font-weight: 700; color: var(--gold);
            white-space: nowrap; letter-spacing: .3px;
        }
        .hamburger {
            margin-left: auto; background: none; border: none;
            color: rgba(255,255,255,.4); font-size: 1rem;
            cursor: pointer; padding: 4px; flex-shrink: 0;
            transition: color .2s;
        }
        .hamburger:hover { color: var(--gold); }

        /* NAV */
        .sidebar-nav { flex: 1; padding: 14px 0; overflow-y: auto; overflow-x: hidden; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 20px;
            color: rgba(255,255,255,.58); font-size: .875rem; font-weight: 500;
            transition: all .2s; border-left: 3px solid transparent;
            white-space: nowrap; overflow: hidden;
        }
        .sidebar-nav a i { width: 18px; text-align: center; font-size: .9rem; flex-shrink: 0; }
        .sidebar-nav a:hover, .sidebar-nav a.active {
            color: var(--gold);
            background: rgba(201,168,76,.08);
            border-left-color: var(--gold);
        }

        /* FOOTER */
        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(201,168,76,.15);
        }
        .logout-link {
            display: flex; align-items: center; gap: 8px;
            color: var(--gold); font-size: .85rem; font-weight: 500;
            margin-bottom: 12px; cursor: pointer;
            background: none; border: none; width: 100%;
            padding: 0; transition: color .2s;
        }
        .logout-link:hover { color: var(--gold-light); }
        .user-row { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
        .user-email { color: rgba(255,255,255,.45); font-size: .76rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .avatar-icon { color: rgba(255,255,255,.4); font-size: 1.5rem; flex-shrink: 0; }

        /* ══ MAIN ══ */
        .main { margin-left: 260px; flex: 1; min-height: 100vh; background: var(--white); transition: margin-left .25s ease; }
        .main.expanded { margin-left: 72px; }
        .main-inner { padding: 44px 52px; max-width: 1020px; }
        .main-inner h2 { font-family: var(--font-display); font-size: 1.9rem; color: var(--navy); margin-bottom: 32px; font-weight: 700; }

        /* ══ TABLES ══ */
        .data-table { width: 100%; border-collapse: collapse; background: #fdf9f5; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm); }
        .data-table thead { background: #f0ece3; }
        .data-table th { padding: 13px 18px; text-align: left; font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .6px; color: var(--navy); }
        .data-table td { padding: 13px 18px; border-top: 1px solid var(--gray-light); font-size: .87rem; }
        .data-table tr:hover td { background: #fdf7ed; }

        /* ══ BUTTONS ══ */
        .btn { display: inline-flex; align-items: center; gap: 5px; padding: 7px 16px; border-radius: var(--radius-sm); font-size: .8rem; font-weight: 600; cursor: pointer; border: none; transition: all .2s; text-decoration: none; }
        .btn-sm { padding: 5px 12px; font-size: .78rem; }
        .btn-primary { background: var(--gold); color: var(--navy); }
        .btn-primary:hover { background: var(--gold-light); }
        .btn-danger { background: var(--red); color: #fff; }
        .btn-danger:hover { background: #a93226; }
        .btn-edit { background: var(--navy); color: #fff; }
        .btn-edit:hover { background: var(--navy-light); }
        .btn-add { background: none; border: 1.5px solid var(--gold); color: var(--gold); border-radius: var(--radius-sm); padding: 9px 20px; font-size: .875rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all .2s; margin-top: 20px; text-decoration: none; }
        .btn-add:hover { background: var(--gold); color: var(--navy); }

        /* ══ BADGE ══ */
        .badge { display: inline-block; padding: 3px 12px; border-radius: 50px; font-size: .73rem; font-weight: 700; }
        .badge-putri  { background: #fce4ec; color: #c2185b; }
        .badge-putra  { background: #e3f2fd; color: #1565c0; }
        .badge-campur { background: #f3e5f5; color: #7b1fa2; }
        .badge-green  { background: #e8f5e9; color: #2e7d32; }
        .badge-red    { background: #ffebee; color: #c62828; }
        .badge-tersedia { background: #e8f5e9; color: #2e7d32; }
        .badge-penuh { background: #ffebee; color: #c62828; }

        /* ══ FORMS ══ */
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: .85rem; font-weight: 600; color: var(--navy); margin-bottom: 7px; }
        .form-control { width: 100%; padding: 11px 14px; border: 1.5px solid var(--gray-light); border-radius: var(--radius-sm); font-size: .9rem; background: #faf8f5; color: var(--navy); outline: none; transition: border-color .2s, box-shadow .2s; }
        .form-control:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.12); background: var(--white); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* ══ WISHLIST ══ */
        .wishlist-item { display: flex; align-items: center; gap: 20px; background: #fdf9f5; border: 1.5px solid var(--gray-light); border-radius: var(--radius); padding: 16px; margin-bottom: 16px; transition: box-shadow .2s; }
        .wishlist-item:hover { box-shadow: var(--shadow-sm); }
        .wishlist-thumb { width: 100px; height: 72px; border-radius: var(--radius-sm); overflow: hidden; background: var(--gray-light); flex-shrink: 0; }
        .wishlist-heart { color: var(--gray); font-size: 1.2rem; cursor: pointer; flex-shrink: 0; }
        .wishlist-heart.active { color: #e74c3c; }
        .wishlist-info { flex: 1; min-width: 0; }
        .wishlist-name { font-family: var(--font-display); font-size: 1rem; font-weight: 600; color: var(--navy); margin-bottom: 4px; }
        .wishlist-loc { font-size: .82rem; color: var(--gray); margin-bottom: 4px; }
        .wishlist-price { font-size: .9rem; font-weight: 600; color: var(--navy); }
        .wishlist-actions { display: flex; gap: 8px; flex-shrink: 0; }

        /* ══ ALERTS ══ */
        .alert-success { background:#e8f5e9;color:#2e7d32;border-radius:var(--radius-sm);padding:10px 16px;margin-bottom:20px;font-size:.88rem; }
        .alert-error { background:#ffebee;color:#c62828;border-radius:var(--radius-sm);padding:10px 16px;margin-bottom:20px;font-size:.88rem; }

        @keyframes fadeUp { from { opacity:0; transform:translateY(18px); } to { opacity:1; transform:translateY(0); } }
        .fade-up { animation: fadeUp .45s ease both; }
    </style>
    @stack('styles')
</head>
<body>
<div class="shell">

    {{-- ════════════ SIDEBAR ════════════ --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            {{-- Crown SVG — selalu tampil, tidak hilang --}}
            <svg class="crown-svg" viewBox="0 0 40 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 26h36" stroke="#C9A84C" stroke-width="2.2" stroke-linecap="round"/>
                <path d="M4 26L7 10L14 17L20 4L26 17L33 10L36 26"
                      stroke="#C9A84C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="4"  cy="9" r="2.5" fill="#C9A84C"/>
                <circle cx="20" cy="3" r="2.5" fill="#C9A84C"/>
                <circle cx="36" cy="9" r="2.5" fill="#C9A84C"/>
            </svg>
            <span class="sidebar-brand-text">MAHAKING KOS</span>
            <button class="hamburger" id="hamburger" title="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            @yield('sidebar_nav')
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-link">
                    <i class="fas fa-right-from-bracket" style="flex-shrink:0;"></i>
                    <span class="logout-text">Keluar Akun</span>
                </button>
            </form>
            <div class="user-row">
                <span class="user-email">{{ auth()->user()->email ?? '@user.id' }}</span>
                <i class="fas fa-circle-user avatar-icon"></i>
            </div>
        </div>
    </aside>

    {{-- ════════════ MAIN ════════════ --}}
    <main class="main" id="mainContent">
        <div class="main-inner fade-up">
            @if(session('success'))
                <div class="alert-success">✓ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">✕ {{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </main>

</div>

@stack('scripts')
<script>
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    document.getElementById('hamburger').addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    });
</script>
</body>
</html>