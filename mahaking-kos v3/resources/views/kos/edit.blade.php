@extends('layouts.dashboard')

@section('title', 'Edit Kos')

@section('sidebar_nav')
    <a href="{{ route('owner.index') }}"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
    <a href="{{ route('owner.kamar.index') }}"><i class="fas fa-door-open"></i><span>Data Kamar</span></a>
    <a href="{{ route('owner.kos.index') }}" class="active"><i class="fas fa-building"></i><span>Data Kos</span></a>
    <a href="{{ route('owner.profile.show') }}"><i class="fas fa-user-tie"></i><span>Profile Owner</span></a>
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
    .existing-photos { display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px; }
    .photo-item { position:relative; }
    .photo-item img { width:80px;height:60px;object-fit:cover;border-radius:8px;border:2px solid var(--gold-pale); }
    .photo-del { position:absolute;top:-6px;right:-6px;width:20px;height:20px;border-radius:50%;background:var(--red);color:#fff;font-size:.65rem;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center; }
    .foto-upload-area { border:2px dashed var(--gold-pale);border-radius:var(--radius-sm);padding:24px;text-align:center;cursor:pointer;transition:border-color .2s,background .2s;background:#faf8f5;display:block; }
    .foto-upload-area:hover { border-color:var(--gold);background:var(--gold-pale); }
    .foto-upload-area i { font-size:1.6rem;color:var(--gold-pale);margin-bottom:8px;display:block; }
    .foto-upload-area p { font-size:.82rem;color:var(--gray); }
    #fotoBaruInput { display:none; }
    .btn-submit { background:var(--gold);color:var(--navy);border:none;border-radius:var(--radius-sm);padding:13px 36px;font-size:.9rem;font-weight:700;cursor:pointer;transition:background .2s;margin-top:8px; }
    .btn-submit:hover { background:var(--gold-light); }
    .btn-cancel { background:none;border:1.5px solid var(--gray-light);color:var(--gray);border-radius:var(--radius-sm);padding:13px 28px;font-size:.9rem;font-weight:600;cursor:pointer;margin-top:8px;margin-left:10px;transition:all .2s;text-decoration:none;display:inline-block; }
    .btn-cancel:hover { border-color:var(--red);color:var(--red); }
    .back-link { display:inline-flex;align-items:center;gap:6px;font-size:.85rem;color:var(--gray);margin-bottom:20px;transition:color .2s;text-decoration:none; }
    .back-link:hover { color:var(--gold); }
</style>
@endpush

@section('content')
<a href="{{ route('owner.kos.index') }}" class="back-link">
    <i class="fas fa-arrow-left"></i> Kembali ke Data Kos
</a>

<h2>Edit Kos</h2>

@if(session('success'))
    <div style="background:#e8f5e9;color:#2e7d32;border-radius:8px;padding:10px 16px;margin-bottom:20px;font-size:.88rem;">
        ✓ {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div style="background:#ffebee;color:#c62828;border-radius:8px;padding:12px 16px;margin-bottom:20px;font-size:.85rem;">
        @foreach($errors->all() as $err)<div>• {{ $err }}</div>@endforeach
    </div>
@endif

<div class="form-card fade-up">
    {{-- action pakai route() dengan parameter id_kos --}}
    <form method="POST"
          action="{{ route('owner.kos.update', $kos->id_kos) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- INFO DASAR --}}
        <div class="form-section-title"><i class="fas fa-info-circle"></i> Informasi Dasar Kos</div>

        <div class="form-group">
            <label class="form-label">Nama Kos <span class="req">*</span></label>
            <input type="text" name="nama_kos" class="form-control"
                   value="{{ old('nama_kos', $kos->nama_kos) }}" required>
        </div>

        <div class="form-row">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Jenis Kos <span class="req">*</span></label>
                <select name="jenis_kos" class="form-control" required>
                    @foreach(['putra','putri','campur'] as $j)
                    <option value="{{ $j }}" {{ old('jenis_kos', $kos->jenis_kos) == $j ? 'selected' : '' }}>
                        {{ ucfirst($j) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Tipe Kos <span class="req">*</span></label>
                <input type="text" name="tipe_kos" class="form-control"
                       value="{{ old('tipe_kos', $kos->tipe_kos) }}" required>
            </div>
        </div>

        <div class="form-group" style="margin-top:16px;">
            <label class="form-label">Deskripsi <span class="req">*</span></label>
            <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $kos->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Aturan Kos <span class="req">*</span></label>
            <textarea name="aturan_kos" class="form-control" rows="3" required>{{ old('aturan_kos', $kos->aturan_kos) }}</textarea>
        </div>

        {{-- LOKASI --}}
        <div class="form-section-title"><i class="fas fa-location-dot"></i> Lokasi</div>

        <div class="form-group">
            <label class="form-label">Alamat Lengkap <span class="req">*</span></label>
            <input type="text" name="alamat" class="form-control"
                   value="{{ old('alamat', $kos->alamat) }}" required>
        </div>

        <div class="form-row-3">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control"
                       value="{{ old('kecamatan', $kos->lokasi?->kecamatan) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Kota/Kabupaten</label>
                <input type="text" name="kota" class="form-control"
                       value="{{ old('kota', $kos->lokasi?->kota) }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Provinsi</label>
                <input type="text" name="provinsi" class="form-control"
                       value="{{ old('provinsi', $kos->lokasi?->provinsi) }}">
            </div>
        </div>

        {{-- HARGA & KAMAR --}}
        <div class="form-section-title" style="margin-top:28px;"><i class="fas fa-tag"></i> Harga & Kamar</div>

        <div class="form-row">
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Harga Minimum (Rp) <span class="req">*</span></label>
                <input type="number" name="harga_min" class="form-control"
                       value="{{ old('harga_min', $kos->harga_min) }}" required>
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Jumlah Total Kamar <span class="req">*</span></label>
                <input type="number" name="jumlah_kamar" class="form-control"
                       value="{{ old('jumlah_kamar', $kos->jumlah_kamar) }}" required>
            </div>
        </div>

        {{-- FOTO --}}
        <div class="form-section-title" style="margin-top:28px;"><i class="fas fa-image"></i> Foto Kos</div>

        {{-- Foto yang sudah ada --}}
        @if($kos->fotoKos->count())
        <p style="font-size:.82rem;color:var(--gray);margin-bottom:10px;">Foto saat ini (klik ✕ untuk hapus):</p>
        <div class="existing-photos" id="existingPhotos">
            @foreach($kos->fotoKos as $foto)
            <div class="photo-item" id="photo-{{ $foto->id_foto }}">
                <img src="{{ $foto->url_foto }}" alt="{{ $foto->caption }}">
                <button type="button" class="photo-del"
                        onclick="markDelete('{{ $foto->id_foto }}')">✕</button>
                <input type="hidden" name="hapus_foto[]"
                       id="del-{{ $foto->id_foto }}" value="{{ $foto->id_foto }}" disabled>
            </div>
            @endforeach
        </div>
        @endif

        <label class="foto-upload-area" for="fotoBaruInput">
            <i class="fas fa-plus"></i>
            <p>Tambah foto baru<br><span style="font-size:.75rem;color:#bbb;">JPG, PNG – Maks. 5MB</span></p>
        </label>
        <input type="file" id="fotoBaruInput" name="foto_kos[]" accept="image/*" multiple>
        <div id="previewArea" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:12px;"></div>

        <div style="margin-top:28px;">
            <button type="submit" class="btn-submit">
                <i class="fas fa-floppy-disk"></i> Simpan Perubahan
            </button>
            <a href="{{ route('owner.kos.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function markDelete(id) {
    const item = document.getElementById('photo-' + id);
    const input = document.getElementById('del-' + id);
    item.style.opacity = '.3';
    item.style.outline = '2px solid red';
    input.disabled = false;
}
document.getElementById('fotoBaruInput').addEventListener('change', function() {
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