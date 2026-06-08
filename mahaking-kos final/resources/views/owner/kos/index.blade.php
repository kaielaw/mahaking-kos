@extends('layouts.dashboard')

@section('title', 'Data Kos')

@section('sidebar_nav')
    <a href="{{ route('owner.index') }}"><i class="fas fa-chart-pie"></i><span>Dashboard</span></a>
    <a href="{{ route('owner.kamar.index') }}"><i class="fas fa-door-open"></i><span>Data Kamar</span></a>
    <a href="{{ route('owner.kos.index') }}" class="active"><i class="fas fa-building"></i><span>Data Kos</span></a>
    <a href="{{ route('owner.profile.show') }}"><i class="fas fa-user-tie"></i><span>Profile Owner</span></a>
@endsection

@section('content')
<h2>Manajemen Data Kos</h2>

@if(session('success'))
    <div style="background:#e8f5e9;color:#2e7d32;border-radius:8px;padding:10px 16px;margin-bottom:20px;font-size:.88rem;">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="background:#ffebee;color:#c62828;border-radius:8px;padding:10px 16px;margin-bottom:20px;font-size:.88rem;">
        {{ session('error') }}
    </div>
@endif

<div style="background:#fdf9f5;border:1.5px solid var(--gray-light);border-radius:var(--radius);overflow:hidden;margin-bottom:20px;">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID Kos</th>
                <th>Nama Kos</th>
                <th>Alamat</th>
                <th>Tipe</th>
                <th>Kamar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @isset($dataKos)
                @forelse($dataKos as $kos)
                <tr>
                    <td style="font-weight:600;color:var(--gold);font-size:.82rem;">{{ $kos->id_kos }}</td>
                    <td style="font-weight:600;">{{ $kos->nama_kos }}</td>
                    <td style="color:var(--gray);font-size:.85rem;">
                        {{ $kos->lokasi?->kecamatan }}, {{ $kos->lokasi?->kota }}
                    </td>
                    <td>
                        <span class="badge badge-{{ strtolower($kos->jenis_kos) }}">
                            {{ ucfirst($kos->jenis_kos) }}
                        </span>
                    </td>
                    <td>{{ $kos->jumlah_kamar }} Unit</td>
                    <td>
                        @if($kos->status_ketersediaan === 'tersedia')
                            <span class="badge badge-green">Tersedia</span>
                        @else
                            <span class="badge badge-red">Penuh</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            {{-- EDIT: pakai route() --}}
                            <a href="{{ route('owner.kos.edit', $kos->id_kos) }}"
                               class="btn btn-edit btn-sm">
                                <i class="fas fa-pencil"></i> Edit
                            </a>
                            {{-- DELETE --}}
                            <form method="POST"
                                  action="{{ route('owner.kos.destroy', $kos->id_kos) }}"
                                  style="margin:0;"
                                  onsubmit="return confirm('Yakin hapus kos {{ $kos->nama_kos }}? Semua data terkait akan ikut terhapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;color:var(--gray);padding:40px;">
                        <i class="fas fa-building" style="font-size:2rem;color:var(--gold-pale);display:block;margin-bottom:12px;"></i>
                        Belum ada data kos.<br>
                        <a href="{{ route('owner.kos.create') }}"
                           style="color:var(--gold);font-weight:600;margin-top:8px;display:inline-block;">
                            Tambah kos pertama kamu →
                        </a>
                    </td>
                </tr>
                @endforelse
            @endisset
        </tbody>
    </table>
</div>

<a href="{{ route('owner.kos.create') }}" class="btn-add">
    <i class="fas fa-plus-circle"></i> Tambah Kos Baru
</a>
@endsection