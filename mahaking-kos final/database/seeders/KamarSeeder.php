<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $kamar = [
            // ── K0001 (Kos Mawar Eksklusif) ──────────────────────────
            ['id_kamar' => 'KM001', 'id_kos' => 'K0001', 'nomor_kamar' => 101, 'harga_per_bulan' => 750000,  'harga_per_tahun' => 8000000,  'ukuran' => '3x4 Meter', 'tipe_kamar' => 'AC',     'ketersediaan_kamar' => 'tersedia'],
            ['id_kamar' => 'KM002', 'id_kos' => 'K0001', 'nomor_kamar' => 102, 'harga_per_bulan' => 750000,  'harga_per_tahun' => 8000000,  'ukuran' => '3x4 Meter', 'tipe_kamar' => 'AC',     'ketersediaan_kamar' => 'terisi'],
            ['id_kamar' => 'KM003', 'id_kos' => 'K0001', 'nomor_kamar' => 103, 'harga_per_bulan' => 900000,  'harga_per_tahun' => 10000000, 'ukuran' => '4x4 Meter', 'tipe_kamar' => 'AC+KMD', 'ketersediaan_kamar' => 'tersedia'],
            ['id_kamar' => 'KM004', 'id_kos' => 'K0001', 'nomor_kamar' => 201, 'harga_per_bulan' => 1200000, 'harga_per_tahun' => 13000000, 'ukuran' => '4x5 Meter', 'tipe_kamar' => 'VIP',    'ketersediaan_kamar' => 'tersedia'],

            // ── K0002 (JatiNewYork) ───────────────────────────────────
            ['id_kamar' => 'KM005', 'id_kos' => 'K0002', 'nomor_kamar' => 1,   'harga_per_bulan' => 2500000, 'harga_per_tahun' => 28000000, 'ukuran' => '4x5 Meter', 'tipe_kamar' => 'Suite',  'ketersediaan_kamar' => 'tersedia'],
            ['id_kamar' => 'KM006', 'id_kos' => 'K0002', 'nomor_kamar' => 2,   'harga_per_bulan' => 3000000, 'harga_per_tahun' => 34000000, 'ukuran' => '5x5 Meter', 'tipe_kamar' => 'Deluxe', 'ketersediaan_kamar' => 'terisi'],
            ['id_kamar' => 'KM007', 'id_kos' => 'K0002', 'nomor_kamar' => 3,   'harga_per_bulan' => 5000000, 'harga_per_tahun' => 55000000, 'ukuran' => '6x6 Meter', 'tipe_kamar' => 'Premium','ketersediaan_kamar' => 'tersedia'],

            // ── K0003 (Putri Melati) ──────────────────────────────────
            ['id_kamar' => 'KM008', 'id_kos' => 'K0003', 'nomor_kamar' => 1,   'harga_per_bulan' => 600000,  'harga_per_tahun' => 6500000,  'ukuran' => '3x3 Meter', 'tipe_kamar' => 'Kipas',  'ketersediaan_kamar' => 'tersedia'],
            ['id_kamar' => 'KM009', 'id_kos' => 'K0003', 'nomor_kamar' => 2,   'harga_per_bulan' => 750000,  'harga_per_tahun' => 8000000,  'ukuran' => '3x4 Meter', 'tipe_kamar' => 'AC',     'ketersediaan_kamar' => 'tersedia'],
            ['id_kamar' => 'KM010', 'id_kos' => 'K0003', 'nomor_kamar' => 3,   'harga_per_bulan' => 900000,  'harga_per_tahun' => 10000000, 'ukuran' => '4x4 Meter', 'tipe_kamar' => 'AC+KMD', 'ketersediaan_kamar' => 'terisi'],

            // ── K0004 (Putra Laut) ────────────────────────────────────
            ['id_kamar' => 'KM011', 'id_kos' => 'K0004', 'nomor_kamar' => 1,   'harga_per_bulan' => 500000,  'harga_per_tahun' => 5500000,  'ukuran' => '3x3 Meter', 'tipe_kamar' => 'Kipas',  'ketersediaan_kamar' => 'tersedia'],
            ['id_kamar' => 'KM012', 'id_kos' => 'K0004', 'nomor_kamar' => 2,   'harga_per_bulan' => 650000,  'harga_per_tahun' => 7000000,  'ukuran' => '3x4 Meter', 'tipe_kamar' => 'AC',     'ketersediaan_kamar' => 'tersedia'],
        ];

        foreach ($kamar as $k) {
            Kamar::create($k);
        }
    }
}