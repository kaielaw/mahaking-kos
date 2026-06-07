<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $table      = 'booking';
    protected $primaryKey = 'id_booking';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_booking',
        'id_user',
        'id_kamar',
        'tanggal_booking',
        'tanggal_masuk',
        'tanggal_keluar',
        'total_harga',
        'status_booking',   // enum: pending | diterima | dibatalkan | selesai
        'catatan_penyewa',
    ];

    protected $casts = [
        'tanggal_booking' => 'datetime',
        'tanggal_masuk'   => 'date',
        'tanggal_keluar'  => 'date',
        'total_harga'     => 'float',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_booking)) {
                $model->id_booking = 'BKG-' . strtoupper(Str::random(6));
            }
            if (empty($model->status_booking)) {
                $model->status_booking = 'pending';
            }
        });
    }

    public function user()    { return $this->belongsTo(User::class, 'id_user'); }
    public function kamar()   { return $this->belongsTo(Kamar::class, 'id_kamar'); }
    public function pembayaran() { return $this->hasOne(Pembayaran::class, 'id_booking'); }
}