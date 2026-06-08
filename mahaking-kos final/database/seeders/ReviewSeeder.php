<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'id_review'      => 'R0001',
                'id_user'        => 'U0002',
                'id_kos'         => 'K0001',
                'rating'         => 4.5,                      // decimal(2,1) → 4.5 valid ✓
                'komentar'       => 'Kos bersih dan nyaman, penjaga ramah, WiFi kencang!',
                'tanggal_review' => '2026-05-01 08:00:00',    // dateTime NOT NULL
            ],
            [
                'id_review'      => 'R0002',
                'id_user'        => 'U0002',
                'id_kos'         => 'K0002',
                'rating'         => 5.0,
                'komentar'       => 'Sangat premium, fasilitas lengkap, worth the price.',
                'tanggal_review' => '2026-05-10 09:00:00',
            ],
            [
                'id_review'      => 'R0003',
                'id_user'        => 'U0002',
                'id_kos'         => 'K0003',
                'rating'         => 4.0,
                'komentar'       => 'Lingkungan aman dan tenang, cocok untuk belajar.',
                'tanggal_review' => '2026-05-15 10:00:00',
            ],
            [
                'id_review'      => 'R0004',
                'id_user'        => 'U0002',
                'id_kos'         => 'K0004',
                'rating'         => 4.0,
                'komentar'       => 'Harga terjangkau, akses ke kampus mudah, recommended!',
                'tanggal_review' => '2026-05-20 11:00:00',
            ],
        ];

        foreach ($reviews as $r) {
            Review::create($r);
        }
    }
}