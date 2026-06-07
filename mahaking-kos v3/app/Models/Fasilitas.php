<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Fasilitas extends Model
{
    /* ═══════════════════════════════════════════
     * TABLE CONFIGURATION
     * ═══════════════════════════════════════════ */
    protected $table      = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    public    $incrementing = false;
    protected $keyType    = 'string';

    /* ═══════════════════════════════════════════
     * MASS ASSIGNMENT
     * ═══════════════════════════════════════════ */
    protected $fillable = [
        'id_fasilitas',
        'nama_fasilitas',
    ];

    /* ═══════════════════════════════════════════
     * BOOT — Auto-generate PK
     * ═══════════════════════════════════════════ */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_fasilitas)) {
                $model->id_fasilitas = 'FAS-' . strtoupper(Str::random(8));
            }
        });
    }

    /* ═══════════════════════════════════════════
     * RELATIONSHIPS
     * ═══════════════════════════════════════════ */

    // Fasilitas memiliki banyak detail fasilitas (pivot ke kos)
    public function detailFasilitas()
    {
        return $this->hasMany(DetailFasilitas::class, 'id_fasilitas');
    }
}