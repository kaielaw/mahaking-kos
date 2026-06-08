@extends('layouts.dashboard')

@section('title', 'Profile Owner')

@section('sidebar_nav')
    <a href="{{ route('owner.index') }}"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
    <a href="{{ route('owner.kamar.index') }}"><i class="fas fa-door-open"></i><span>Data Kamar</span></a>
    <a href="{{ route('owner.kos.index') }}"><i class="fas fa-building"></i><span>Data Kos</span></a>
    <a href="{{ route('owner.profile.show') }}" class="active"><i class="fas fa-user-tie"></i><span>Profile Owner</span></a>
@endsection

@push('styles')
<style>
    .profile-box { background:var(--white);border:1.5px solid var(--gray-light);border-radius:var(--radius);padding:32px 36px;max-width:760px; }
    .avatar-row { display:flex;align-items:center;gap:20px;margin-bottom:24px; }
    .avatar-circle { width:64px;height:64px;border-radius:50%;background:var(--gold-pale);display:flex;align-items:center;justify-content:center;overflow:hidden;border:2px solid var(--gold);flex-shrink:0; }
    .avatar-circle img { width:100%;height:100%;object-fit:cover; }
    .avatar-circle i { font-size:1.8rem;color:var(--gold); }
    .btn-photo { background:none;border:1.5px solid var(--gray-light);color:var(--navy);border-radius:var(--radius-sm);padding:8px 18px;font-family:var(--font-body);font-size:.85rem;font-weight:500;cursor:pointer;transition:all .2s; }
    .btn-photo:hover { border-color:var(--gold);color:var(--gold); }
    .form-group { margin-bottom:18px; }
    .form-label { display:block;font-size:.85rem;font-weight:600;color:var(--navy);margin-bottom:6px; }
    .form-control { width:100%;padding:11px 14px;border:1.5px solid var(--gray-light);border-radius:var(--radius-sm);font-family:var(--font-body);font-size:.9rem;background:#f5f0e8;color:var(--navy);outline:none;transition:border-color .2s,box-shadow .2s; }
    .form-control:focus { border-color:var(--gold);background:var(--white);box-shadow:0 0 0 3px rgba(201,168,76,.12); }
    .rekening-box { background:#f0ecf8;border:1.5px solid #d5ccee;border-radius:var(--radius-sm);padding:22px 24px;margin:20px 0; }
    .rekening-title { font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:#6a3fa0;margin-bottom:16px;display:flex;align-items:center;gap:8px; }
    .rekening-box .form-control { background:var(--white); }
    .btn-simpan { width:100%;padding:14px;background:var(--gold);color:var(--navy);border:none;border-radius:var(--radius-sm);font-family:var(--font-body);font-size:.9rem;font-weight:700;cursor:pointer;transition:background .2s; }
    .btn-simpan:hover { background:var(--gold-light); }
</style>
@endpush

@section('content')
<h2>Aturan Profile &amp; Data Rekening Owner</h2>

@if(session('success'))
    <div style="background:#e8f5e9;color:#2e7d32;border-radius:8px;padding:10px 16px;margin-bottom:20px;font-size:.88rem;">
        ✓ {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div style="background:#ffebee;color:#c62828;border-radius:8px;padding:10px 16px;margin-bottom:20px;font-size:.85rem;">
        @foreach($errors->all() as $err)<div>• {{ $err }}</div>@endforeach
    </div>
@endif

<div class="profile-box fade-up">
    {{-- action pakai route(), method PUT --}}
    <form method="POST" action="{{ route('owner.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="avatar-row">
            <div class="avatar-circle">
                @if(auth()->user()?->foto_profil && auth()->user()->foto_profil !== 'default.jpg')
                    <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="">
                @else
                    <i class="fas fa-circle-user"></i>
                @endif
            </div>
            <label>
                <input type="file" name="foto_profil" accept="image/*" style="display:none;" id="fotoInput">
                <button type="button" class="btn-photo"
                        onclick="document.getElementById('fotoInput').click()">
                    Ganti Foto Profil
                </button>
            </label>
        </div>

        <div class="form-group">
            <label class="form-label">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control"
                   value="{{ old('nama_depan', auth()->user()->nama_depan) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control"
                   value="{{ old('nama_belakang', auth()->user()->nama_belakang) }}">
        </div>

        {{-- field name: no_hp sesuai OwnerProfileController --}}
        <div class="form-group">
            <label class="form-label">Nomor HP Aktif</label>
            <input type="text" name="no_hp" class="form-control"
                   value="{{ old('no_hp', auth()->user()->nomor_hp) }}">
        </div>

        {{-- REKENING --}}
        <div class="rekening-box">
            <div class="rekening-title">
                <i class="fas fa-credit-card"></i>
                INFORMASI REKENING PEMBAYARAN SEWA (PENTING)
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Nama Bank</label>
                <input type="text" name="nama_bank" class="form-control"
                       placeholder="Contoh: BCA, BRI, Mandiri"
                       value="{{ old('nama_bank', $pemilik?->nama_bank !== '-' ? $pemilik?->nama_bank : '') }}">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">Nomor Rekening Tujuan</label>
                <input type="text" name="nomor_rekening" class="form-control"
                       placeholder="Masukkan nomor rekening"
                       value="{{ old('nomor_rekening', $pemilik?->nomor_rekening !== '-' ? $pemilik?->nomor_rekening : '') }}">
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Nama Rekening</label>
                <input type="text" name="nama_rekening" class="form-control"
                       placeholder="Nama pemilik rekening"
                       value="{{ old('nama_rekening', $pemilik?->nama_rekening) }}">
            </div>
        </div>

        <button type="submit" class="btn-simpan">Simpan Validasi Akun</button>
    </form>
</div>
@endsection