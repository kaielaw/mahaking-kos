@extends('layouts.dashboard')

@section('title', 'Review & Rating')

@section('sidebar_nav')
    <a href="{{ route('dashboard') }}"><i class="fas fa-gauge"></i><span class="nav-label">Dashboard</span></a>
    <a href="{{ route('wishlist.index') }}"><i class="fas fa-heart"></i><span class="nav-label">Wishlist</span></a>
    <a href="{{ route('review.index') }}" class="active"><i class="fas fa-star"></i><span class="nav-label">Review &amp; Rating</span></a>
    <a href="{{ route('profile.show') }}"><i class="fas fa-user"></i><span class="nav-label">Profile</span></a>
@endsection

@push('styles')
<style>
    .review-form-box { background:#fdf9f5;border:1.5px solid var(--gray-light);border-radius:var(--radius);padding:28px 32px;max-width:700px;margin-bottom:36px; }
    .form-label { display:block;font-size:.85rem;font-weight:600;color:var(--navy);margin-bottom:7px; }
    .form-control { width:100%;padding:11px 14px;border:1.5px solid var(--gray-light);border-radius:var(--radius-sm);font-family:var(--font-body);font-size:.9rem;background:#f5f0e8;color:var(--navy);outline:none;transition:border-color .2s,box-shadow .2s; }
    .form-control:focus { border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.12);background:var(--white); }
    select.form-control { cursor:pointer; }
    .form-group { margin-bottom:18px; }

    .star-group { display:flex;align-items:center;gap:6px;margin:8px 0 4px; }
    .star-input { font-size:1.5rem;color:var(--gray-light);cursor:pointer;transition:color .15s;user-select:none;line-height:1; }
    .star-input.active { color:var(--gold); }
    .star-val { font-size:.9rem;color:var(--navy);font-weight:600;margin-left:6px; }

    .btn-kirim { background:var(--gold);color:var(--navy);border:none;border-radius:var(--radius-sm);padding:11px 28px;font-size:.9rem;font-weight:700;cursor:pointer;transition:background .2s; }
    .btn-kirim:hover { background:var(--gold-light); }

    .history-title { font-family:var(--font-display);font-size:1.2rem;font-weight:700;color:var(--navy);margin-bottom:16px; }
    .review-stars { display:flex;align-items:center;gap:3px; }
    .review-stars i { font-size:.85rem; }
    .review-stars span { font-size:.85rem;font-weight:600;color:var(--navy);margin-left:4px; }
</style>
@endpush

@section('content')
<h2>Tulis Ulasan</h2>

<div class="review-form-box fade-up">
    <form method="POST" action="{{ route('review.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Pilih Kos</label>
            <select name="id_kos" class="form-control" required>
                <option value="" disabled selected>Pilih kos yang akan diulas..</option>
                @isset($dataKos)
                    @foreach($dataKos as $kos)
                    <option value="{{ $kos->id_kos }}" {{ old('id_kos')==$kos->id_kos?'selected':'' }}>
                        {{ $kos->nama_kos }}
                    </option>
                    @endforeach
                @endisset
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Rating</label>
            <div class="star-group" id="starGroup">
                @for($s=1;$s<=5;$s++)
                <span class="star-input" data-val="{{ $s }}">☆</span>
                @endfor
                <span class="star-val" id="starVal">1.0</span>
            </div>
            <input type="hidden" name="rating" id="ratingInput" value="1">
        </div>

        <div class="form-group">
            <label class="form-label">Komentar</label>
            <textarea name="komentar" class="form-control" rows="4"
                      placeholder="Ceritakan pengalaman kamu tinggal di kos ini...">{{ old('komentar') }}</textarea>
        </div>

        <button type="submit" class="btn-kirim">Kirim Review</button>
    </form>
</div>

{{-- RIWAYAT --}}
<h3 class="history-title">Riwayat Ulasan</h3>
<table class="data-table">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Kos</th>
            <th>Rating</th>
            <th>Komentar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @isset($reviews)
            @forelse($reviews as $rv)
            <tr>
                <td style="white-space:nowrap;">
                    {{ $rv->tanggal_review ? \Carbon\Carbon::parse($rv->tanggal_review)->format('d-m-Y') : '—' }}
                </td>
                <td>{{ $rv->kos?->nama_kos }}</td>
                <td>
                    <div class="review-stars">
                        @for($s=1;$s<=5;$s++)
                            <i class="fas fa-star" style="{{ $s <= $rv->rating ? 'color:var(--gold)' : 'color:var(--gray-light)' }}"></i>
                        @endfor
                        <span>{{ number_format($rv->rating, 1) }}</span>
                    </div>
                </td>
                <td>{{ $rv->komentar }}</td>
                <td>
                    <form method="POST" action="{{ route('review.destroy', $rv->id_review) }}" style="margin:0;" onsubmit="return confirm('Hapus ulasan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:var(--gray);padding:32px;">
                    Belum ada riwayat ulasan.
                </td>
            </tr>
            @endforelse
        @endisset
    </tbody>
</table>
@endsection

@push('scripts')
<script>
const stars = document.querySelectorAll('.star-input');
let current = 1;

function updateStars(val) {
    stars.forEach((s, i) => {
        s.textContent = i < val ? '★' : '☆';
        s.classList.toggle('active', i < val);
    });
    document.getElementById('starVal').textContent = val + '.0';
    document.getElementById('ratingInput').value = val;
    current = val;
}

updateStars(1);

stars.forEach(s => {
    s.addEventListener('click', () => { current = +s.dataset.val; updateStars(current); });
    s.addEventListener('mouseenter', () => updateStars(+s.dataset.val));
});
document.getElementById('starGroup').addEventListener('mouseleave', () => updateStars(current));
</script>
@endpush