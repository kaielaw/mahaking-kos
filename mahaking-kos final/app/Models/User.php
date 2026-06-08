<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /* ══════════════════════════════════════════
     * TABLE CONFIGURATION
     * ══════════════════════════════════════════ */
    protected $table        = 'user';
    protected $primaryKey   = 'id_user';
    public    $incrementing = false;
    protected $keyType      = 'string';

    /* ══════════════════════════════════════════
     * MASS ASSIGNMENT
     * ══════════════════════════════════════════ */
    protected $fillable = [
        'id_user',
        'nama_depan',
        'nama_belakang',
        'email',
        'password',
        'nomor_hp',
        'foto_profil',
        'role',
    ];

    /* ══════════════════════════════════════════
     * HIDDEN
     * ══════════════════════════════════════════ */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* ══════════════════════════════════════════
     * CASTS
     * ══════════════════════════════════════════ */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /* ══════════════════════════════════════════
     * AUTH IDENTIFIER OVERRIDE
     * WAJIB ada supaya Laravel session guard bisa
     * simpan & retrieve user pakai id_user,
     * bukan kolom 'id' yang tidak ada di tabel.
     * ══════════════════════════════════════════ */
    public function getAuthIdentifierName(): string
    {
        return 'id_user';
    }

    public function getAuthIdentifier(): string
    {
        return $this->id_user;
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    /* ══════════════════════════════════════════
     * ACCESSORS
     * ══════════════════════════════════════════ */
    public function getNamaAttribute(): string
    {
        return trim($this->nama_depan . ' ' . $this->nama_belakang);
    }

    public function getNoHpAttribute(): string
    {
        return $this->nomor_hp ?? '';
    }

    public function getFotoProfilUrlAttribute(): string
    {
        if (!$this->foto_profil || $this->foto_profil === 'default.jpg') {
            return 'https://ui-avatars.com/api/?name=' . urlencode($this->nama_depan) . '&background=C9A84C&color=1a2035&size=128';
        }
        if (str_starts_with($this->foto_profil, 'http')) {
            return $this->foto_profil;
        }
        return asset('storage/' . $this->foto_profil);
    }

    /* ══════════════════════════════════════════
     * HELPERS
     * ══════════════════════════════════════════ */
    public function isPemilik(): bool { return $this->role === 'pemilik'; }
    public function isPenyewa(): bool { return $this->role === 'penyewa'; }

    /* ══════════════════════════════════════════
     * RELATIONSHIPS
     * ══════════════════════════════════════════ */
    public function pemilikKos()
    {
        return $this->hasOne(PemilikKos::class, 'id_user', 'id_user');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_user', 'id_user');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'id_user', 'id_user');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id_user', 'id_user');
    }
}