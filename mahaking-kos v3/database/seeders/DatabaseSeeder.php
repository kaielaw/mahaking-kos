<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // 1. User dulu (tidak ada FK ke tabel lain)
            UserSeeder::class,

            // 2. PemilikKos (FK ke user)
            PemilikKosSeeder::class,

            // 3. Lokasi (tidak ada FK)
            LokasiSeeder::class,

            // 4. Kos (FK ke pemilik_kos + lokasi)
            KosSeeder::class,

            // 5. Kamar (FK ke kos)
            KamarSeeder::class,

            // 6. Fasilitas (tidak ada FK)
            FasilitasSeeder::class,

            // 7. DetailFasilitas (FK ke kos + fasilitas)
            DetailFasilitasSeeder::class,

            // 8. FotoKos (FK ke kos)
            FotoKosSeeder::class,

            // 9. Booking (FK ke user + kamar)
            BookingSeeder::class,

            // 10. Pembayaran (FK ke booking)
            PembayaranSeeder::class,

            // 11. Review (FK ke user + kos)
            ReviewSeeder::class,

            // 12. Wishlist (FK ke user + kos)
            WishlistSeeder::class,
        ]);
    }
}