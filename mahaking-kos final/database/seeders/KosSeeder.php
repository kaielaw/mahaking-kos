<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kos;

class KosSeeder extends Seeder
{
    public function run(): void
    {
        $dataKos = [
            [
                'id_kos'                => 'K0001',
                'id_pemilik'            => 'P0001',
                'id_lokasi'             => 'L0001',
                'nama_kos'              => 'Kos Mawar Eksklusif',
                'alamat'                => 'Jl. Mawar No. 1, Jatinangor',     // NOT NULL (text)
                'deskripsi'             => 'Kos nyaman dekat kampus UNPAD, fasilitas lengkap, lingkungan aman.',  // NOT NULL (text)
                'tipe_kos'              => 'Exclusive',                        // NOT NULL
                'jenis_kos'             => 'putri',
                'harga_min'             => 750000,
                'harga_max'             => 1200000,
                'jumlah_kamar'          => 20,
                'jumlah_kamar_tersedia' => 5,
                'aturan_kos'            => 'Tidak boleh membawa hewan peliharaan. Tamu hanya sampai jam 21.00.', // NOT NULL (text)
                'rating_rata2'          => 4.5,   // nullable di migration ✓
                'total_review'          => 10,
                'status_ketersediaan'   => 'tersedia',
                'status_verifikasi'     => 'verified',
            ],
            [
                'id_kos'                => 'K0002',
                'id_pemilik'            => 'P0001',
                'id_lokasi'             => 'L0002',
                'nama_kos'              => 'Kos JatiNewYork',
                'alamat'                => 'Jl. Hegarmanah No. 12, Jatinangor',
                'deskripsi'             => 'Kos premium desain modern, cocok untuk mahasiswa dan pekerja profesional.',
                'tipe_kos'              => 'Premium',
                'jenis_kos'             => 'campur',
                'harga_min'             => 2500000,
                'harga_max'             => 5000000,
                'jumlah_kamar'          => 15,
                'jumlah_kamar_tersedia' => 3,
                'aturan_kos'            => 'Dilarang merokok di dalam kamar. Tamu sampai jam 22.00.',
                'rating_rata2'          => 5.0,
                'total_review'          => 8,
                'status_ketersediaan'   => 'tersedia',
                'status_verifikasi'     => 'verified',
            ],
            [
                'id_kos'                => 'K0003',
                'id_pemilik'            => 'P0001',
                'id_lokasi'             => 'L0003',
                'nama_kos'              => 'Kos Putri Melati',
                'alamat'                => 'Jl. Ciseke Timur No. 5',
                'deskripsi'             => 'Kos khusus putri, lingkungan kondusif untuk belajar, dekat minimarket.',
                'tipe_kos'              => 'Reguler',
                'jenis_kos'             => 'putri',
                'harga_min'             => 600000,
                'harga_max'             => 900000,
                'jumlah_kamar'          => 12,
                'jumlah_kamar_tersedia' => 4,
                'aturan_kos'            => 'Jam malam pukul 22.00. Dilarang membawa tamu lawan jenis.',
                'rating_rata2'          => 4.8,
                'total_review'          => 15,
                'status_ketersediaan'   => 'tersedia',
                'status_verifikasi'     => 'verified',
            ],
            [
                'id_kos'                => 'K0004',
                'id_pemilik'            => 'P0001',
                'id_lokasi'             => 'L0004',
                'nama_kos'              => 'Kos Putra Laut',
                'alamat'                => 'Jl. Ciluda No. 8',
                'deskripsi'             => 'Kos putra harga terjangkau, akses mudah ke kampus.',
                'tipe_kos'              => 'Standar',
                'jenis_kos'             => 'putra',
                'harga_min'             => 500000,
                'harga_max'             => 800000,
                'jumlah_kamar'          => 10,
                'jumlah_kamar_tersedia' => 2,
                'aturan_kos'            => 'Dilarang membawa kendaraan roda empat.',
                'rating_rata2'          => 4.2,
                'total_review'          => 6,
                'status_ketersediaan'   => 'tersedia',
                'status_verifikasi'     => 'verified',
            ],
        ];

        foreach ($dataKos as $kos) {
            Kos::create($kos);
        }
    }
}