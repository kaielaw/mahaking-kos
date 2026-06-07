<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kamar::create([
            'id_kamar' => 'KM001',
            'id_kos' => 'K0001',
            'nomor_kamar' => 101,
            'harga_per_bulan' => 750000,
            'harga_per_tahun' => 8000000,
            'ukuran' => '3x4',
            'tipe_kamar' => 'AC',
            'ketersediaan_kamar' => 'tersedia'
        ]);
    }
}
