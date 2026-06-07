<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::create([
            'id_booking'      => 'B0001',
            'id_user'         => 'U0002',
            'id_kamar'        => 'KM001',
            'tanggal_booking' => '2026-05-25 10:00:00',  // dateTime NOT NULL
            'tanggal_masuk'   => '2026-06-01',
            'tanggal_keluar'  => '2027-06-01',
            'total_harga'     => 8000000,
            'status_booking'  => 'diterima',   // ← enum migration: pending|diterima|dibatalkan|selesai
            'catatan_penyewa' => 'Mohon kamar dekat jendela',
        ]);
    }
}