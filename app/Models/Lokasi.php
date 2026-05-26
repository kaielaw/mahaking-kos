<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'lokasi';

    // Primary key
    protected $primaryKey = 'id_lokasi';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_lokasi',
        'kecamatan',
        'kota',
        'provinsi'
    ];

    /* RELATIONSHIP */
    // Lokasi memiliki banyak kos
    public function kos()
    {
        return $this->hasMany(Kos::class, 'id_lokasi');
    }
}