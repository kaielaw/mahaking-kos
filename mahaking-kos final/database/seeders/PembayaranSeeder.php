<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        Pembayaran::create([
            'id_pembayaran'     => 'PM001',
            'id_booking'        => 'B0001',
            'metode_pembayaran' => 'Transfer Bank',
            'nama_bank'         => 'BCA',
            'nomor_rekening'    => '123456789',
            'nama_rekening'     => 'Kayla Ferdinan',
            'biaya_sewa'        => 8000000,
            'biaya_admin'       => 5000,
            'jumlah'            => 8005000,
            'tanggal_bayar'     => '2026-05-25 10:30:00',  // dateTime NOT NULL
            'bukti_pembayaran'  => 'bukti_default.jpg',    // NOT NULL di migration → wajib diisi
            'status_pembayaran' => 'dibayar',              // ← enum: pending|dibayar|gagal
        ]);
    }
}