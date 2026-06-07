<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FotoKos;

class FotoKosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FotoKos::create([
            'id_foto' => 'FK001',
            'id_kos' => 'K0001',
            'url_foto' => 'kos1.jpg',
            'caption' => 'Tampak depan kos'
        ]);
    }
}
