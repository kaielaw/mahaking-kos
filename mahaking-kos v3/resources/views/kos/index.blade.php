@extends('layouts.app')

@section('title', 'Cari Kos – Mahaking Kos')

@push('styles')
<style>
    .page-wrapper-inner { background: #f0ece4; }

    /* SEARCH HERO BANNER */
    .search-hero {
        position: relative;
        background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=1400&q=80');
        background-size: cover; background-position: center;
        padding: 56px 80px 48px;
    }
    .search-hero::before {
        content: ''; position: absolute; inset: 0;
        background: rgba(20,28,50,.72);
    }
    .search-hero-inner { position: relative; z-index: 2; }
    .breadcrumb {
        display: flex; align-items: center; gap: 8px;
        font-size: .83rem; color: rgba(255,255,255,.6);
        margin-bottom: 28px;
    }
    .breadcrumb a { color: rgba(255,255,255,.6); }
    .breadcrumb a:hover { color: var(--gold); }
    .breadcrumb .sep { color: rgba(255,255,255,.4); }
    .breadcrumb .current { color: var(--white); font-weight: 600; }

    .search-bar {
        display: flex; align-items: center;
        background: var(--white); border-radius: 50px;
        padding: 8px 8px 8px 24px; max-width: 680px;
        box-shadow: 0 8px 32px rgba(0,0,0,.25);
        margin-bottom: 20px;
    }
    .search-bar i { color: var(--gray); margin-right: 10px; }
    .search-bar input {
        flex: 1; border: none; background: transparent;
        font-family: var(--font-body); font-size: .95rem;
        color: var(--navy); outline: none;
    }
    .search-bar input::placeholder { color: #a0a0b0; }
    .btn-search {
        background: var(--gold); color: var(--navy);
        border: none; border-radius: 50px;
        padding: 11px 26px; font-size: .9rem; font-weight: 700;
        cursor: pointer; white-space: nowrap; transition: background .2s;
    }
    .btn-search:hover { background: var(--gold-light); }

    /* FILTER ROW */
    .filter-row {
        display: flex; align-items: center; gap: 10px;
        flex-wrap: wrap;
    }
    .filter-btn {
        display: flex; align-items: center; gap: 6px;
        padding: 9px 18px;
        background: rgba(255,255,255,.12);
        border: 1.5px solid rgba(255,255,255,.3);
        color: var(--white); border-radius: 8px;
        font-family: var(--font-body); font-size: .85rem;
        font-weight: 500; cursor: pointer;
        transition: all .2s;
    }
    .filter-btn:hover { background: rgba(255,255,255,.2); }
    .filter-select {
        padding: 9px 14px;
        background: rgba(255,255,255,.12);
        border: 1.5px solid rgba(255,255,255,.3);
        color: var(--white); border-radius: 8px;
        font-family: var(--font-body); font-size: .85rem;
        cursor: pointer; outline: none;
    }
    .filter-select option { background: var(--navy); color: var(--white); }

    /* RESULTS AREA */
    .results-area { padding: 40px 80px 72px; }
    .results-count { font-size: .9rem; color: var(--gray); margin-bottom: 28px; }
    .results-count strong { color: var(--navy); }

    .kos-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .kos-card {
        background: var(--white); border-radius: var(--radius);
        overflow: hidden; box-shadow: var(--shadow-sm);
        transition: transform .25s, box-shadow .25s;
        cursor: pointer; display: block;
        color: inherit;
    }
    .kos-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-lg); }
    .kos-card-img {
        height: 200px; position: relative; overflow: hidden;
        background: var(--navy);
    }
    .kos-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
    .kos-card:hover .kos-card-img img { transform: scale(1.05); }
    .kos-type-badge {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 8px 14px;
        background: linear-gradient(to top, rgba(20,28,50,.85) 0%, transparent 100%);
    }
    .kos-type-pill {
        display: inline-block;
        background: var(--gold); color: var(--navy);
        font-size: .68rem; font-weight: 700;
        padding: 2px 10px; border-radius: 50px;
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

    /* EMPTY STATE */
    .empty-state {
        text-align: center; padding: 80px 20px; color: var(--gray);
        grid-column: 1 / -1;
    }
    .empty-state i { font-size: 3rem; color: var(--gold-pale); margin-bottom: 16px; display: block; }

    /* PAGINATION */
    .pagination-wrap {
        display: flex; justify-content: center;
        align-items: center; gap: 8px; margin-top: 48px;
    }
    .page-btn {
        width: 40px; height: 40px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: .88rem; font-weight: 600;
        border: 1.5px solid var(--gray-light);
        background: var(--white); color: var(--navy);
        cursor: pointer; transition: all .2s;
        text-decoration: none;
    }
    .page-btn:hover, .page-btn.active {
        background: var(--gold); border-color: var(--gold);
        color: var(--navy);
    }
    .page-btn.nav { font-size: .75rem; }
    .page-dots { color: var(--gray); font-size: .9rem; }
</style>
@endpush

@section('content')
<div class="page-wrapper-inner">

    {{-- SEARCH HERO --}}
    <div class="search-hero">
        <div class="search-hero-inner">
            <div class="breadcrumb">
                <a href="/">Beranda</a>
                <span class="sep">›</span>
                <span class="current">Cari Kos</span>
            </div>

            <form class="search-bar" action="/kos" method="GET" style="max-width:680px;">
                <i class="fas fa-location-dot"></i>
                <input type="text" name="q" placeholder="Masukkan nama kos, daerah, kecamatan"
                       value="{{ request('q') }}">
                <button type="submit" class="btn-search">Cari Sekarang</button>
            </form>

            <div class="filter-row">
                <button class="filter-btn">
                    <i class="fas fa-sliders" style="font-size:.8rem;"></i> Filter
                </button>
                <select name="jenis" class="filter-select" form="filterForm">
                    <option value="">Semua Jenis</option>
                    <option value="putra" {{ request('jenis')=='putra'?'selected':'' }}>Putra</option>
                    <option value="putri" {{ request('jenis')=='putri'?'selected':'' }}>Putri</option>
                    <option value="campur" {{ request('jenis')=='campur'?'selected':'' }}>Campur</option>
                </select>
                <select name="harga_max" class="filter-select" form="filterForm">
                    <option value="">Harga Max</option>
                    <option value="1000000" {{ request('harga_max')=='1000000'?'selected':'' }}>≤ Rp 1.000.000</option>
                    <option value="2000000" {{ request('harga_max')=='2000000'?'selected':'' }}>≤ Rp 2.000.000</option>
                    <option value="3000000" {{ request('harga_max')=='3000000'?'selected':'' }}>≤ Rp 3.000.000</option>
                    <option value="5000000" {{ request('harga_max')=='5000000'?'selected':'' }}>≤ Rp 5.000.000</option>
                </select>
                <select name="fasilitas" class="filter-select" form="filterForm">
                    <option value="">Fasilitas</option>
                    <option value="wifi">WiFi</option>
                    <option value="ac">AC</option>
                    <option value="km_dalam">Kamar Mandi Dalam</option>
                </select>
                <select name="sort" class="filter-select" form="filterForm">
                    <option value="">Urutkan</option>
                    <option value="harga_asc" {{ request('sort')=='harga_asc'?'selected':'' }}>Harga Terendah</option>
                    <option value="harga_desc" {{ request('sort')=='harga_desc'?'selected':'' }}>Harga Tertinggi</option>
                    <option value="rating" {{ request('sort')=='rating'?'selected':'' }}>Rating Terbaik</option>
                </select>
            </div>
            <form id="filterForm" action="/kos" method="GET"></form>
        </div>
    </div>

    {{-- RESULTS --}}
    <div class="results-area">
        @if(isset($dataKos) && $dataKos->count())
            <p class="results-count">Ditemukan <strong>{{ $dataKos->total() }}</strong> kos</p>
        @endif

        <div class="kos-grid">
            @isset($dataKos)
                @forelse($dataKos as $kos)
                <a href="/kos/{{ $kos->id_kos }}" class="kos-card">
                    <div class="kos-card-img">
                        <img src="{{ $kos->fotoKos->first()?->url_foto ?? 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&q=80' }}"
                             alt="{{ $kos->nama_kos }}">
                        <div class="kos-type-badge">
                            <span class="kos-type-pill">{{ strtoupper($kos->jenis_kos) }} – {{ strtoupper($kos->lokasi?->kecamatan) }}</span>
                        </div>
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
                @empty
                <div class="empty-state">
                    <i class="fas fa-house-circle-xmark"></i>
                    <p>Tidak ada kos yang ditemukan.</p>
                    <a href="/kos" style="color:var(--gold);font-weight:600;margin-top:8px;display:inline-block;">Reset Pencarian</a>
                </div>
                @endforelse
            @else
                {{-- Placeholder --}}
                @for($i = 0; $i < 6; $i++)
                <div class="kos-card">
                    <div class="kos-card-img" style="background:#2a3555;">
                        <div class="kos-type-badge">
                            <span class="kos-type-pill">{{ ['CAMPUR','PUTRI','PUTRA'][$i%3] }} – JATINANGOR</span>
                        </div>
                    </div>
                    <div class="kos-card-body">
                        <div class="kos-card-name">{{ ['Kos JatiNewYork','Kos Putri Tidur','Kos Putra Laut','Kos Premium A','Kos Nyaman B','Kos Elit C'][$i] }}</div>
                        <div class="kos-card-rating">
                            <i class="fas fa-star star"></i>
                            <strong>{{ ['5.0','4.9','4.8','4.7','4.9','5.0'][$i] }}</strong>
                            <span class="count">({{ [500,250,125,80,200,150][$i] }} Review)</span>
                        </div>
                        <div class="kos-card-price">Rp {{ number_format([5000000,2500000,1250000,1800000,2000000,3000000][$i],0,',','.')}} <small>/bulan</small></div>
                    </div>
                </div>
                @endfor
            @endisset
        </div>

        {{-- PAGINATION --}}
        @isset($dataKos)
            @if($dataKos->hasPages())
            <div class="pagination-wrap">
                @if($dataKos->onFirstPage())
                    <span class="page-btn nav" style="opacity:.4;">‹</span>
                @else
                    <a href="{{ $dataKos->previousPageUrl() }}" class="page-btn nav">‹</a>
                @endif

                @foreach($dataKos->getUrlRange(1, $dataKos->lastPage()) as $page => $url)
                    @if($page == $dataKos->currentPage())
                        <span class="page-btn active">{{ $page }}</span>
                    @elseif($page <= 3 || $page == $dataKos->lastPage())
                        <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                    @elseif($page == 4)
                        <span class="page-dots">...</span>
                    @endif
                @endforeach

                @if($dataKos->hasMorePages())
                    <a href="{{ $dataKos->nextPageUrl() }}" class="page-btn nav">›</a>
                @else
                    <span class="page-btn nav" style="opacity:.4;">›</span>
                @endif
            </div>
            @endif
        @else
            <div class="pagination-wrap">
                <span class="page-btn nav">‹</span>
                <span class="page-btn active">1</span>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">3</a>
                <span class="page-dots">...</span>
                <a href="#" class="page-btn">8</a>
                <a href="#" class="page-btn nav">›</a>
            </div>
        @endisset
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Auto-submit filter on select change
    document.querySelectorAll('.filter-select').forEach(sel => {
        sel.addEventListener('change', () => {
            document.getElementById('filterForm').submit();
        });
    });
</script>
@endpush