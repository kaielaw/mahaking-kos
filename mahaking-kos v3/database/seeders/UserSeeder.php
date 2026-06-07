<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ── PEMILIK KOS ───────────────────────────────────────────
        User::create([
            'id_user'       => 'U0001',
            'nama_depan'    => 'Kayla',
            'nama_belakang' => 'Ferdinan',
            'email'         => 'kayla@gmail.com',
            'password'      => bcrypt('12345678'),
            'nomor_hp'      => '08123456789',
            'foto_profil'   => 'default.jpg',   // NOT NULL di migration → wajib diisi
            'role'          => 'pemilik',
        ]);

        // ── PENYEWA ───────────────────────────────────────────────
        User::create([
            'id_user'       => 'U0002',
            'nama_depan'    => 'Budi',
            'nama_belakang' => 'Santoso',
            'email'         => 'budi@gmail.com',
            'password'      => bcrypt('12345678'),
            'nomor_hp'      => '08111111111',
            'foto_profil'   => 'default.jpg',   // NOT NULL di migration → wajib diisi
            'role'          => 'penyewa',
        ]);
    }
}