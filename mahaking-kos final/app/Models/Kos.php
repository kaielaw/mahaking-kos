<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kos extends Model
{
    /* ═══════════════════════════════════════════
     * TABLE CONFIGURATION
     * ═══════════════════════════════════════════ */
    protected $table      = 'kos';
    protected $primaryKey = 'id_kos';
    public    $incrementing = false;
    protected $keyType    = 'string';

    /* ═══════════════════════════════════════════
     * MASS ASSIGNMENT
     * ═══════════════════════════════════════════ */
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
        'status_verifikasi',
    ];

    /* ═══════════════════════════════════════════
     * CASTS
     * ═══════════════════════════════════════════ */
    protected $casts = [
        'harga_min'             => 'float',
        'harga_max'             => 'float',
        'rating_rata2'          => 'float',
        'jumlah_kamar'          => 'integer',
        'jumlah_kamar_tersedia' => 'integer',
        'total_review'          => 'integer',
    ];

    /* ═══════════════════════════════════════════
     * BOOT — Auto-generate PK
     * ═══════════════════════════════════════════ */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_kos)) {
                $model->id_kos = 'KOS-' . strtoupper(Str::random(8));
            }
        });
    }

    /* ═══════════════════════════════════════════
     * SCOPES
     * ═══════════════════════════════════════════ */

    /** Hanya kos yang statusnya tersedia */
    public function scopeTersedia($query)
    {
        return $query->where('status_ketersediaan', 'tersedia');
    }

    /** Filter berdasarkan jenis (putra/putri/campur) */
    public function scopeJenis($query, string $jenis)
    {
        return $query->where('jenis_kos', $jenis);
    }

    /* ═══════════════════════════════════════════
     * ACCESSORS
     * ═══════════════════════════════════════════ */

    /** Update jumlah kamar tersedia dari relasi secara real-time */
    public function getJumlahTersediaRealAttribute(): int
    {
        return $this->kamar->where('ketersediaan_kamar', 'tersedia')->count();
    }

    /* ═══════════════════════════════════════════
     * RELATIONSHIPS
     * ═══════════════════════════════════════════ */

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

    // Alias reviews (kompatibel dengan controller lama)
    public function reviews()
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