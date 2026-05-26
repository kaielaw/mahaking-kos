<?php

namespace Database\Seeders;

// buat nonaktifin event model sementara saat seeding -> use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pembayaran::create([
            'id_pembayaran' => 'PM001',
            'id_booking' => 'B0001',
            'metode_pembayaran' => 'Transfer Bank',
            'nama_bank' => 'BCA',
            'nomor_rekening' => '123456789',
            'nama_rekening' => 'Kayla Hessa',
            'biaya_sewa' => 8000000,
            'biaya_admin' => 5000,
            'jumlah' => 8005000,
            'tanggal_bayar' => now(),
            'bukti_pembayaran' => 'bukti.jpg',
            'status_pembayaran' => 'dibayar'
        ]);
    }
}
