<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailFasilitas;

class DetailFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailFasilitas::create([
            'id_detail_fasilitas' => 'D0001',
            'id_kos' => 'K0001',
            'id_fasilitas' => 'F0001',
            'keterangan' => 'WiFi 50 Mbps'
        ]);
    }
}
