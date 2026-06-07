@extends('layouts.app')

@section('title', isset($kos) ? $kos->nama_kos : 'Detail Kos')

@push('styles')
<style>
    .page-bg { background: #f0ece4; min-height: 100vh; }

    /* BREADCRUMB */
    .breadcrumb-bar {
        background: var(--navy);
        padding: 14px 80px;
        display: flex; align-items: center; gap: 8px;
        font-size: .83rem; color: rgba(255,255,255,.55);
    }
    .breadcrumb-bar a { color: rgba(255,255,255,.55); }
    .breadcrumb-bar a:hover { color: var(--gold); }
    .breadcrumb-bar .sep { color: rgba(255,255,255,.3); }
    .breadcrumb-bar .current { color: var(--gold); font-weight: 600; }

    /* MAIN CONTENT */
    .detail-wrap { padding: 40px 80px 72px; }
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 36px; align-items: start;
    }
    /* Kolom kanan: scrollable supaya info card tidak tertutup price */
    .detail-right {
        position: sticky; top: 88px;
        max-height: calc(100vh - 100px);
        overflow-y: auto;
        /* sembunyikan scrollbar tapi tetap bisa scroll */
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .detail-right::-webkit-scrollbar { display: none; }
    @media (max-width: 900px) {
        .detail-grid { grid-template-columns: 1fr; }
        .detail-right { position: static; max-height: none; overflow-y: visible; }
    }

    /* PHOTOS */
    .main-photo {
        border-radius: var(--radius); overflow: hidden;
        height: 360px; background: var(--navy);
    }
    .main-photo img { width: 100%; height: 100%; object-fit: cover; }
    .thumb-row { display: flex; gap: 10px; margin-top: 12px; }
    .thumb {
        width: 80px; height: 60px; border-radius: var(--radius-sm);
        overflow: hidden; background: var(--navy);
        cursor: pointer; border: 2px solid transparent;
        transition: border-color .2s; flex-shrink: 0;
    }
    .thumb:hover, .thumb.active { border-color: var(--gold); }
    .thumb img { width: 100%; height: 100%; object-fit: cover; }
    .thumb-more {
        display: flex; align-items: center; justify-content: center;
        background: rgba(26,32,53,.75); color: var(--white);
        font-size: .85rem; font-weight: 700;
    }

    /* KOS INFO */
    .kos-name {
        font-family: var(--font-display);
        font-size: 2rem; font-weight: 700;
        color: var(--navy); margin: 20px 0 6px;
    }
    .kos-location {
        display: flex; align-items: center; gap: 6px;
        color: var(--gray); font-size: .9rem; margin-bottom: 8px;
    }
    .kos-location i { color: var(--gold); }
    .kos-rating {
        display: flex; align-items: center; gap: 6px;
        font-size: .9rem; margin-bottom: 24px;
    }
    .kos-rating i { color: var(--gold); }
    .kos-rating strong { color: var(--gold); }
    .kos-rating span { color: var(--gray); }
    .kos-divider { border: none; border-top: 1px solid var(--gray-light); margin-bottom: 20px; }

    /* TABS */
    .tab-nav {
        display: flex; gap: 0;
        border-bottom: 2px solid var(--gray-light); margin-bottom: 20px;
    }
    .tab-btn {
        padding: 10px 20px; font-size: .88rem; font-weight: 600;
        color: var(--gray); background: none; border: none;
        cursor: pointer; border-bottom: 2px solid transparent;
        margin-bottom: -2px; transition: color .2s, border-color .2s;
    }
    .tab-btn.active, .tab-btn:hover { color: var(--gold); border-bottom-color: var(--gold); }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    .tab-content p { font-size: .9rem; color: #555; line-height: 1.7; }

    /* RIGHT CARD */
    .price-card {
        background: var(--white); border-radius: var(--radius);
        padding: 28px; box-shadow: var(--shadow-md);
        /* DIHAPUS: position: sticky; top: 90px; */
        /* Supaya info card di bawahnya tidak tertutup */
    }
    .price-label {
        font-size: .72rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .8px;
        color: var(--gray); margin-bottom: 6px;
    }
    .price-main {
        font-size: 2rem; font-weight: 900;
        color: var(--navy); font-family: var(--font-display);
        margin-bottom: 4px;
    }
    .price-main small { font-size: .9rem; font-weight: 400; color: var(--gray); }
    .avail-badge {
        display: flex; align-items: center; gap: 8px;
        background: #e8f5e9; color: #2e7d32;
        border-radius: 8px; padding: 10px 16px;
        font-size: .85rem; font-weight: 600; margin: 16px 0;
    }
    .facilities-row {
        display: flex; gap: 8px; flex-wrap: wrap;
        margin: 16px 0 24px; padding: 16px;
        border: 1.5px solid var(--gray-light);
        border-radius: var(--radius-sm);
    }
    .fac-item {
        display: flex; align-items: center; gap: 6px;
        font-size: .8rem; font-weight: 500; color: var(--navy);
        background: var(--gold-pale); padding: 6px 12px;
        border-radius: 20px;
    }
    .fac-item i { color: var(--gold); font-size: .9rem; }
    .btn-book {
        width: 100%; padding: 15px;
        background: var(--gold); color: var(--navy);
        border: none; border-radius: var(--radius-sm);
        font-size: .95rem; font-weight: 700;
        cursor: pointer; letter-spacing: .3px; margin-bottom: 12px;
        transition: background .2s, transform .15s;
    }
    .btn-book:hover { background: var(--gold-light); transform: translateY(-1px); }
    .btn-wishlist {
        width: 100%; padding: 13px;
        background: none; color: var(--gold);
        border: 1.5px solid var(--gold);
        border-radius: var(--radius-sm);
        font-size: .9rem; font-weight: 700; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: all .2s;
    }
    .btn-wishlist:hover { background: var(--gold-pale); }

    /* INFO CARD */
    .info-card {
        background: var(--white); border-radius: var(--radius);
        padding: 24px 28px; box-shadow: var(--shadow-sm);
        margin-top: 20px;
    }
    .info-card h4 {
        font-family: var(--font-display);
        font-size: 1rem; font-weight: 700;
        color: var(--navy); margin-bottom: 14px;
    }
    .info-row {
        display: flex; justify-content: space-between;
        padding: 9px 0; border-bottom: 1px solid var(--gray-light);
        font-size: .875rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-row .key { color: var(--gray); }
    .info-row .val { font-weight: 600; color: var(--navy); }
</style>
@endpush

@section('content')
<div class="page-bg">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb-bar">
        <a href="/">Beranda</a>
        <span class="sep">›</span>
        <a href="/kos">Cari Kos</a>
        <span class="sep">›</span>
        <span class="current">Detail Kos</span>
    </div>

    <div class="detail-wrap">
        <div class="detail-grid">

            {{-- LEFT --}}
            <div>
                <div class="main-photo">
                    <img id="mainPhoto"
                         src="{{ $kos->fotoKos->first()?->url_foto ?? 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=900&q=80' }}"
                         alt="{{ $kos->nama_kos ?? 'Foto Kos' }}">
                </div>
                <div class="thumb-row">
                    @if(isset($kos) && $kos->fotoKos->count())
                        @foreach($kos->fotoKos->take(4) as $i => $foto)
                        <div class="thumb {{ $i==0?'active':'' }}" onclick="switchPhoto('{{ $foto->url_foto }}', this)">
                            <img src="{{ $foto->url_foto }}" alt="">
                        </div>
                        @endforeach
                        @if($kos->fotoKos->count() > 4)
                        <div class="thumb thumb-more">+{{ $kos->fotoKos->count()-4 }}</div>
                        @endif
                    @else
                        @for($i=0;$i<4;$i++)
                        <div class="thumb {{ $i==0?'active':'' }}" onclick="switchPhoto('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=400&q=60', this)">
                            <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=400&q=60" alt="">
                        </div>
                        @endfor
                        <div class="thumb thumb-more">+6</div>
                    @endif
                </div>

                <h1 class="kos-name">{{ $kos->nama_kos ?? 'Kos JatiNewYork' }}</h1>
                <div class="kos-location">
                    <i class="fas fa-location-dot"></i>
                    {{ $kos->alamat ?? 'Jl. Hegarmanah, Jatinangor, Sumedang' }}
                </div>
                <div class="kos-rating">
                    <i class="fas fa-star"></i>
                    <strong>{{ $kos->rating_rata2 ?? '5.0' }}</strong>
                    <span>({{ $kos->total_review ?? 0 }} Review)</span>
                </div>
                <hr class="kos-divider">

                <div class="tab-nav">
                    <button class="tab-btn active" onclick="switchTab('deskripsi', this)">Deskripsi</button>
                    <button class="tab-btn" onclick="switchTab('fasilitas', this)">Fasilitas</button>
                    <button class="tab-btn" onclick="switchTab('lokasi', this)">Lokasi</button>
                    <button class="tab-btn" onclick="switchTab('aturan', this)">Aturan Kos</button>
                </div>
                <div id="tab-deskripsi" class="tab-content active">
                    <p>{{ $kos->deskripsi ?? 'Kos yang nyaman dan strategis dekat kampus.' }}</p>
                </div>
                <div id="tab-fasilitas" class="tab-content">
                    @if(isset($kos) && $kos->detailFasilitas->count())
                        @foreach($kos->detailFasilitas as $df)
                        <div style="padding:8px 0;font-size:.9rem;">• {{ $df->fasilitas?->nama_fasilitas }} — {{ $df->keterangan }}</div>
                        @endforeach
                    @else
                        <p>WiFi, AC, Kamar Mandi Dalam, Parkir Motor</p>
                    @endif
                </div>
                <div id="tab-lokasi" class="tab-content">
                    <p>{{ $kos->lokasi?->kecamatan }}, {{ $kos->lokasi?->kota }}, {{ $kos->lokasi?->provinsi }}</p>
                </div>
                <div id="tab-aturan" class="tab-content">
                    <p>{{ $kos->aturan_kos ?? 'Tidak ada aturan khusus.' }}</p>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="detail-right">
                <div class="price-card">
                    <div class="price-label">MULAI DARI</div>
                    <div class="price-main">
                        Rp {{ number_format($kos->harga_min ?? 1250000, 0, ',', '.') }}
                        <small>/bulan</small>
                    </div>
                    <div class="avail-badge">
                        <i class="fas fa-circle-check"></i>
                        {{ $kos->jumlah_kamar_tersedia ?? 5 }} Kamar Tersedia Sekarang
                    </div>
                    {{-- Fasilitas dari database --}}
                    <div class="facilities-row">
                        @if(isset($kos) && $kos->detailFasilitas->count())
                            @foreach($kos->detailFasilitas->take(4) as $df)
                            <div class="fac-item">
                                <i class="fas fa-check"></i> {{ $df->fasilitas?->nama_fasilitas }}
                            </div>
                            @endforeach
                        @else
                            <div class="fac-item"><i class="fas fa-wifi"></i> WiFi</div>
                            <div class="fac-item"><i class="fas fa-snowflake"></i> AC</div>
                            <div class="fac-item"><i class="fas fa-toilet"></i> Kamar Mandi Dalam</div>
                        @endif
                    </div>

                    {{-- TOMBOL WISHLIST --}}
                    @auth
                        @php
                            $sudahWishlist = auth()->user()->wishlist
                                ->where('id_kos', $kos->id_kos ?? '')
                                ->count() > 0;
                        @endphp
                        @if($sudahWishlist)
                            <form method="POST" action="/wishlist/{{ auth()->user()->wishlist->where('id_kos', $kos->id_kos)->first()?->id_favorit }}" style="margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-wishlist" style="background:var(--gold-pale);color:var(--navy);">
                                    <i class="fas fa-heart" style="color:var(--red);"></i> Sudah di Wishlist
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('wishlist.store') }}" style="margin:0;">
                                @csrf
                                <input type="hidden" name="id_kos" value="{{ $kos->id_kos ?? '' }}">
                                <button type="submit" class="btn-wishlist">
                                    <i class="far fa-heart"></i> Tambah Ke Wishlist
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="/login" class="btn-wishlist" style="display:flex;align-items:center;justify-content:center;gap:8px;">
                            <i class="far fa-heart"></i> Login untuk Simpan Wishlist
                        </a>
                    @endauth
                </div>

                <div class="info-card">
                    <h4>Informasi Kost</h4>
                    <div class="info-row"><span class="key">Tipe Kos</span><span class="val">{{ $kos->tipe_kos ?? '—' }}</span></div>
                    <div class="info-row"><span class="key">Jumlah Kamar</span><span class="val">{{ $kos->jumlah_kamar ?? '—' }} Unit</span></div>
                    <div class="info-row"><span class="key">Luas Kamar</span><span class="val">{{ $kos->luas_kamar ?? '—' }}</span></div>
                    <div class="info-row"><span class="key">Kamar Mandi</span><span class="val">{{ $kos->jenis_km ?? 'Dalam' }}</span></div>
                    <div class="info-row"><span class="key">Parkir</span><span class="val">{{ $kos->parkir ?? 'Motor' }}</span></div>
                    <div class="info-row"><span class="key">Keamanan</span><span class="val">{{ $kos->keamanan ?? 'CCTV & Penjaga' }}</span></div>
                </div>
            </div>{{-- end detail-right --}}

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function switchPhoto(src, el) {
    document.getElementById('mainPhoto').src = src;
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}
function switchTab(name, el) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-'+name).classList.add('active');
    el.classList.add('active');
}
</script>
@endpush