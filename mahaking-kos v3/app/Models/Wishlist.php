<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wishlist extends Model
{
    /* ═══════════════════════════════════════════
     * TABLE CONFIGURATION
     * ═══════════════════════════════════════════ */
    protected $table      = 'wishlist';
    protected $primaryKey = 'id_favorit';
    public    $incrementing = false;
    protected $keyType    = 'string';

    /* ═══════════════════════════════════════════
     * MASS ASSIGNMENT
     * ═══════════════════════════════════════════ */
    protected $fillable = [
        'id_favorit',
        'id_user',
        'id_kos',
    ];

    /* ═══════════════════════════════════════════
     * BOOT — Auto-generate PK
     * ═══════════════════════════════════════════ */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id_favorit)) {
                $model->id_favorit = 'WSH-' . strtoupper(Str::random(8));
            }
        });
    }

    /* ═══════════════════════════════════════════
     * RELATIONSHIPS
     * ═══════════════════════════════════════════ */

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