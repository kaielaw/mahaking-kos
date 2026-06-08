@extends('layouts.app')

@section('title', 'Temukan Kos Premium di Jatinangor')

@push('styles')
<style>
    /* HERO */
    .hero {
        position: relative; min-height: 100vh;
        display: flex; flex-direction: column;
        overflow: hidden;
    }
    .hero-bg {
        position: absolute; inset: 0;
        background-image: url('/images/hero-kos.png');
        background-size: cover; background-position: center;
    }
    .hero-bg-fallback {
        position: absolute; inset: 0;
        background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1600&q=80');
        background-size: cover; background-position: center;
    }
    .hero-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            to right,
            rgba(20,28,50,.82) 0%,
            rgba(20,28,50,.55) 60%,
            rgba(20,28,50,.25) 100%
        );
    }
    .hero-content {
        position: relative; z-index: 2;
        flex: 1; display: flex; flex-direction: column;
        justify-content: center;
        padding: 0 80px;
        max-width: 740px;
    }
    .hero-title {
        font-family: var(--font-display);
        font-size: 3.6rem; font-weight: 700;
        color: var(--white); line-height: 1.12;
        margin-bottom: 36px;
    }
    .hero-title em { color: var(--gold); font-style: normal; }

    .search-bar {
        display: flex; align-items: center;
        background: var(--white); border-radius: 50px;
        padding: 8px 8px 8px 24px;
        max-width: 580px;
        box-shadow: 0 8px 40px rgba(0,0,0,.3);
    }
    .search-bar i { color: var(--gray); margin-right: 10px; font-size: 1rem; flex-shrink: 0; }
    .search-bar input {
        flex: 1; border: none; background: transparent;
        font-family: var(--font-body); font-size: .95rem; color: var(--navy);
        outline: none;
    }
    .search-bar input::placeholder { color: #a0a0b0; }
    .btn-search {
        background: var(--gold); color: var(--navy);
        border: none; border-radius: 50px;
        padding: 12px 28px; font-size: .9rem; font-weight: 700;
        cursor: pointer; white-space: nowrap;
        transition: background .2s;
    }
    .btn-search:hover { background: var(--gold-light); }

    /* FEAT PILLS */
    .hero-features {
        position: relative; z-index: 2;
        display: flex; gap: 48px;
        padding: 36px 80px 56px;
    }
    .feat-item { display: flex; align-items: center; gap: 16px; }
    .feat-icon {
        width: 54px; height: 54px; border-radius: 50%;
        background: rgba(201,168,76,.15);
        border: 1.5px solid rgba(201,168,76,.3);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .feat-icon img { width: 26px; height: 26px; }
    .feat-label { color: var(--white); font-size: .95rem; font-weight: 500; }
    .feat-label.highlight { color: var(--gold); font-weight: 700; }

    /* SECTION */
    .section { padding: 72px 80px; }
    .section-header {
        display: flex; align-items: flex-end;
        justify-content: space-between; margin-bottom: 36px;
    }
    .section-title {
        font-family: var(--font-display);
        font-size: 2rem; font-weight: 700; color: var(--navy);
    }
    .section-link { color: var(--gold); font-size: .9rem; font-weight: 600; }
    .section-link:hover { text-decoration: underline; }

    /* KOS GRID */
    .kos-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .kos-card {
        background: var(--white); border-radius: var(--radius);
        overflow: hidden; box-shadow: var(--shadow-sm);
        transition: transform .25s, box-shadow .25s;
        cursor: pointer; display: block;
    }
    .kos-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
    .kos-card-img {
        height: 200px; position: relative; overflow: hidden;
        background: var(--navy);
    }
    .kos-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
    .kos-card:hover .kos-card-img img { transform: scale(1.05); }
    .kos-badge {
        position: absolute; bottom: 12px; left: 12px;
        background: rgba(201,168,76,.9);
        color: var(--navy); font-size: .7rem; font-weight: 700;
        padding: 3px 10px; border-radius: 50px;
        text-transform: uppercase; letter-spacing: .5px;
    }
    .kos-card-body { padding: 18px 20px; }
    .kos-card-name {
        font-family: var(--font-display);
        font-size: 1.05rem; font-weight: 700;
        color: var(--navy); margin-bottom: 6px;
    }
    .kos-card-rating {
        display: flex; align-items: center; gap: 5px;
        font-size: .82rem; margin-bottom: 10px;
    }
    .kos-card-rating .star { color: var(--gold); }
    .kos-card-rating .count { color: var(--gray); }
    .kos-card-price { font-size: 1.05rem; font-weight: 700; color: var(--navy); }
    .kos-card-price small { font-weight: 400; color: var(--gray); font-size: .8rem; }

    /* FEATURE CARDS */
    .features-section { background: var(--navy); padding: 72px 80px; }
    .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .feature-card {
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(201,168,76,.2);
        border-radius: var(--radius);
        padding: 32px 28px; text-align: center;
        transition: transform .2s;
    }
    .feature-card:hover { transform: translateY(-3px); }
    .feature-card .icon { font-size: 2.2rem; color: var(--gold); margin-bottom: 14px; }
    .feature-card h3 {
        font-family: var(--font-display);
        font-size: 1.1rem; color: var(--gold); margin-bottom: 8px;
    }
    .feature-card p { font-size: .87rem; color: rgba(255,255,255,.6); line-height: 1.6; }
    .features-title {
        font-family: var(--font-display);
        font-size: 2rem; font-weight: 700;
        color: var(--white); margin-bottom: 36px;
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-bg-fallback"></div>
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <h1 class="hero-title">
            Temukan Kos<br>
            <em>Premium</em> di Jatinangor
        </h1>
        <form class="search-bar" action="{{ route('kos.index') }}" method="GET">
            <i class="fas fa-location-dot"></i>
            <input type="text" name="q" placeholder="Masukkan nama kos, daerah, kecamatan"
                   value="{{ request('q') }}">
            <button type="submit" class="btn-search">Cari Sekarang</button>
        </form>
    </div>

    <div class="hero-features">
        <div class="feat-item">
            <div class="feat-icon">
                <img src="/images/money.svg" alt="" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                <i class="fas fa-dollar-sign" style="color:var(--gold);display:none;font-size:1.2rem;"></i>
            </div>
            <span class="feat-label">Harga Terjangkau</span>
        </div>
        <div class="feat-item">
            <div class="feat-icon">
                <img src="/images/home.svg" alt="" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                <i class="fas fa-house" style="color:var(--gold);display:none;font-size:1.2rem;"></i>
            </div>
            <span class="feat-label">Fasilitas Lengkap</span>
        </div>
        <div class="feat-item">
            <div class="feat-icon">
                <img src="/images/map.svg" alt="" onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
                <i class="fas fa-location-dot" style="color:var(--gold);display:none;font-size:1.2rem;"></i>
            </div>
            <span class="feat-label">Lokasi Strategis</span>
        </div>
    </div>
</section>

{{-- REKOMENDASI --}}
<section class="section">
    <div class="section-header">
        <h2 class="section-title">Rekomendasi Kos</h2>
        <a href="{{ route('kos.index') }}" class="section-link">Lihat semua →</a>
    </div>
    <div class="kos-grid">
        @isset($dataKos)
            @foreach($dataKos->take(6) as $kos)
            <a href="{{ route('kos.show', $kos->id_kos) }}" class="kos-card">
                <div class="kos-card-img">
                    <img src="{{ $kos->fotoKos->first()?->url_foto ?? 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600&q=80' }}"
                         alt="{{ $kos->nama_kos }}">
                    <span class="kos-badge">{{ strtoupper($kos->jenis_kos) }} · {{ $kos->lokasi?->kecamatan }}</span>
                </div>
                <div class="kos-card-body">
                    <div class="kos-card-name">{{ $kos->nama_kos }}</div>
                    <div class="kos-card-rating">
                        <i class="fas fa-star star"></i>
                        <strong>{{ $kos->rating_rata2 ?? '—' }}</strong>
                        <span class="count">({{ $kos->total_review ?? 0 }} Review)</span>
                    </div>
                    <div class="kos-card-price">
                        Rp {{ number_format($kos->harga_min, 0, ',', '.') }}
                        <small>/bulan</small>
                    </div>
                </div>
            </a>
            @endforeach
        @else
            @for($i = 0; $i < 3; $i++)
            <div class="kos-card">
                <div class="kos-card-img" style="background:#2a3555;">
                    <span class="kos-badge">PUTRI · JATINANGOR</span>
                </div>
                <div class="kos-card-body">
                    <div class="kos-card-name">Kos Mahaking Eksklusif</div>
                    <div class="kos-card-rating">
                        <i class="fas fa-star star"></i>
                        <strong>4.9</strong>
                        <span class="count">(120 Review)</span>
                    </div>
                    <div class="kos-card-price">Rp 1.500.000 <small>/bulan</small></div>
                </div>
            </div>
            @endfor
        @endisset
    </div>
</section>

{{-- KENAPA MAHAKING --}}
<section class="features-section">
    <h2 class="features-title">Kenapa Mahaking Kos?</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="icon"><i class="fas fa-magnifying-glass-location"></i></div>
            <h3>Pencarian Mudah</h3>
            <p>Temukan kos sesuai lokasi, harga, dan kebutuhan hanya dalam beberapa klik.</p>
        </div>
        <div class="feature-card">
            <div class="icon"><i class="fas fa-heart"></i></div>
            <h3>Wishlist Kos</h3>
            <p>Simpan kos favorit dan bandingkan pilihan sebelum memutuskan.</p>
        </div>
        <div class="feature-card">
            <div class="icon"><i class="fas fa-star"></i></div>
            <h3>Review Pengguna</h3>
            <p>Baca ulasan jujur dari penghuni sebelumnya sebelum menyewa.</p>
        </div>
    </div>
</section>

@endsection