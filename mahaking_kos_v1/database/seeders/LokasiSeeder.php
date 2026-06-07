<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lokasi::create([
            'id_lokasi' => 'L0001',
            'kecamatan' => 'Jatinangor',
            'kota' => 'Sumedang',
            'provinsi' => 'Jawa Barat'
        ]);
    }
}
