<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            UserSeeder::class,
            PemilikKosSeeder::class,
            LokasiSeeder::class,
            KosSeeder::class,
            KamarSeeder::class,
            FasilitasSeeder::class,
            DetailFasilitasSeeder::class,
            BookingSeeder::class,
            PembayaranSeeder::class,
            ReviewSeeder::class,
            WishlistSeeder::class,
            FotoKosSeeder::class,
        ]);
    }
}
