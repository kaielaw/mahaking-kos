<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'id_user' => 'U0001',
            'nama_depan' => 'Kayla',
            'nama_belakang' => 'Ferdinan',
            'email' => 'kayla@gmail.com',
            'password' => bcrypt('12345678'),
            'nomor_hp' => '08123456789',
            'foto_profil' => 'kayla.jpg',
            'role' => 'pemilik_kos'
        ]);

        User::create([
            'id_user' => 'U0002',
            'nama_depan' => 'Budi',
            'nama_belakang' => 'Santoso',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('12345678'),
            'nomor_hp' => '08111111111',
            'foto_profil' => 'budi.jpg',
            'role' => 'pencari_kos'
        ]);
    }
}

