@extends('layouts.dashboard')

@section('title', 'Data Kamar')

@section('sidebar_nav')
    <a href="{{ route('owner.index') }}"><i class="fas fa-chart-pie"></i><span class="nav-label">Dashboard</span></a>
    <a href="{{ route('owner.kamar.index') }}" class="active"><i class="fas fa-door-open"></i><span class="nav-label">Data Kamar</span></a>
    <a href="{{ route('owner.kos.index') }}"><i class="fas fa-building"></i><span class="nav-label">Data Kos</span></a>
    <a href="{{ route('owner.profile.show') }}"><i class="fas fa-user-tie"></i><span class="nav-label">Profile Owner</span></a>
@endsection

@section('content')
<h2>Manajemen Data Kamar</h2>

<div style="background:#fdf9f5;border:1.5px solid var(--gray-light);border-radius:var(--radius);overflow:hidden;margin-bottom:20px;">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID Kamar</th>
                <th>Nama Kos</th>
                <th>Ukuran</th>
                <th>Harga/Bulan</th>
                <th>Status Kamar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @isset($dataKamar)
                @forelse($dataKamar as $kamar)
                <tr>
                    <td style="font-weight:600;color:var(--gold);font-size:.82rem;">{{ $kamar->id_kamar }}</td>
                    <td>{{ $kamar->kos?->nama_kos }}</td>
                    <td>{{ $kamar->ukuran ?? '—' }}</td>
                    <td>Rp {{ number_format($kamar->harga_per_bulan, 0, ',', '.') }}</td>
                    <td>
                        @php $st = $kamar->ketersediaan_kamar ?? 'tersedia'; @endphp
                        @if($st === 'tersedia')
                            <span class="badge badge-tersedia">Tersedia</span>
                        @else
                            <span class="badge badge-penuh">Penuh/Tersewa</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('owner.kamar.edit', $kamar->id_kamar) }}"
                               class="btn btn-edit btn-sm">
                                <i class="fas fa-pencil"></i> Edit Kamar
                            </a>
                            <form method="POST"
                                  action="{{ route('owner.kamar.destroy', $kamar->id_kamar) }}"
                                  style="margin:0;"
                                  onsubmit="return confirm('Yakin hapus kamar ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:var(--gray);padding:40px;">
                        <i class="fas fa-door-open" style="font-size:2rem;color:var(--gold-pale);display:block;margin-bottom:12px;"></i>
                        Belum ada data kamar.
                    </td>
                </tr>
                @endforelse
            @endisset
        </tbody>
    </table>
</div>

<a href="{{ route('owner.kamar.create') }}" class="btn-add">
    <i class="fas fa-plus-circle"></i> Tambah Kamar Baru
</a>
@endsection