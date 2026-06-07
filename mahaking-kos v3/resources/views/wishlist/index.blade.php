@extends('layouts.dashboard')

@section('title', 'Wishlist')

@section('sidebar_nav')
    <a href="{{ route('dashboard') }}"><i class="fas fa-gauge"></i><span class="nav-label">Dashboard</span></a>
    <a href="{{ route('wishlist.index') }}" class="active"><i class="fas fa-heart"></i><span class="nav-label">Wishlist</span></a>
    <a href="{{ route('review.index') }}"><i class="fas fa-star"></i><span class="nav-label">Review &amp; Rating</span></a>
    <a href="{{ route('profile.show') }}"><i class="fas fa-user"></i><span class="nav-label">Profile</span></a>
@endsection

@section('content')
<h2>Hunian Impianmu</h2>

@if(isset($wishlists) && $wishlists->count())
    @foreach($wishlists as $w)
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
            <a href="{{ route('kos.show', $w->kos?->id_kos) }}" class="btn btn-primary btn-sm">
                Lihat Detail
            </a>
            <form method="POST" action="{{ route('wishlist.destroy', $w->id_favorit) }}" style="margin:0;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
@else
    <div style="text-align:center;padding:60px 20px;color:var(--gray);">
        <i class="far fa-heart" style="font-size:3rem;color:var(--gold-pale);margin-bottom:16px;display:block;"></i>
        <p style="margin-bottom:12px;">Belum ada kos di wishlist kamu.</p>
        <a href="{{ route('kos.index') }}" style="color:var(--gold);font-weight:600;">
            Cari Kos Sekarang →
        </a>
    </div>
@endif
@endsection