<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FotoKos;

class FotoKosSeeder extends Seeder
{
    public function run(): void
    {
        $foto = [
            // ── K0001 (Kos Mawar Eksklusif) ──────────────────────────
            ['id_foto' => 'FK001', 'id_kos' => 'K0001', 'url_foto' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&q=80', 'caption' => 'Tampak depan kos'],
            ['id_foto' => 'FK002', 'id_kos' => 'K0001', 'url_foto' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&q=80', 'caption' => 'Interior kamar'],
            ['id_foto' => 'FK003', 'id_kos' => 'K0001', 'url_foto' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80', 'caption' => 'Ruang tamu bersama'],

            // ── K0002 (JatiNewYork) ───────────────────────────────────
            ['id_foto' => 'FK004', 'id_kos' => 'K0002', 'url_foto' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&q=80', 'caption' => 'Gedung kos malam hari'],
            ['id_foto' => 'FK005', 'id_kos' => 'K0002', 'url_foto' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&q=80', 'caption' => 'Kamar premium'],
            ['id_foto' => 'FK006', 'id_kos' => 'K0002', 'url_foto' => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800&q=80', 'caption' => 'Kamar mandi dalam'],

            // ── K0003 (Putri Melati) ──────────────────────────────────
            ['id_foto' => 'FK007', 'id_kos' => 'K0003', 'url_foto' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800&q=80', 'caption' => 'Eksterior kos'],
            ['id_foto' => 'FK008', 'id_kos' => 'K0003', 'url_foto' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&q=80', 'caption' => 'Kamar putri'],

            // ── K0004 (Putra Laut) ────────────────────────────────────
            ['id_foto' => 'FK009', 'id_kos' => 'K0004', 'url_foto' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80', 'caption' => 'Tampak depan'],
            ['id_foto' => 'FK010', 'id_kos' => 'K0004', 'url_foto' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&q=80', 'caption' => 'Kamar putra'],
        ];

        foreach ($foto as $f) {
            FotoKos::create($f);
        }
    }
}