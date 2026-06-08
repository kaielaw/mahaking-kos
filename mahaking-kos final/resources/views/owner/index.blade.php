@extends('layouts.dashboard')

@section('title', 'Dashboard Owner')

@section('sidebar_nav')
    <a href="{{ route('owner.index') }}" class="active"><i class="fas fa-chart-pie"></i><span class="nav-label">Dashboard</span></a>
    <a href="{{ route('owner.kamar.index') }}"><i class="fas fa-door-open"></i><span class="nav-label">Data Kamar</span></a>
    <a href="{{ route('owner.kos.index') }}"><i class="fas fa-building"></i><span class="nav-label">Data Kos</span></a>
    <a href="{{ route('owner.profile.show') }}"><i class="fas fa-user-tie"></i><span class="nav-label">Profile Owner</span></a>
@endsection

@push('styles')
<style>
    .welcome-banner {
        background:var(--navy);border-radius:var(--radius);
        padding:28px 32px;margin-bottom:32px;
        display:flex;align-items:center;justify-content:space-between;
        position:relative;overflow:hidden;
    }
    .welcome-banner::before { content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 80% 50%,rgba(201,168,76,.15) 0%,transparent 60%); }
    .welcome-text { position:relative;z-index:1; }
    .welcome-text h3 { font-family:var(--font-display);font-size:1.3rem;font-weight:700;color:var(--white);margin-bottom:6px; }
    .welcome-text p { font-size:.88rem;color:rgba(255,255,255,.6); }
    .welcome-crown { position:relative;z-index:1;opacity:.18; }

    .stats-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:36px; }
    .stat-card { background:#fdf9f5;border:1.5px solid var(--gray-light);border-radius:var(--radius);padding:22px 24px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s; }
    .stat-card:hover { box-shadow:var(--shadow-sm); }
    .stat-icon { width:48px;height:48px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0; }
    .stat-icon.gold  { background:var(--gold-pale);color:var(--gold); }
    .stat-icon.navy  { background:rgba(26,32,53,.08);color:var(--navy); }
    .stat-icon.green { background:#e8f5e9;color:#2e7d32; }
    .stat-label { font-size:.75rem;color:var(--gray);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px; }
    .stat-value { font-family:var(--font-display);font-size:1.7rem;font-weight:700;color:var(--navy);line-height:1; }

    .sec-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:14px; }
    .sec-title { font-family:var(--font-display);font-size:1.05rem;font-weight:700;color:var(--navy); }
    .sec-link { font-size:.82rem;font-weight:600;color:var(--gold);text-decoration:none; }
    .sec-link:hover { text-decoration:underline; }
</style>
@endpush

@section('content')

{{-- WELCOME --}}
<div class="welcome-banner fade-up">
    <div class="welcome-text">
        <h3>Selamat datang, {{ auth()->user()->nama_depan }}! 👑</h3>
        <p>Kelola properti kos kamu dengan mudah dari sini.</p>
    </div>
    <svg class="welcome-crown" width="80" height="60" viewBox="0 0 40 30" fill="none">
        <path d="M2 26h36" stroke="#C9A84C" stroke-width="2.2" stroke-linecap="round"/>
        <path d="M4 26L7 10L14 17L20 4L26 17L33 10L36 26" stroke="#C9A84C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="4" cy="9" r="2.5" fill="#C9A84C"/>
        <circle cx="20" cy="3" r="2.5" fill="#C9A84C"/>
        <circle cx="36" cy="9" r="2.5" fill="#C9A84C"/>
    </svg>
</div>

{{-- STATS --}}
<div class="stats-grid fade-up">
    <div class="stat-card">
        <div class="stat-icon gold"><i class="fas fa-building"></i></div>
        <div>
            <div class="stat-label">Total Kos</div>
            <div class="stat-value">{{ $totalKos ?? 0 }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon navy"><i class="fas fa-door-open"></i></div>
        <div>
            <div class="stat-label">Total Kamar</div>
            <div class="stat-value">{{ $totalKamar ?? 0 }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-circle-check"></i></div>
        <div>
            <div class="stat-label">Kamar Tersedia</div>
            <div class="stat-value">{{ $kamarTersedia ?? 0 }}</div>
        </div>
    </div>
</div>

{{-- QUICK LINKS --}}
<div class="sec-header fade-up">
    <span class="sec-title">Kos Terbaru</span>
    <a href="{{ route('owner.kos.index') }}" class="sec-link">Lihat semua →</a>
</div>

<table class="data-table fade-up">
    <thead>
        <tr>
            <th>ID Kos</th>
            <th>Nama Kos</th>
            <th>Jenis</th>
            <th>Kamar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @isset($dataKos)
            @forelse($dataKos->take(5) as $kos)
            <tr>
                <td style="font-weight:600;color:var(--gold);font-size:.82rem;">{{ $kos->id_kos }}</td>
                <td style="font-weight:600;">{{ $kos->nama_kos }}</td>
                <td><span class="badge badge-{{ strtolower($kos->jenis_kos) }}">{{ ucfirst($kos->jenis_kos) }}</span></td>
                <td>{{ $kos->jumlah_kamar }} Unit</td>
                <td>
                    @if($kos->status_ketersediaan === 'tersedia')
                        <span class="badge badge-green">Tersedia</span>
                    @else
                        <span class="badge badge-red">Penuh</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('owner.kos.edit', $kos->id_kos) }}" class="btn btn-edit btn-sm">
                        <i class="fas fa-pencil"></i> Edit
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--gray);padding:32px;">
                    Belum ada kos.
                    <a href="{{ route('owner.kos.create') }}" style="color:var(--gold);font-weight:600;"> Tambah sekarang →</a>
                </td>
            </tr>
            @endforelse
        @endisset
    </tbody>
</table>

<a href="{{ route('owner.kos.create') }}" class="btn-add" style="margin-top:20px;">
    <i class="fas fa-plus-circle"></i> Tambah Kos Baru
</a>

@endsection