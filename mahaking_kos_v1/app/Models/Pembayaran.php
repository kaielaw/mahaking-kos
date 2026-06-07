<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'pembayaran';

    // Primary key
    protected $primaryKey = 'id_pembayaran';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_pembayaran',
        'id_booking',
        'metode_pembayaran',
        'nama_bank',
        'nomor_rekening',
        'nama_rekening',
        'biaya_sewa',
        'biaya_admin',
        'jumlah',
        'tanggal_bayar',
        'bukti_pembayaran',
        'status_pembayaran'
    ];

    /* RELATIONSHIP */
    // Pembayaran dimiliki oleh satu booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking');
    }
}