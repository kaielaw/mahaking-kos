<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoKos extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'foto_kos';

    // Primary key
    protected $primaryKey = 'id_foto';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_foto',
        'id_kos',
        'url_foto',
        'caption'
    ];

    /* RELATIONSHIP */
    // Foto kos dimiliki oleh satu kos
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }
}