<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailFasilitas;

class DetailFasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $detail = [
            // ── K0001 (Kos Mawar) ─────────────────────────────────────
            ['id_detail_fasilitas' => 'D0001', 'id_kos' => 'K0001', 'id_fasilitas' => 'F0001', 'keterangan' => 'WiFi 50 Mbps'],
            ['id_detail_fasilitas' => 'D0002', 'id_kos' => 'K0001', 'id_fasilitas' => 'F0002', 'keterangan' => 'AC 1 PK per kamar'],
            ['id_detail_fasilitas' => 'D0003', 'id_kos' => 'K0001', 'id_fasilitas' => 'F0003', 'keterangan' => 'Kamar mandi dalam untuk kamar VIP'],
            ['id_detail_fasilitas' => 'D0004', 'id_kos' => 'K0001', 'id_fasilitas' => 'F0004', 'keterangan' => 'Parkir motor tersedia'],
            ['id_detail_fasilitas' => 'D0005', 'id_kos' => 'K0001', 'id_fasilitas' => 'F0008', 'keterangan' => 'CCTV 24 jam'],

            // ── K0002 (JatiNewYork) ──────────────────────────────────
            ['id_detail_fasilitas' => 'D0006', 'id_kos' => 'K0002', 'id_fasilitas' => 'F0001', 'keterangan' => 'WiFi 100 Mbps fiber'],
            ['id_detail_fasilitas' => 'D0007', 'id_kos' => 'K0002', 'id_fasilitas' => 'F0002', 'keterangan' => 'AC inverter hemat energi'],
            ['id_detail_fasilitas' => 'D0008', 'id_kos' => 'K0002', 'id_fasilitas' => 'F0003', 'keterangan' => 'Kamar mandi dalam semua kamar'],
            ['id_detail_fasilitas' => 'D0009', 'id_kos' => 'K0002', 'id_fasilitas' => 'F0005', 'keterangan' => 'Parkir mobil basement'],
            ['id_detail_fasilitas' => 'D0010', 'id_kos' => 'K0002', 'id_fasilitas' => 'F0009', 'keterangan' => 'Water heater listrik'],
            ['id_detail_fasilitas' => 'D0011', 'id_kos' => 'K0002', 'id_fasilitas' => 'F0008', 'keterangan' => 'CCTV tiap lantai'],

            // ── K0003 (Putri Melati) ─────────────────────────────────
            ['id_detail_fasilitas' => 'D0012', 'id_kos' => 'K0003', 'id_fasilitas' => 'F0001', 'keterangan' => 'WiFi 20 Mbps'],
            ['id_detail_fasilitas' => 'D0013', 'id_kos' => 'K0003', 'id_fasilitas' => 'F0006', 'keterangan' => 'Dapur bersama lantai 1'],
            ['id_detail_fasilitas' => 'D0014', 'id_kos' => 'K0003', 'id_fasilitas' => 'F0007', 'keterangan' => 'Laundry kiloan tersedia'],
            ['id_detail_fasilitas' => 'D0015', 'id_kos' => 'K0003', 'id_fasilitas' => 'F0004', 'keterangan' => 'Parkir motor depan kos'],

            // ── K0004 (Putra Laut) ───────────────────────────────────
            ['id_detail_fasilitas' => 'D0016', 'id_kos' => 'K0004', 'id_fasilitas' => 'F0001', 'keterangan' => 'WiFi 20 Mbps'],
            ['id_detail_fasilitas' => 'D0017', 'id_kos' => 'K0004', 'id_fasilitas' => 'F0004', 'keterangan' => 'Parkir motor gratis'],
            ['id_detail_fasilitas' => 'D0018', 'id_kos' => 'K0004', 'id_fasilitas' => 'F0010', 'keterangan' => 'Kasur busa tersedia'],
        ];

        foreach ($detail as $d) {
            DetailFasilitas::create($d);
        }
    }
}