<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PemilikKos;

class PemilikKosSeeder extends Seeder
{
    public function run(): void
    {
        PemilikKos::create([
            'id_pemilik'        => 'P0001',
            'id_user'           => 'U0001',
            'nama_depan'        => 'Kayla',
            'nama_belakang'     => 'Ferdinan',
            'nama_bank'         => 'BCA',                // NOT NULL
            'nomor_rekening'    => '1234567890',          // NOT NULL
            'nama_rekening'     => 'Kayla Ferdinan',      // NOT NULL
            'no_hp'             => '08123456789',         // NOT NULL
            'alamat'            => 'Jl. Mawar No. 1, Jatinangor, Sumedang', // NOT NULL
            'verifikasi_status' => 'verified',
        ]);
    }
}