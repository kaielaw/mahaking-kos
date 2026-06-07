@extends('layouts.dashboard')

@section('title', 'Tambah Kos Baru')

@section('sidebar_nav')
    <a href="/owner"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
    <a href="/owner/kamar"><i class="fas fa-door-open"></i><span>Data Kamar</span></a>
    <a href="/owner/kos" class="active"><i class="fas fa-building"></i><span>Data Kos</span></a>
    <a href="/owner/profile"><i class="fas fa-user-tie"></i><span>Profile Owner</span></a>
@endsection

@push('styles')
<style>
    .form-card { background:#fdf9f5;border:1.5px solid var(--gray-light);border-radius:var(--radius);padding:32px 36px;max-width:820px; }
    .form-section-title { font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--gold);margin:28px 0 16px;display:flex;align-items:center;gap:8px;padding-top:24px;border-top:1px solid var(--gray-light); }
    .form-section-title:first-child { margin-top:0;padding-top:0;border-top:none; }
    .form-row-3 { display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px; }
    .form-control { background:#f5f0e8; }
    .form-control:focus { background:var(--white); }
    textarea.form-control { resize:vertical;min-height:90px; }
    .req { color:var(--red); }
    .foto-upload-area { border:2px dashed var(--gold-pale);border-radius:var(--radius-sm);padding:28px;text-align:center;cursor:pointer;transition:border-color .2s,background .2s;background:#faf8f5;display:block; }
    .foto-upload-area:hover { border-color:var(--gold);background:var(--gold-pale); }
    .foto-upload-area i { font-size:2rem;color:var(--gold-pale);margin-bottom:10px;display:block; }
    .foto-upload-area p { font-size:.85rem;color:var(--gray); }
    #fotoKosInput { display:none; }
    .btn-submit { background:var(--gold);color:var(--navy);border:none;border-radius:var(--radius-sm);padding:13px 36px;font-size:.9rem;font-weight:700;cursor:pointer;transition:background .2s;margin-top:8px; }
    .btn-submit:hover { background:var(--gold-light); }
    .btn-cancel { background:none;border:1.5px solid var(--gray-light);color:var(--gray);border-radius:var(--radius-sm);padding:13px 28px;font-size:.9rem;font-weight:600;cursor:pointer;margin-top:8px;margin-left:10px;transition:all .2s; }
    .btn-cancel:hover { border-color:var(--red);color:var(--red); }
    .back-link { display:inline-flex;align-items:center;gap:6px;font-size:.85rem;color:var(--gray);margin-bottom:20px;transition:color .2s; }
    .back-link:hover { color:var(--gold); }
</style>
@endpush

@section('content')
<a href="{{ route('owner.kos.index') }}" class="back-link">
    <i class="fas fa-arrow-left"></i> Kembali ke Data Kos
</a>

<h2>Tambah Kos Baru</h2>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div style="background:#ffebee;color:#c62828;border-radius:8px;padding:12px 16px;margin-bottom:20px;font-size:.85rem;">
        @foreach($errors->all() as $err)<div>• {{ $err }}</div>@endforeach
    </div>
@endif

<div class="form-card fade-up">
    <form method="POST" action="{{ route('owner.kos.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- INFO DASAR --}}
        <div class="form-section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Kos</div>

        <div class="form-group">
            <label class="form-label">Nama Kos <span class="req">*</span></label>
            <input type="text" name="nama_kos" class="form-control"
                   placeholder="Contoh: Kos Mahaking Putri Eksklusif"
                   value="{{ old('nama_kos') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Jenis Kos <span class="req">*</span></label>
                <select name="jenis_kos" class="form-control" required>
                    <option value="" disabled {{ old('jenis_kos') ? '' : 'selected' }}>Pilih jenis</option>
                    <option value="putra"  {{ old('jenis_kos')=='putra'?'selected':'' }}>Putra</option>
                    <option value="putri"  {{ old('jenis_kos')=='putri'?'selected':'' }}>Putri</option>
                    <option value="campur" {{ old('jenis_kos')=='campur'?'selected':'' }}>Campur</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Tipe Kos <span class="req">*</span></label>
                <input type="text" name="tipe_kos" class="form-control"
                       placeholder="Contoh: Eksklusif, Reguler, Standar"
                       value="{{ old('tipe_kos') }}" required>
            </div>
        </div>

        <div class="form-group" style="margin-top:16px;">
            <label class="form-label">Deskripsi <span class="req">*</span></label>
            <textarea name="deskripsi" class="form-control"
                      placeholder="Deskripsikan kos Anda secara lengkap..." required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Aturan Kos <span class="req">*</span></label>
            <textarea name="aturan_kos" class="form-control" rows="3"
                      placeholder="Contoh: Tidak boleh membawa tamu menginap, tamu hanya sampai jam 21.00..." required>{{ old('aturan_kos') }}</textarea>
        </div>

        {{-- LOKASI --}}
        <div class="form-section-title"><i class="fas fa-location-dot"></i> Lokasi</div>

        <div class="form-group">
            <label class="form-label">Alamat Lengkap <span class="req">*</span></label>
            <input type="text" name="alamat" class="form-control"
                   placeholder="Contoh: Jl. Hegarmanah No. 12, RT 03/RW 05"
                   value="{{ old('alamat') }}" required>
        </div>

        <div class="form-row-3">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control"
                       placeholder="Jatinangor" value="{{ old('kecamatan') }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Kota/Kabupaten</label>
                <input type="text" name="kota" class="form-control"
                       placeholder="Sumedang" value="{{ old('kota') }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Provinsi</label>
                <input type="text" name="provinsi" class="form-control"
                       placeholder="Jawa Barat" value="{{ old('provinsi') }}">
            </div>
        </div>

        {{-- HARGA & KAMAR --}}
        <div class="form-section-title" style="margin-top:28px;"><i class="fas fa-tag"></i> Harga & Kamar</div>

        <div class="form-row">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Harga Minimum (Rp) <span class="req">*</span></label>
                <input type="number" name="harga_min" class="form-control"
                       placeholder="Contoh: 750000"
                       value="{{ old('harga_min') }}" required>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Harga Maksimum (Rp)</label>
                <input type="number" name="harga_max" class="form-control"
                       placeholder="Contoh: 1500000"
                       value="{{ old('harga_max') }}">
            </div>
        </div>

        <div class="form-group" style="margin-top:16px;">
            <label class="form-label">Jumlah Total Kamar <span class="req">*</span></label>
            <input type="number" name="jumlah_kamar" class="form-control"
                   placeholder="Contoh: 15"
                   value="{{ old('jumlah_kamar') }}" required style="max-width:200px;">
        </div>

        {{-- FASILITAS --}}
        <div class="form-section-title" style="margin-top:28px;"><i class="fas fa-list-check"></i> Fasilitas Kos</div>
        <p style="font-size:.82rem;color:var(--gray);margin-bottom:12px;">Pilih fasilitas yang tersedia di kos ini:</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:8px;">
            @foreach(['WiFi','AC','Kamar Mandi Dalam','Parkir Motor','Parkir Mobil','Dapur Bersama','Laundry','CCTV','Water Heater','Kasur','Lemari','Meja Belajar'] as $fas)
            <label style="display:flex;align-items:center;gap:8px;font-size:.83rem;cursor:pointer;padding:8px 12px;border:1.5px solid var(--gray-light);border-radius:8px;transition:all .2s;background:#faf8f5;"
                   onmouseover="this.style.borderColor='var(--gold)'" onmouseout="this.style.borderColor='var(--gray-light)'">
                <input type="checkbox" name="fasilitas[]" value="{{ $fas }}"
                       {{ in_array($fas, old('fasilitas', [])) ? 'checked' : '' }}
                       style="accent-color:var(--gold);">
                {{ $fas }}
            </label>
            @endforeach
        </div>

        {{-- FOTO --}}
        <div class="form-section-title" style="margin-top:28px;"><i class="fas fa-image"></i> Foto Kos</div>

        <label class="foto-upload-area" for="fotoKosInput">
            <i class="fas fa-cloud-arrow-up"></i>
            <p>Klik untuk upload foto kos<br>
               <span style="font-size:.78rem;color:#bbb;">JPG, PNG, WebP – Maks. 5MB per foto</span>
            </p>
        </label>
        <input type="file" id="fotoKosInput" name="foto_kos[]" accept="image/*" multiple>
        <div id="previewArea" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:12px;"></div>

        <div style="margin-top:28px;">
            <button type="submit" class="btn-submit">
                <i class="fas fa-plus"></i> Simpan Kos
            </button>
            <a href="{{ route('owner.kos.index') }}">
                <button type="button" class="btn-cancel">Batal</button>
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('fotoKosInput').addEventListener('change', function() {
    const preview = document.getElementById('previewArea');
    preview.innerHTML = '';
    [...this.files].forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width:80px;height:60px;object-fit:cover;border-radius:8px;border:2px solid var(--gold-pale);';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush