<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemilikKos extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'pemilik_kos';

    // Primary key
    protected $primaryKey = 'id_pemilik';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_pemilik',
        'id_user',
        'nama_depan',
        'nama_belakang',
        'nama_bank',
        'nomor_rekening',
        'nama_rekening',
        'no_hp',
        'alamat',
        'verifikasi_status'
    ];

    /* RELATIONSHIP */
    // Pemilik kos dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Pemilik kos memiliki banyak kos
    public function kos()
    {
        return $this->hasMany(Kos::class, 'id_pemilik');
    }
}