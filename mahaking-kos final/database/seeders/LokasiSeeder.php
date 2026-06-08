<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        $lokasi = [
            ['id_lokasi' => 'L0001', 'kecamatan' => 'Jatinangor',  'kota' => 'Sumedang',  'provinsi' => 'Jawa Barat'],
            ['id_lokasi' => 'L0002', 'kecamatan' => 'Hegarmanah',  'kota' => 'Sumedang',  'provinsi' => 'Jawa Barat'],
            ['id_lokasi' => 'L0003', 'kecamatan' => 'Ciseke',      'kota' => 'Sumedang',  'provinsi' => 'Jawa Barat'],
            ['id_lokasi' => 'L0004', 'kecamatan' => 'Ciluda',      'kota' => 'Sumedang',  'provinsi' => 'Jawa Barat'],
        ];

        foreach ($lokasi as $l) {
            Lokasi::create($l);
        }
    }
}