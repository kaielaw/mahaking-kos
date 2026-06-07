<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lokasi extends Model
{
    /* ═══════════════════════════════════════════
     * TABLE CONFIGURATION
     * ═══════════════════════════════════════════ */
    protected $table      = 'lokasi';
    protected $primaryKey = 'id_lokasi';
    public    $incrementing = false;
    protected $keyType    = 'string';

    /* ═══════════════════════════════════════════
     * MASS ASSIGNMENT
     * ═══════════════════════════════════════════ */
    protected $fillable = [
        'id_lokasi',
        'kecamatan',
        'kota',
        'provinsi',
    ];

    /* ═══════════════════════════════════════════
     * BOOT — Auto-generate PK
     * ═══════════════════════════════════════════ */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_lokasi)) {
                $model->id_lokasi = 'LOK-' . strtoupper(Str::random(8));
            }
        });
    }

    /* ═══════════════════════════════════════════
     * ACCESSORS
     * ═══════════════════════════════════════════ */

    /** Alamat lengkap: Kecamatan, Kota, Provinsi */
    public function getAlamatLengkapAttribute(): string
    {
        return implode(', ', array_filter([
            $this->kecamatan,
            $this->kota,
            $this->provinsi,
        ]));
    }

    /* ═══════════════════════════════════════════
     * RELATIONSHIPS
     * ═══════════════════════════════════════════ */

    // Lokasi memiliki banyak kos
    public function kos()
    {
        return $this->hasMany(Kos::class, 'id_lokasi');
    }
}