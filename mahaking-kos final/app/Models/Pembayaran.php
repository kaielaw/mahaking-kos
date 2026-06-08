<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    protected $table      = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_pembayaran',
        'id_booking',
        'metode_pembayaran',
        'nama_bank',
        'nomor_rekening',
        'nama_rekening',
        'biaya_sewa',
        'biaya_admin',
        'jumlah',
        'tanggal_bayar',
        'bukti_pembayaran',
        'status_pembayaran',  // enum: pending | dibayar | gagal
    ];

    protected $casts = [
        'biaya_sewa'    => 'float',
        'biaya_admin'   => 'float',
        'jumlah'        => 'float',
        'tanggal_bayar' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_pembayaran)) {
                $model->id_pembayaran = 'PAY-' . strtoupper(Str::random(6));
            }
            if (empty($model->status_pembayaran)) {
                $model->status_pembayaran = 'pending';
            }
        });
    }

    public function booking() { return $this->belongsTo(Booking::class, 'id_booking'); }
}