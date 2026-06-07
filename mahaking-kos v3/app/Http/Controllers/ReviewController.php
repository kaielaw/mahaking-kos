<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function index()
    {
        $dataKos = Kos::orderBy('nama_kos')->get(['id_kos', 'nama_kos']);

        // Sort by tanggal_review DESC supaya yang terbaru muncul di atas
        $reviews = Review::with('kos')
            ->where('id_user', Auth::user()->id_user)
            ->orderBy('tanggal_review', 'desc')
            ->get();

        return view('review.index', compact('dataKos', 'reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kos'   => 'required|exists:kos,id_kos',
            'rating'   => 'required|numeric|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ], [
            'id_kos.required'   => 'Pilih kos yang ingin diulas.',
            'rating.required'   => 'Rating wajib diisi.',
            'komentar.required' => 'Komentar wajib diisi.',
        ]);

        $sudahReview = Review::where('id_user', Auth::user()->id_user)
            ->where('id_kos', $request->id_kos)
            ->exists();

        if ($sudahReview) {
            return back()->withInput()
                ->with('error', 'Kamu sudah pernah memberikan ulasan untuk kos ini.');
        }

        // Generate id_review unik max 5 char
        do {
            $idReview = 'R' . strtoupper(Str::random(4));
        } while (Review::where('id_review', $idReview)->exists());

        Review::create([
            'id_review'      => $idReview,
            'id_user'        => Auth::user()->id_user,
            'id_kos'         => $request->id_kos,
            'rating'         => (float) $request->rating,
            'komentar'       => $request->komentar,
            'tanggal_review' => now(),
        ]);

        $this->updateRatingKos($request->id_kos);

        return redirect()->route('review.index')
            ->with('success', 'Ulasan berhasil dikirim!');
    }

    public function destroy($id)
    {
        $review = Review::where('id_review', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $idKos = $review->id_kos;
        $review->delete();
        $this->updateRatingKos($idKos);

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }

    private function updateRatingKos(string $idKos): void
    {
        $reviews = Review::where('id_kos', $idKos)->get();
        $total   = $reviews->count();
        $avg     = $total > 0 ? round($reviews->avg('rating'), 1) : null;

        Kos::where('id_kos', $idKos)->update([
            'rating_rata2' => $avg,
            'total_review' => $total,
        ]);
    }
}