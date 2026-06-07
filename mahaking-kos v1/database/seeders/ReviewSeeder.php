<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'id_review' => 'R0001',
            'id_user' => 'U0002',
            'id_kos' => 'K0001',
            'rating' => 4.5,
            'komentar' => 'Kos bersih dan nyaman',
            'tanggal_review' => now()
        ]);
    }
}
