<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahaking Kos – @yield('title', 'Temukan Kos Premium')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:      #1a2035;
            --navy-light:#24305a;
            --gold:      #C9A84C;
            --gold-light:#e0c06e;
            --gold-pale: #f5e9c8;
            --cream:     #F5F0E8;
            --white:     #ffffff;
            --gray:      #8a8fa8;
            --gray-light:#e8e8ee;
            --red:       #c0392b;
            --green:     #27ae60;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
            --shadow-sm: 0 2px 8px rgba(26,32,53,.08);
            --shadow-md: 0 4px 20px rgba(26,32,53,.14);
            --shadow-lg: 0 8px 40px rgba(26,32,53,.18);
            --radius:    12px;
            --radius-sm: 8px;
        }

        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); background: var(--cream); color: var(--navy); min-height: 100vh; line-height: 1.6; }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; }
        button, input, select, textarea { font-family: var(--font-body); }

        /* ══════════════════════════════════════════
           NAVBAR
        ══════════════════════════════════════════ */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            background: var(--navy);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 48px; height: 68px;
            box-shadow: 0 2px 20px rgba(0,0,0,.3);
        }

        /* Crown logo */
        .navbar-brand {
            display: flex; align-items: center; gap: 10px;
            font-family: var(--font-display);
            font-size: 1.2rem; font-weight: 700;
            color: var(--gold); letter-spacing: .5px;
            flex-shrink: 0;
        }
        .navbar-brand svg { width: 30px; height: 23px; }

        .navbar-links { display: flex; align-items: center; gap: 32px; }
        .navbar-links a {
            color: var(--white); font-size: .9rem; font-weight: 500;
            opacity: .8; transition: opacity .2s, color .2s;
        }
        .navbar-links a:hover, .navbar-links a.nav-active { opacity: 1; color: var(--gold); }

        /* Tombol guest */
        .navbar-actions { display: flex; align-items: center; gap: 10px; }
        .btn-outline-gold {
            border: 1.5px solid var(--gold); color: var(--gold);
            background: transparent; border-radius: 50px;
            padding: 7px 22px; font-size: .875rem; font-weight: 600;
            cursor: pointer; transition: all .2s;
        }
        .btn-outline-gold:hover { background: var(--gold); color: var(--navy); }
        .btn-gold {
            background: var(--gold); color: var(--navy);
            border: none; border-radius: 50px;
            padding: 8px 22px; font-size: .875rem; font-weight: 700;
            cursor: pointer; transition: all .2s;
        }
        .btn-gold:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── User menu (logged in) ── */
        .nav-user-wrap { position: relative; }
        .nav-user-btn {
            display: flex; align-items: center; gap: 8px;
            background: rgba(201,168,76,.12);
            border: 1.5px solid rgba(201,168,76,.28);
            border-radius: 50px; padding: 5px 14px 5px 5px;
            cursor: pointer; color: var(--white);
            font-family: var(--font-body); font-size: .875rem; font-weight: 500;
            transition: all .2s;
        }
        .nav-user-btn:hover { background: rgba(201,168,76,.22); border-color: var(--gold); }
        .nav-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--gold); color: var(--navy);
            display: flex; align-items: center; justify-content: center;
            font-size: .78rem; font-weight: 800; flex-shrink: 0;
        }
        .nav-chevron { font-size: .65rem; opacity: .6; transition: transform .2s; }
        .nav-user-wrap.open .nav-chevron { transform: rotate(180deg); }

        .nav-dropdown {
            display: none; position: absolute;
            top: calc(100% + 10px); right: 0;
            background: var(--navy);
            border: 1px solid rgba(201,168,76,.2);
            border-radius: var(--radius-sm); min-width: 210px;
            box-shadow: 0 8px 32px rgba(0,0,0,.35);
            z-index: 1100; padding: 6px 0;
            animation: dropDown .18s ease both;
        }
        @keyframes dropDown { from{opacity:0;transform:translateY(-8px);}to{opacity:1;transform:translateY(0);} }
        .nav-user-wrap.open .nav-dropdown { display: block; }

        .nav-dd-header {
            padding: 12px 18px 10px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            margin-bottom: 4px;
        }
        .nav-dd-name { font-weight: 700; color: var(--white); font-size: .9rem; }
        .nav-dd-email { font-size: .75rem; color: rgba(255,255,255,.45); margin-top: 2px; }
        .nav-dd-role {
            display: inline-block; margin-top: 6px;
            background: rgba(201,168,76,.15); color: var(--gold);
            font-size: .68rem; font-weight: 700; letter-spacing: .5px;
            text-transform: uppercase; padding: 2px 8px; border-radius: 50px;
        }

        .nav-dd-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 18px; color: rgba(255,255,255,.72);
            font-size: .875rem; font-weight: 500;
            transition: all .15s; text-decoration: none;
            background: none; border: none; cursor: pointer;
            width: 100%; font-family: var(--font-body); text-align: left;
        }
        .nav-dd-item i { width: 14px; text-align: center; color: var(--gold); font-size: .85rem; }
        .nav-dd-item:hover { background: rgba(201,168,76,.1); color: var(--gold); }
        .nav-dd-divider { border: none; border-top: 1px solid rgba(255,255,255,.08); margin: 4px 0; }
        .nav-dd-logout { color: rgba(255,120,120,.8); }
        .nav-dd-logout i { color: rgba(255,120,120,.7); }
        .nav-dd-logout:hover { background: rgba(255,80,80,.08); color: #ff7070; }

        /* ══════════════════════════════════════════
           PAGE WRAPPER & FOOTER
        ══════════════════════════════════════════ */
        .page-wrapper { padding-top: 68px; min-height: 100vh; }
        .footer {
            background: var(--navy); color: rgba(255,255,255,.55);
            text-align: center; padding: 28px 40px; font-size: .85rem;
        }
        .footer span { color: var(--gold); }

        /* ══════════════════════════════════════════
           UTILITIES
        ══════════════════════════════════════════ */
        .badge { display: inline-block; padding: 3px 12px; border-radius: 50px; font-size: .75rem; font-weight: 600; }
        .badge-putri  { background: #fce4ec; color: #c2185b; }
        .badge-putra  { background: #e3f2fd; color: #1565c0; }
        .badge-campur { background: #f3e5f5; color: #7b1fa2; }
        .badge-green  { background: #e8f5e9; color: #2e7d32; }
        .badge-red    { background: #ffebee; color: #c62828; }

        .alert-success { background:#e8f5e9;color:#2e7d32;border:1px solid #a5d6a7;border-radius:var(--radius-sm);padding:12px 16px;margin-bottom:20px;font-size:.9rem; }
        .alert-error   { background:#ffebee;color:#c62828;border:1px solid #ef9a9a;border-radius:var(--radius-sm);padding:12px 16px;margin-bottom:20px;font-size:.9rem; }

        /* Flash message global */
        .flash-bar {
            position: fixed; top: 68px; left: 0; right: 0; z-index: 999;
            padding: 12px 48px; font-size: .88rem; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
            animation: slideDown .3s ease both;
        }
        @keyframes slideDown { from{opacity:0;transform:translateY(-10px);}to{opacity:1;transform:translateY(0);} }
        .flash-bar.success { background: #e8f5e9; color: #2e7d32; border-bottom: 1px solid #a5d6a7; }
        .flash-bar.error   { background: #ffebee; color: #c62828; border-bottom: 1px solid #ef9a9a; }
        .flash-close { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 1rem; color: inherit; opacity: .6; }

        /* Tables */
        .data-table { width:100%;border-collapse:collapse;background:var(--white);border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow-sm); }
        .data-table thead { background:#f7f3ec; }
        .data-table th { padding:14px 18px;text-align:left;font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--navy); }
        .data-table td { padding:14px 18px;border-top:1px solid var(--gray-light);font-size:.9rem; }
        .data-table tr:hover td { background:#fdf9f2; }

        /* Buttons */
        .btn { display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:var(--radius-sm);font-size:.85rem;font-weight:600;cursor:pointer;border:none;transition:all .2s;text-decoration:none; }
        .btn-primary { background:var(--gold);color:var(--navy); }
        .btn-primary:hover { background:var(--gold-light); }
        .btn-danger { background:var(--red);color:#fff; }
        .btn-danger:hover { background:#a93226; }
        .btn-edit { background:var(--navy);color:var(--white); }
        .btn-edit:hover { background:var(--navy-light); }
        .btn-sm { padding:5px 12px;font-size:.8rem; }
        .btn-add { background:none;border:1.5px solid var(--gold);color:var(--gold);border-radius:var(--radius-sm);padding:9px 20px;font-size:.875rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:all .2s;margin-top:20px;text-decoration:none; }
        .btn-add:hover { background:var(--gold);color:var(--navy); }

        /* Forms */
        .form-group { margin-bottom:20px; }
        .form-label { display:block;font-size:.85rem;font-weight:600;color:var(--navy);margin-bottom:6px; }
        .form-control { width:100%;padding:10px 14px;border:1.5px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.9rem;background:var(--white);color:var(--navy);outline:none;transition:border-color .2s,box-shadow .2s; }
        .form-control:focus { border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.15); }
        .form-row { display:grid;grid-template-columns:1fr 1fr;gap:16px; }

        @keyframes fadeUp { from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);} }
        .fade-up { animation:fadeUp .5s ease both; }
    </style>
    @stack('styles')
</head>
<body>

    @unless(View::hasSection('no_navbar'))
    <nav class="navbar">

        {{-- BRAND (Crown SVG) --}}
        <a class="navbar-brand" href="/">
            <svg viewBox="0 0 40 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 26h36" stroke="#C9A84C" stroke-width="2.2" stroke-linecap="round"/>
                <path d="M4 26L7 10L14 17L20 4L26 17L33 10L36 26"
                      stroke="#C9A84C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="4"  cy="9" r="2.5" fill="#C9A84C"/>
                <circle cx="20" cy="3" r="2.5" fill="#C9A84C"/>
                <circle cx="36" cy="9" r="2.5" fill="#C9A84C"/>
            </svg>
            MAHAKING KOS
        </a>

        {{-- NAV LINKS --}}
        <div class="navbar-links">
            <a href="/" class="{{ request()->is('/') ? 'nav-active' : '' }}">Home</a>
            <a href="/kos" class="{{ request()->is('kos*') ? 'nav-active' : '' }}">Search</a>
            @auth
                <a href="/wishlist" class="{{ request()->is('wishlist*') ? 'nav-active' : '' }}">Wishlist</a>
            @else
                <a href="/login">Wishlist</a>
            @endauth
        </div>

        {{-- ACTIONS --}}
        <div class="navbar-actions">
            @auth
                {{-- ── USER MENU ── --}}
                <div class="nav-user-wrap" id="navUserWrap">
                    <button class="nav-user-btn" onclick="toggleNavMenu()" type="button">
                        <div class="nav-avatar">
                            {{ strtoupper(substr(auth()->user()->nama_depan ?? 'U', 0, 1)) }}
                        </div>
                        <span>{{ auth()->user()->nama_depan }}</span>
                        <i class="fas fa-chevron-down nav-chevron"></i>
                    </button>

                    <div class="nav-dropdown">
                        {{-- Header --}}
                        <div class="nav-dd-header">
                            <div class="nav-dd-name">{{ auth()->user()->nama }}</div>
                            <div class="nav-dd-email">{{ auth()->user()->email }}</div>
                            <span class="nav-dd-role">
                                {{ auth()->user()->role === 'pemilik' ? 'Pemilik Kos' : 'Pencari Kos' }}
                            </span>
                        </div>

                        @if(auth()->user()->role === 'pemilik')
                            <a href="{{ route('owner.index') }}" class="nav-dd-item">
                                <i class="fas fa-chart-pie"></i> Dashboard Owner
                            </a>
                            <a href="{{ route('owner.kos.index') }}" class="nav-dd-item">
                                <i class="fas fa-building"></i> Kelola Kos
                            </a>
                            <a href="{{ route('owner.profile.show') }}" class="nav-dd-item">
                                <i class="fas fa-user-tie"></i> Profil Saya
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="nav-dd-item">
                                <i class="fas fa-gauge"></i> Dashboard
                            </a>
                            <a href="{{ route('wishlist.index') }}" class="nav-dd-item">
                                <i class="fas fa-heart"></i> Wishlist
                            </a>
                            <a href="{{ route('review.index') }}" class="nav-dd-item">
                                <i class="fas fa-star"></i> Review Saya
                            </a>
                            <a href="{{ route('profile.show') }}" class="nav-dd-item">
                                <i class="fas fa-user"></i> Profil Saya
                            </a>
                        @endif

                        <hr class="nav-dd-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-dd-item nav-dd-logout">
                                <i class="fas fa-right-from-bracket"></i> Keluar Akun
                            </button>
                        </form>
                    </div>
                </div>

            @else
                {{-- ── GUEST ── --}}
                <a href="/register"><button class="btn-outline-gold">DAFTAR</button></a>
                <a href="/login"><button class="btn-gold">LOGIN</button></a>
            @endauth
        </div>
    </nav>
    @endunless

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
    <div class="flash-bar success" id="flashBar">
        <i class="fas fa-circle-check"></i>
        {{ session('success') }}
        <button class="flash-close" onclick="document.getElementById('flashBar').remove()">✕</button>
    </div>
    @endif
    @if(session('error'))
    <div class="flash-bar error" id="flashBar">
        <i class="fas fa-circle-xmark"></i>
        {{ session('error') }}
        <button class="flash-close" onclick="document.getElementById('flashBar').remove()">✕</button>
    </div>
    @endif

    <div class="page-wrapper">
        @yield('content')
    </div>

    @unless(View::hasSection('no_footer'))
    <footer class="footer">
        <p>© 2026 <span>Mahaking Kos</span> — Temukan hunian impianmu di Jatinangor</p>
    </footer>
    @endunless

    @stack('scripts')

    <script>
        // ── Nav user dropdown ──
        function toggleNavMenu() {
            document.getElementById('navUserWrap').classList.toggle('open');
        }
        document.addEventListener('click', function(e) {
            const wrap = document.getElementById('navUserWrap');
            if (wrap && !wrap.contains(e.target)) wrap.classList.remove('open');
        });

        // ── Auto-close flash after 4s ──
        setTimeout(function() {
            const f = document.getElementById('flashBar');
            if (f) f.style.opacity = '0', setTimeout(() => f.remove(), 400);
        }, 4000);
    </script>
</body>
</html>