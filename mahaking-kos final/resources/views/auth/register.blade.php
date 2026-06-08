<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar – Mahaking Kos</title>
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
        body { font-family: var(--font-body); min-height: 100vh; display: flex; background: #f8f7f5; }
        a { text-decoration: none; color: inherit; }

        /* LEFT BRAND (BOTTOM) */
        .left-panel {
            width: 40%;
            display: flex; flex-direction: column;
            align-items: flex-start; justify-content: flex-end;
            padding: 60px 52px;
        }
        .brand-tagline {
            font-family: var(--font-display);
            font-size: 2rem; font-weight: 700;
            color: var(--navy); line-height: 1.25;
            margin-bottom: 20px;
        }
        .brand-tagline span { color: var(--gold); }
        .brand-logo {
            display: flex; align-items: center; gap: 12px;
        }
        .brand-logo span {
            font-family: var(--font-display);
            font-size: 1.25rem; font-weight: 700;
            color: var(--gold);
        }

        /* RIGHT FORM */
        .right-panel {
            flex: 1;
            display: flex; flex-direction: column;
            align-items: flex-start; justify-content: center;
            padding: 60px 64px 60px 48px;
        }
        .form-title {
            font-family: var(--font-display);
            font-size: 2.4rem; font-weight: 700;
            color: var(--navy); margin-bottom: 6px;
        }
        .form-subtitle {
            color: var(--gray); font-size: .9rem;
            margin-bottom: 36px;
        }
        .form-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
            margin-bottom: 14px; width: 100%;
        }
        @media (max-width: 480px) { .form-row { grid-template-columns: 1fr; } }
        .form-group { margin-bottom: 14px; width: 100%; }
        .form-label {
            display: block; font-size: .8rem; font-weight: 600;
            color: var(--navy); margin-bottom: 6px;
        }
        .form-control {
            width: 100%; padding: 11px 14px;
            background: #e8e6e0; border: 1.5px solid transparent;
            border-radius: 8px;
            font-family: var(--font-body); font-size: .9rem; color: var(--navy);
            outline: none; transition: border-color .2s, background .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--gold);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(201,168,76,.12);
        }
        select.form-control { cursor: pointer; }
        .btn-register {
            width: 100%; padding: 14px;
            background: var(--gold); color: var(--navy);
            border: none; border-radius: 8px;
            font-family: var(--font-body); font-size: .9rem; font-weight: 700;
            letter-spacing: 1px; cursor: pointer;
            margin-top: 8px; margin-bottom: 20px;
            transition: background .2s, transform .15s;
        }
        .btn-register:hover { background: var(--gold-light); transform: translateY(-1px); }
        .login-link {
            text-align: center; font-size: .9rem; color: var(--gray);
            width: 100%;
        }
        .login-link a { color: var(--gold); font-weight: 600; }

        @keyframes fadeUp { from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);} }
        .right-panel { animation: fadeUp .5s ease both; }
    </style>
</head>
<body>

    {{-- LEFT --}}
    <div class="left-panel">
        <p class="brand-tagline">
            Mulai perjalanan pencarian<br>
            hunian nyamanmu bersama<br>
        </p>
        <div class="brand-logo">
            <svg width="32" height="32" viewBox="0 0 72 72" fill="none">
                <path d="M12 52h48M10 52L18 24l18 18 18-24 8 34" stroke="#C9A84C" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="18" cy="24" r="4" fill="#C9A84C"/>
                <circle cx="36" cy="18" r="4" fill="#C9A84C"/>
                <circle cx="54" cy="24" r="4" fill="#C9A84C"/>
            </svg>
            <span>MAHAKING KOS</span>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="right-panel">
        <h1 class="form-title">Buat Akun Baru</h1>
        <p class="form-subtitle">Silakan isi data diri di bawah ini</p>

        @if($errors->any())
            <div style="background:#ffebee;color:#c62828;border-radius:8px;padding:12px 16px;margin-bottom:16px;font-size:.85rem;width:100%;">
                @foreach($errors->all() as $err)<div>• {{ $err }}</div>@endforeach
            </div>
        @endif

        <form method="POST" action="/register" style="width:100%;">
            @csrf
            <div class="form-row">
                <div>
                    <label class="form-label">Nama Depan</label>
                    <input type="text" name="nama_depan" class="form-control" value="{{ old('nama_depan') }}" required>
                </div>
                <div>
                    <label class="form-label">Nama Belakang</label>
                    <input type="text" name="nama_belakang" class="form-control" value="{{ old('nama_belakang') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-row">
                <div>
                    <label class="form-label">Nomor Handphone</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
                </div>
                <div>
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="" disabled selected>Pilih</option>
                        <option value="penyewa" {{ old('role')=='penyewa'?'selected':'' }}>Pencari Kos</option>
                        <option value="pemilik" {{ old('role')=='pemilik'?'selected':'' }}>Pemilik Kos</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div>
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="pw" class="form-control" required>
                </div>
                <div>
                    <label class="form-label">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" id="pwconf" class="form-control" required>
                </div>
            </div>
            <div id="pw-match-msg" style="display:none;font-size:.78rem;margin-bottom:8px;"></div>
            <button type="submit" class="btn-register">DAFTAR</button>
        </form>

        <div class="login-link">
            Sudah memiliki akun?
            <a href="/login">Masuk di sini!</a>
        </div>
    </div>

    <script>
        const pw = document.getElementById('pw');
        const pwconf = document.getElementById('pwconf');
        const msg = document.getElementById('pw-match-msg');

        function checkMatch() {
            if (!pwconf.value) { msg.style.display = 'none'; return; }
            if (pw.value === pwconf.value) {
                msg.style.display = 'block';
                msg.style.color = '#2e7d32';
                msg.textContent = '✓ Password cocok';
            } else {
                msg.style.display = 'block';
                msg.style.color = '#c62828';
                msg.textContent = '✗ Password tidak cocok';
            }
        }
        pw.addEventListener('input', checkMatch);
        pwconf.addEventListener('input', checkMatch);
    </script>
</body>
</html>