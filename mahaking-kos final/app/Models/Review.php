<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Review extends Model
{
    protected $table      = 'review';
    protected $primaryKey = 'id_review';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_review',
        'id_user',
        'id_kos',
        'rating',           // decimal(2,1) → bisa 4.5, 5.0, dst
        'komentar',
        'tanggal_review',
    ];

    protected $casts = [
        'rating'         => 'float',    // decimal(2,1) di migration
        'tanggal_review' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_review)) {
                $model->id_review = 'RVW-' . strtoupper(Str::random(6));
            }
            if (empty($model->tanggal_review)) {
                $model->tanggal_review = now();
            }
        });
    }

    public function user() { return $this->belongsTo(User::class, 'id_user'); }
    public function kos()  { return $this->belongsTo(Kos::class, 'id_kos'); }
}