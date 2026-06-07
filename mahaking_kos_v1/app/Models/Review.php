<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'review';

    // Primary key
    protected $primaryKey = 'id_review';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_review',
        'id_user',
        'id_kos',
        'rating',
        'komentar',
        'tanggal_review'
    ];

    /* RELATIONSHIP */
    // Review dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Review dimiliki oleh satu kos
    public function kos()
    {
        return $this->belongsTo(Kos::class, 'id_kos');
    }
}