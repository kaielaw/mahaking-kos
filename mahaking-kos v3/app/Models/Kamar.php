<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kamar extends Model
{
    /* ═══════════════════════════════════════════
     * TABLE CONFIGURATION
     * ═══════════════════════════════════════════ */
    protected $table      = 'kamar';
    protected $primaryKey = 'id_kamar';
    public    $incrementing = false;
    protected $keyType    = 'string';

    /* ═══════════════════════════════════════════
     * MASS ASSIGNMENT
     * ═══════════════════════════════════════════ */
    protected $fillable = [
        'id_kamar',
        'id_kos',
        'nomor_kamar',
        'harga_per_bulan',
        'harga_per_tahun',
        'ukuran',
        'tipe_kamar',
        'ketersediaan_kamar',  // nilai: 'tersedia' | 'terisi'
    ];

    /* ═══════════════════════════════════════════
     * CASTS
     * ═══════════════════════════════════════════ */
    protected $casts = [
        'harga_per_bulan' => 'float',
        'harga_per_tahun' => 'float',
    ];

    /* ═══════════════════════════════════════════
     * BOOT — Auto-generate PK
     * ═══════════════════════════════════════════ */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_kamar)) {
                $model->id_kamar = 'KMR-' . strtoupper(Str::random(8));
            }
        });
    }

    /* ═══════════════════════════════════════════
     * ACCESSORS
     * ═══════════════════════════════════════════ */

    /**
     * Alias status_kamar → ketersediaan_kamar
     * supaya blade dan controller lama tetap bisa pakai $kamar->status_kamar
     */
    public function getStatusKamarAttribute(): string
    {
        return $this->ketersediaan_kamar ?? 'tersedia';
    }

    /** Cek apakah kamar tersedia */
    public function getTersediaAttribute(): bool
    {
        return $this->ketersediaan_kamar === 'tersedia';
    }

    /* ═══════════════════════════════════════════
     * SCOPES
     * ═══════════════════════════════════════════ */

    public function scopeTersedia($query)
    {
        return $query->where('ketersediaan_kamar', 'tersedia');
    }

    public function scopeTerisi($query)
    {
        return $query->where('ketersediaan_kamar', 'terisi');
    }

    /* ═══════════════════════════════════════════
     * RELATIONSHIPS
     * ═══════════════════════════════════════════ */

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