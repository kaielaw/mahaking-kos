@extends('layouts.dashboard')

@section('title', 'Edit Kamar')

@section('sidebar_nav')
    <a href="{{ route('owner.index') }}"><i class="fas fa-chart-pie"></i><span class="nav-label">Dashboard</span></a>
    <a href="{{ route('owner.kamar.index') }}" class="active"><i class="fas fa-door-open"></i><span class="nav-label">Data Kamar</span></a>
    <a href="{{ route('owner.kos.index') }}"><i class="fas fa-building"></i><span class="nav-label">Data Kos</span></a>
    <a href="{{ route('owner.profile.show') }}"><i class="fas fa-user-tie"></i><span class="nav-label">Profile Owner</span></a>
@endsection

@push('styles')
<style>
    .form-card { background:#fdf9f5;border:1.5px solid var(--gray-light);border-radius:var(--radius);padding:32px 36px;max-width:680px; }
    .form-section-title { font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--gold);margin:24px 0 14px;display:flex;align-items:center;gap:8px;padding-top:20px;border-top:1px solid var(--gray-light); }
    .form-section-title:first-child { margin-top:0;padding-top:0;border-top:none; }
    .form-control { background:#f5f0e8; }
    .form-control:focus { background:var(--white); }

    /* STATUS TOGGLE — fix: pakai radio buttons yang hidden */
    .status-toggle { display:flex;gap:10px; }
    .status-toggle label {
        flex:1;padding:12px;border-radius:8px;
        border:2px solid var(--gray-light);text-align:center;
        cursor:pointer;transition:all .2s;font-size:.88rem;font-weight:600;
        display:flex;align-items:center;justify-content:center;gap:8px;
        color:var(--gray);
    }
    .status-toggle input[type=radio] { display:none; }
    .status-toggle input[value=tersedia]:checked + label { border-color:#2e7d32;background:#e8f5e9;color:#2e7d32; }
    .status-toggle input[value=terisi]:checked + label  { border-color:var(--red);background:#ffebee;color:var(--red); }

    .btn-submit { background:var(--gold);color:var(--navy);border:none;border-radius:var(--radius-sm);padding:13px 36px;font-size:.9rem;font-weight:700;cursor:pointer;transition:background .2s;margin-top:8px; }
    .btn-submit:hover { background:var(--gold-light); }
    .btn-cancel { background:none;border:1.5px solid var(--gray-light);color:var(--gray);border-radius:var(--radius-sm);padding:13px 28px;font-size:.9rem;font-weight:600;cursor:pointer;margin-top:8px;margin-left:10px;transition:all .2s;text-decoration:none;display:inline-block; }
    .btn-cancel:hover { border-color:var(--red);color:var(--red); }
    .back-link { display:inline-flex;align-items:center;gap:6px;font-size:.85rem;color:var(--gray);margin-bottom:20px;transition:color .2s;text-decoration:none; }
    .back-link:hover { color:var(--gold); }
</style>
@endpush

@section('content')
<a href="{{ route('owner.kamar.index') }}" class="back-link">
    <i class="fas fa-arrow-left"></i> Kembali ke Data Kamar
</a>

<h2>Edit Kamar</h2>

@if($errors->any())
    <div style="background:#ffebee;color:#c62828;border-radius:8px;padding:12px 16px;margin-bottom:20px;font-size:.85rem;">
        @foreach($errors->all() as $err)<div>• {{ $err }}</div>@endforeach
    </div>
@endif

<div class="form-card fade-up">
    <form method="POST" action="{{ route('owner.kamar.update', $kamar->id_kamar) }}">
        @csrf @method('PUT')

        <div class="form-section-title"><i class="fas fa-building"></i> Data Kamar</div>

        <div class="form-group">
            <label class="form-label">Nama Kos</label>
            <input type="text" class="form-control"
                   value="{{ $kamar->kos?->nama_kos ?? '—' }}" disabled
                   style="opacity:.65;cursor:not-allowed;">
        </div>

        <div class="form-row">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Nomor / Nama Kamar</label>
                <input type="text" name="nomor_kamar" class="form-control"
                       placeholder="Contoh: 101 atau Kamar A1"
                       value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Ukuran Kamar</label>
                <input type="text" name="ukuran" class="form-control"
                       placeholder="Contoh: 3x4 Meter"
                       value="{{ old('ukuran', $kamar->ukuran) }}">
            </div>
        </div>

        <div class="form-section-title" style="margin-top:20px;"><i class="fas fa-tag"></i> Harga & Status</div>

        <div class="form-group">
            <label class="form-label">Harga per Bulan (Rp) <span style="color:var(--red);">*</span></label>
            <input type="number" name="harga_per_bulan" class="form-control"
                   value="{{ old('harga_per_bulan', $kamar->harga_per_bulan) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Tipe Kamar</label>
            <input type="text" name="tipe_kamar" class="form-control"
                   placeholder="Contoh: AC, Kipas, VIP"
                   value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}">
        </div>

        <div class="form-group">
            <label class="form-label">Status Kamar <span style="color:var(--red);">*</span></label>
            @php $currentStatus = old('ketersediaan_kamar', $kamar->ketersediaan_kamar ?? 'tersedia'); @endphp
            <div class="status-toggle">
                <input type="radio" name="ketersediaan_kamar" id="st_tersedia"
                       value="tersedia" {{ $currentStatus === 'tersedia' ? 'checked' : '' }}>
                <label for="st_tersedia">
                    <i class="fas fa-circle-check"></i> Tersedia
                </label>

                <input type="radio" name="ketersediaan_kamar" id="st_terisi"
                       value="terisi" {{ $currentStatus === 'terisi' ? 'checked' : '' }}>
                <label for="st_terisi">
                    <i class="fas fa-circle-xmark"></i> Penuh / Tersewa
                </label>
            </div>
        </div>

        <div style="margin-top:20px;">
            <button type="submit" class="btn-submit">
                <i class="fas fa-floppy-disk"></i> Simpan Perubahan
            </button>
            <a href="{{ route('owner.kamar.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection