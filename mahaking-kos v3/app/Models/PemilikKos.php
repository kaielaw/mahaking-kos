<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PemilikKos extends Model
{
    /* ═══════════════════════════════════════════
     * TABLE CONFIGURATION
     * ═══════════════════════════════════════════ */
    protected $table      = 'pemilik_kos';
    protected $primaryKey = 'id_pemilik';
    public    $incrementing = false;
    protected $keyType    = 'string';

    /* ═══════════════════════════════════════════
     * MASS ASSIGNMENT
     * ═══════════════════════════════════════════ */
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
        'verifikasi_status',
    ];

    /* ═══════════════════════════════════════════
     * BOOT — Auto-generate PK
     * ═══════════════════════════════════════════ */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_pemilik)) {
                $model->id_pemilik = 'PMK-' . strtoupper(Str::random(8));
            }
        });
    }

    /* ═══════════════════════════════════════════
     * ACCESSORS
     * ═══════════════════════════════════════════ */

    /** Nama lengkap pemilik */
    public function getNamaLengkapAttribute(): string
    {
        return trim($this->nama_depan . ' ' . $this->nama_belakang);
    }

    /* ═══════════════════════════════════════════
     * RELATIONSHIPS
     * ═══════════════════════════════════════════ */

    // PemilikKos dimiliki oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // PemilikKos memiliki banyak kos
    public function kos()
    {
        return $this->hasMany(Kos::class, 'id_pemilik');
    }
}