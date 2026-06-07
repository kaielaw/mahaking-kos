<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'kamar';

    // Primary key
    protected $primaryKey = 'id_kamar';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_kamar',
        'id_kos',
        'nomor_kamar',
        'harga_per_bulan',
        'harga_per_tahun',
        'ukuran',
        'tipe_kamar',
        'ketersediaan_kamar'
    ];

    /* RELATIONSHIP */
    // Kamar dimiliki oleh satu kos
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }

    // Kamar memiliki banyak booking
    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_kamar');
    }
}