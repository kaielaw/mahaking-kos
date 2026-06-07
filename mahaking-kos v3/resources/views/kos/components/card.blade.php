{{--
    KOMPONEN CARD KOS - resources/views/kos/components/card.blade.php
    Cara pakai: @include('kos.components.card', ['kos' => $kos])
--}}
<a href="/kos/{{ $kos->id_kos }}" class="kos-card">
    <div class="kos-card-img">
        <img src="{{ $kos->fotoKos->first()?->url_foto ?? 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&q=80' }}"
             alt="{{ $kos->nama_kos }}"
             loading="lazy">
        <div class="kos-type-badge">
            <span class="kos-type-pill">
                {{ strtoupper($kos->jenis_kos) }} — {{ strtoupper($kos->lokasi?->kecamatan ?? '') }}
            </span>
        </div>
        @if(($kos->jumlah_kamar_tersedia ?? 0) == 0)
            <div style="position:absolute;inset:0;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;">
                <span style="background:var(--red);color:#fff;font-size:.75rem;font-weight:700;padding:6px 14px;border-radius:50px;letter-spacing:.5px;">PENUH</span>
            </div>
        @endif
    </div>
    <div class="kos-card-body">
        <div class="kos-card-name">{{ $kos->nama_kos }}</div>
        <div class="kos-card-rating">
            <i class="fas fa-star" style="color:var(--gold);font-size:.8rem;"></i>
            <strong>{{ $kos->rating_rata2 ?? '—' }}</strong>
            <span style="color:var(--gray);">({{ $kos->total_review ?? 0 }} Review)</span>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;">
            <div class="kos-card-price">
                Rp {{ number_format($kos->harga_min, 0, ',', '.') }}
                <small style="font-weight:400;color:var(--gray);font-size:.78rem;">/bulan</small>
            </div>
            <span style="font-size:.75rem;color:{{ ($kos->jumlah_kamar_tersedia??0)>0?'#2e7d32':'var(--red)' }};font-weight:600;">
                {{ ($kos->jumlah_kamar_tersedia??0) > 0 ? $kos->jumlah_kamar_tersedia.' kamar' : 'Penuh' }}
            </span>
        </div>
    </div>
</a>