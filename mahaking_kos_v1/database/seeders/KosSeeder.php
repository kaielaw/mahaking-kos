<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kos;

class KosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kos::create([
            'id_kos' => 'K0001',
            'id_pemilik' => 'P0001',
            'id_lokasi' => 'L0001',
            'nama_kos' => 'Kos Mawar',
            'alamat' => 'Jl. Mawar No. 1',
            'deskripsi' => 'Kos nyaman dekat kampus',
            'tipe_kos' => 'Exclusive',
            'jenis_kos' => 'putri',
            'harga_min' => 500000,
            'harga_max' => 1000000,
            'jumlah_kamar' => 20,
            'jumlah_kamar_tersedia' => 5,
            'aturan_kos' => 'Tidak boleh membawa hewan',
            'rating_rata2' => 4.5,
            'total_review' => 10,
            'status_ketersediaan' => 'tersedia',
            'status_verifikasi' => 'verified'
        ]);
    }
}
