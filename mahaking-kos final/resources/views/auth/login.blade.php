<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Mahaking Kos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --navy: #1a2035; --gold: #C9A84C; --gold-light: #e0c06e;
            --gold-pale: #f5e9c8; --white: #ffffff; --gray: #8a8fa8;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
        }
        body { font-family: var(--font-body); min-height: 100vh; display: flex; background: var(--white); }
        a { text-decoration: none; color: inherit; }

        /* LEFT PANEL */
        .left-panel {
            width: 45%;
            background: var(--navy);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 60px 48px;
            position: relative; overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(201,168,76,.15) 0%, transparent 65%);
        }
        .left-decoration {
            position: absolute; top: 0; right: 0; bottom: 0; left: 0;
            background-image:
                radial-gradient(circle at 80% 20%, rgba(201,168,76,.08) 0%, transparent 40%),
                radial-gradient(circle at 20% 80%, rgba(201,168,76,.06) 0%, transparent 40%);
        }
        .brand-area { position: relative; z-index: 2; text-align: center; }
        .crown-icon {
            width: 72px; height: 72px; margin: 0 auto 28px;
        }
        .welcome-text {
            font-family: var(--font-display);
            font-size: 3.6rem; font-weight: 900;
            color: var(--gold); line-height: 1.05;
            letter-spacing: -1px;
            margin-bottom: 24px;
        }
        .brand-name {
            display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .brand-name span {
            font-family: var(--font-display);
            font-size: 1.1rem; font-weight: 700;
            color: rgba(255,255,255,.75); letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* RIGHT PANEL */
        .right-panel {
            flex: 1;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 60px 72px;
            background: #f8f7f5;
        }
        .form-container { width: 100%; max-width: 420px; }
        .form-title {
            font-family: var(--font-display);
            font-size: 2.2rem; font-weight: 700;
            color: var(--navy); margin-bottom: 8px;
            text-align: center;
        }
        .form-subtitle {
            text-align: center; color: var(--gray);
            font-size: .9rem; margin-bottom: 40px;
        }

        .input-group { margin-bottom: 16px; }
        .input-field {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid var(--gold-pale);
            border-radius: 50px;
            background: var(--gold-pale);
            font-family: var(--font-body);
            font-size: .9rem; color: var(--navy);
            transition: border-color .2s, background .2s, box-shadow .2s;
            outline: none;
        }
        .input-field::placeholder { color: #b5a47a; }
        .input-field:focus {
            border-color: var(--gold);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(201,168,76,.12);
        }
        .btn-login {
            width: 100%;
            padding: 16px;
            background: var(--gold);
            color: var(--navy);
            border: none; border-radius: 50px;
            font-family: var(--font-display);
            font-size: 1rem; font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 8px;
            transition: background .2s, transform .15s, box-shadow .2s;
        }
        .btn-login:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(201,168,76,.35);
        }
        .register-link {
            text-align: center; margin-top: 24px;
            font-size: .9rem; color: var(--gray);
        }
        .register-link a { color: var(--gold); font-weight: 600; }
        .register-link a:hover { text-decoration: underline; }

        @keyframes fadeInLeft { from{opacity:0;transform:translateX(-30px);}to{opacity:1;transform:translateX(0);} }
        @keyframes fadeInRight { from{opacity:0;transform:translateX(30px);}to{opacity:1;transform:translateX(0);} }
        .left-panel { animation: fadeInLeft .6s ease both; }
        .right-panel { animation: fadeInRight .6s ease both; }
    </style>
</head>
<body>

    {{-- LEFT PANEL --}}
    <div class="left-panel">
        <div class="left-decoration"></div>
        <div class="brand-area">
            <div class="crown-icon">
                <svg viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 52h48M10 52L18 24l18 18 18-24 8 34" stroke="#C9A84C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="18" cy="24" r="4" fill="#C9A84C"/>
                    <circle cx="36" cy="18" r="4" fill="#C9A84C"/>
                    <circle cx="54" cy="24" r="4" fill="#C9A84C"/>
                    <rect x="8" y="52" width="56" height="6" rx="3" fill="#C9A84C" opacity=".3"/>
                </svg>
            </div>
            <div class="welcome-text">SELAMAT<br>DATANG!</div>
            <div class="brand-name">
                <svg width="28" height="28" viewBox="0 0 72 72" fill="none">
                    <path d="M12 52h48M10 52L18 24l18 18 18-24 8 34" stroke="#C9A84C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="18" cy="24" r="4" fill="#C9A84C"/>
                    <circle cx="36" cy="18" r="4" fill="#C9A84C"/>
                    <circle cx="54" cy="24" r="4" fill="#C9A84C"/>
                </svg>
                <span>MAHAKING KOS</span>
            </div>
        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="right-panel">
        <div class="form-container">
            <h1 class="form-title">LOGIN PAGE</h1>
            <p class="form-subtitle">Masukkan email dan password anda</p>

            @if(session('error'))
                <div style="background:#ffebee;color:#c62828;border-radius:12px;padding:12px 16px;margin-bottom:20px;font-size:.85rem;text-align:center;">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" class="input-field" placeholder="Email"
                           value="{{ old('email') }}" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" class="input-field" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-login">LOGIN</button>
            </form>

            <div class="register-link">
                Belum memiliki akun?<br>
                <a href="/register">Daftar di sini!</a>
            </div>
        </div>
    </div>

</body>
</html>