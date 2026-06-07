@extends('layouts.dashboard')

@section('title', 'Tambah Kamar')

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
    .req { color:var(--red); }

    .status-toggle { display:flex;gap:10px; }
    .status-toggle label { flex:1;padding:12px;border-radius:8px;border:2px solid var(--gray-light);text-align:center;cursor:pointer;transition:all .2s;font-size:.88rem;font-weight:600;display:flex;align-items:center;justify-content:center;gap:8px;color:var(--gray); }
    .status-toggle input[type=radio] { display:none; }
    .status-toggle input[value=tersedia]:checked + label { border-color:#2e7d32;background:#e8f5e9;color:#2e7d32; }
    .status-toggle input[value=terisi]:checked  + label { border-color:var(--red);background:#ffebee;color:var(--red); }

    /* Fasilitas checkboxes */
    .fas-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:8px; }
    .fas-item { display:flex;align-items:center;gap:8px;font-size:.85rem;cursor:pointer;padding:8px 12px;border:1.5px solid var(--gray-light);border-radius:8px;transition:all .2s; }
    .fas-item:hover { border-color:var(--gold); }
    .fas-item input[type=checkbox] { accent-color:var(--gold); }

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

<h2>Tambah Kamar Baru</h2>

@if($errors->any())
    <div style="background:#ffebee;color:#c62828;border-radius:8px;padding:12px 16px;margin-bottom:20px;font-size:.85rem;">
        @foreach($errors->all() as $err)<div>• {{ $err }}</div>@endforeach
    </div>
@endif

<div class="form-card fade-up">
    <form method="POST" action="{{ route('owner.kamar.store') }}">
        @csrf

        <div class="form-section-title"><i class="fas fa-building"></i> Data Kamar</div>

        <div class="form-group">
            <label class="form-label">Pilih Kos <span class="req">*</span></label>
            <select name="id_kos" class="form-control" required>
                <option value="" disabled selected>-- Pilih kos --</option>
                @isset($dataKos)
                    @foreach($dataKos as $kos)
                    <option value="{{ $kos->id_kos }}" {{ old('id_kos')==$kos->id_kos?'selected':'' }}>
                        {{ $kos->nama_kos }}
                    </option>
                    @endforeach
                @endisset
            </select>
        </div>

        <div class="form-row">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Nomor / Nama Kamar</label>
                <input type="text" name="nomor_kamar" class="form-control"
                       placeholder="Contoh: 101 atau Kamar A1"
                       value="{{ old('nomor_kamar') }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Ukuran Kamar</label>
                <input type="text" name="ukuran" class="form-control"
                       placeholder="Contoh: 3x4 Meter"
                       value="{{ old('ukuran') }}">
            </div>
        </div>

        <div class="form-section-title" style="margin-top:20px;"><i class="fas fa-tag"></i> Harga & Status</div>

        <div class="form-row">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Harga per Bulan (Rp) <span class="req">*</span></label>
                <input type="number" name="harga_per_bulan" class="form-control"
                       placeholder="Contoh: 750000"
                       value="{{ old('harga_per_bulan') }}" required>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Tipe Kamar</label>
                <input type="text" name="tipe_kamar" class="form-control"
                       placeholder="Contoh: AC, Kipas, VIP"
                       value="{{ old('tipe_kamar') }}">
            </div>
        </div>

        <div class="form-group" style="margin-top:16px;">
            <label class="form-label">Status Kamar <span class="req">*</span></label>
            <div class="status-toggle">
                <input type="radio" name="ketersediaan_kamar" id="st_tersedia"
                       value="tersedia" {{ old('ketersediaan_kamar','tersedia')==='tersedia'?'checked':'' }}>
                <label for="st_tersedia">
                    <i class="fas fa-circle-check"></i> Tersedia
                </label>
                <input type="radio" name="ketersediaan_kamar" id="st_terisi"
                       value="terisi" {{ old('ketersediaan_kamar')==='terisi'?'checked':'' }}>
                <label for="st_terisi">
                    <i class="fas fa-circle-xmark"></i> Penuh / Tersewa
                </label>
            </div>
        </div>

        {{-- FASILITAS --}}
        <div class="form-section-title" style="margin-top:20px;"><i class="fas fa-list-check"></i> Fasilitas Kamar</div>

        <div class="fas-grid">
            @foreach(['WiFi','AC','Kamar Mandi Dalam','Kasur','Lemari','Meja Belajar','Kipas Angin','TV','Water Heater','Parkir Motor','CCTV','Dapur Bersama'] as $fas)
            <label class="fas-item">
                <input type="checkbox" name="fasilitas[]" value="{{ $fas }}"
                       {{ in_array($fas, old('fasilitas', [])) ? 'checked' : '' }}>
                {{ $fas }}
            </label>
            @endforeach
        </div>

        <div style="margin-top:20px;">
            <button type="submit" class="btn-submit">
                <i class="fas fa-plus"></i> Simpan Kamar
            </button>
            <a href="{{ route('owner.kamar.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection