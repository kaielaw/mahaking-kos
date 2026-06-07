<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'kos';

    // Primary key
    protected $primaryKey = 'id_kos';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_kos',
        'id_pemilik',
        'id_lokasi',
        'nama_kos',
        'alamat',
        'deskripsi',
        'tipe_kos',
        'jenis_kos',
        'harga_min',
        'harga_max',
        'jumlah_kamar',
        'jumlah_kamar_tersedia',
        'aturan_kos',
        'rating_rata2',
        'total_review',
        'status_ketersediaan',
        'status_verifikasi'
    ];

    /* RELATIONSHIP */
    // Kos dimiliki oleh satu pemilik kos
    public function pemilikKos()
    {
        return $this->belongsTo(PemilikKos::class, 'id_pemilik');
    }

    // Kos berada pada satu lokasi
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }

    // Kos memiliki banyak kamar
    public function kamar()
    {
        return $this->hasMany(Kamar::class, 'id_kos');
    }

    // Kos memiliki banyak detail fasilitas
    public function detailFasilitas()
    {
        return $this->hasMany(DetailFasilitas::class, 'id_kos');
    }

    // Kos memiliki banyak review
    public function review()
    {
        return $this->hasMany(Review::class, 'id_kos');
    }

    // Kos memiliki banyak wishlist
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id_kos');
    }

    // Kos memiliki banyak foto
    public function fotoKos()
    {
        return $this->hasMany(FotoKos::class, 'id_kos');
    }
}