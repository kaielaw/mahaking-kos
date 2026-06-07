<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailFasilitas extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'detail_fasilitas';

    // Primary key
    protected $primaryKey = 'id_detail_fasilitas';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_detail_fasilitas',
        'id_kos',
        'id_fasilitas',
        'keterangan'
    ];

    /* RELATIONSHIP */
    // Detail fasilitas dimiliki oleh satu kos
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }

    // Detail fasilitas dimiliki oleh satu fasilitas
    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas');
    }
}