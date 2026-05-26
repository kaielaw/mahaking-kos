<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'id_booking' => 'B0001',
            'id_user' => 'U0002',
            'id_kamar' => 'KM001',
            'tanggal_booking' => now(),
            'tanggal_masuk' => '2026-06-01',
            'tanggal_keluar' => '2027-06-01',
            'total_harga' => 8000000,
            'status_booking' => 'diterima',
            'catatan_penyewa' => 'Mohon kamar dekat jendela'
        ]);
    }
}
