<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitas = [
            ['id_fasilitas' => 'F0001', 'nama_fasilitas' => 'WiFi'],
            ['id_fasilitas' => 'F0002', 'nama_fasilitas' => 'AC'],
            ['id_fasilitas' => 'F0003', 'nama_fasilitas' => 'Kamar Mandi Dalam'],
            ['id_fasilitas' => 'F0004', 'nama_fasilitas' => 'Parkir Motor'],
            ['id_fasilitas' => 'F0005', 'nama_fasilitas' => 'Parkir Mobil'],
            ['id_fasilitas' => 'F0006', 'nama_fasilitas' => 'Dapur Bersama'],
            ['id_fasilitas' => 'F0007', 'nama_fasilitas' => 'Laundry'],
            ['id_fasilitas' => 'F0008', 'nama_fasilitas' => 'CCTV'],
            ['id_fasilitas' => 'F0009', 'nama_fasilitas' => 'Water Heater'],
            ['id_fasilitas' => 'F0010', 'nama_fasilitas' => 'Kasur'],
            ['id_fasilitas' => 'F0011', 'nama_fasilitas' => 'Lemari'],
            ['id_fasilitas' => 'F0012', 'nama_fasilitas' => 'Meja Belajar'],
        ];

        foreach ($fasilitas as $f) {
            Fasilitas::create($f);
        }
    }
}