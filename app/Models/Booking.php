<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'booking';

    // Primary key
    protected $primaryKey = 'id_booking';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_booking',
        'id_user',
        'id_kamar',
        'tanggal_booking',
        'tanggal_masuk',
        'tanggal_keluar',
        'total_harga',
        'status_booking',
        'catatan_penyewa'
    ];

    /* RELATIONSHIP */
    // Booking dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Booking dimiliki oleh satu kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    // Booking memiliki satu pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_booking');
    }
}