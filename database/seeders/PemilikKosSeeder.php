<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PemilikKos;

class PemilikKosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PemilikKos::create([
            'id_pemilik' => 'P0001',
            'id_user' => 'U0001',
            'nama_depan' => 'Kayla',
            'nama_belakang' => 'Hessa',
            'nama_bank' => 'BCA',
            'nomor_rekening' => '1234567890',
            'nama_rekening' => 'Kayla Hessa',
            'no_hp' => '08123456789',
            'alamat' => 'Jatinangor',
            'verifikasi_status' => 'verified'
        ]);
    }
}
