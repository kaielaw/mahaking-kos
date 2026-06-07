<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'fasilitas';

    // Primary key
    protected $primaryKey = 'id_fasilitas';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_fasilitas',
        'nama_fasilitas'
    ];

    /* RELATIONSHIP */
    // Fasilitas memiliki banyak detail fasilitas
    public function detailFasilitas()
    {
        return $this->hasMany(DetailFasilitas::class, 'id_fasilitas');
    }
}