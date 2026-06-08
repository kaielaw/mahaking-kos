@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('sidebar_nav')
    <a href="{{ route('dashboard') }}" class="active"><i class="fas fa-gauge"></i><span class="nav-label">Dashboard</span></a>
    <a href="{{ route('wishlist.index') }}"><i class="fas fa-heart"></i><span class="nav-label">Wishlist</span></a>
    <a href="{{ route('review.index') }}"><i class="fas fa-star"></i><span class="nav-label">Review &amp; Rating</span></a>
    <a href="{{ route('profile.show') }}"><i class="fas fa-user"></i><span class="nav-label">Profile</span></a>
@endsection

@push('styles')
<style>
    .welcome-banner { background:var(--navy);border-radius:var(--radius);padding:28px 32px;margin-bottom:32px;display:flex;align-items:center;justify-content:space-between;position:relative;overflow:hidden; }
    .welcome-banner::before { content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 80% 50%,rgba(201,168,76,.15) 0%,transparent 60%); }
    .welcome-text { position:relative;z-index:1; }
    .welcome-text h3 { font-family:var(--font-display);font-size:1.3rem;font-weight:700;color:var(--white);margin-bottom:6px; }
    .welcome-text p { font-size:.88rem;color:rgba(255,255,255,.6); }
    .welcome-icon { position:relative;z-index:1;font-size:3rem;opacity:.18;color:var(--gold); }

    .stats-grid { display:grid;grid-template-columns:repeat(2,1fr);gap:20px;margin-bottom:36px; }
    .stat-card { background:#fdf9f5;border:1.5px solid var(--gray-light);border-radius:var(--radius);padding:22px 24px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s; }
    .stat-card:hover { box-shadow:var(--shadow-sm); }
    .stat-icon { width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0; }
    .stat-icon.gold { background:var(--gold-pale);color:var(--gold); }
    .stat-icon.navy { background:rgba(26,32,53,.08);color:var(--navy); }
    .stat-label { font-size:.75rem;color:var(--gray);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px; }
    .stat-value { font-family:var(--font-display);font-size:1.7rem;font-weight:700;color:var(--navy);line-height:1; }

    .cta-box { background:var(--gold-pale);border:1.5px solid var(--gold-light);border-radius:var(--radius);padding:24px 28px;display:flex;align-items:center;justify-content:space-between;margin-top:28px; }
    .cta-box h4 { font-family:var(--font-display);font-size:1.05rem;color:var(--navy);margin-bottom:4px; }
    .cta-box p { font-size:.85rem;color:var(--gray); }
    .btn-cta { background:var(--gold);color:var(--navy);border:none;border-radius:var(--radius-sm);padding:11px 24px;font-size:.88rem;font-weight:700;cursor:pointer;text-decoration:none;display:inline-block;transition:background .2s;margin-left:20px;flex-shrink:0; }
    .btn-cta:hover { background:var(--gold-light); }
</style>
@endpush

@section('content')

<div class="welcome-banner fade-up">
    <div class="welcome-text">
        <h3>Hai, {{ auth()->user()->nama_depan }}! 👋</h3>
        <p>Temukan dan kelola kos favoritmu di sini.</p>
    </div>
    <i class="fas fa-house welcome-icon"></i>
</div>

<div class="stats-grid fade-up">
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-heart"></i></div>
        <div>
            <div class="stat-label">Wishlist</div>
            <div class="stat-value">{{ $totalWishlist ?? 0 }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon navy"><i class="fas fa-star"></i></div>
        <div>
            <div class="stat-label">Ulasan Diberikan</div>
            <div class="stat-value">{{ $totalReview ?? 0 }}</div>
        </div>
    </div>
</div>

@if(isset($wishlistTerbaru) && $wishlistTerbaru->count())
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;" class="fade-up">
    <span style="font-family:var(--font-display);font-size:1.05rem;font-weight:700;color:var(--navy);">Wishlist Terbaru</span>
    <a href="{{ route('wishlist.index') }}" style="font-size:.82rem;font-weight:600;color:var(--gold);">Lihat semua →</a>
</div>
@foreach($wishlistTerbaru as $w)
<div class="wishlist-item fade-up">
    <i class="fas fa-heart wishlist-heart active"></i>
    <div class="wishlist-thumb">
        <img src="{{ $w->kos?->fotoKos->first()?->url_foto ?? 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=300&q=70' }}"
             style="width:100%;height:100%;object-fit:cover;" alt="">
    </div>
    <div class="wishlist-info">
        <div class="wishlist-name">{{ $w->kos?->nama_kos }}</div>
        <div class="wishlist-loc">
            <i class="fas fa-location-dot" style="color:var(--gold);font-size:.75rem;"></i>
            {{ $w->kos?->lokasi?->kecamatan }}, {{ $w->kos?->lokasi?->kota }}
        </div>
        <div class="wishlist-price">
            Rp {{ number_format($w->kos?->harga_min ?? 0, 0, ',', '.') }}
            <span style="color:var(--gray);font-weight:400;font-size:.82rem;"> / bulan</span>
        </div>
    </div>
    <div class="wishlist-actions">
        <a href="{{ route('kos.show', $w->kos?->id_kos) }}" class="btn btn-primary btn-sm">Lihat</a>
    </div>
</div>
@endforeach
@endif

<div class="cta-box fade-up">
    <div>
        <h4>Belum menemukan kos yang pas?</h4>
        <p>Jelajahi ratusan pilihan kos di Jatinangor.</p>
    </div>
    <a href="{{ route('kos.index') }}" class="btn-cta">Cari Kos Sekarang</a>
</div>

@endsection