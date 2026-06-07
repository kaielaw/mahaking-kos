<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'wishlist';

    // Primary key
    protected $primaryKey = 'id_favorit';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_favorit',
        'id_user',
        'id_kos'
    ];

    /* RELATIONSHIP */
    // Wishlist dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Wishlist dimiliki oleh satu kos
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }
}