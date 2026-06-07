<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'id_user',
    'nama_depan',
    'nama_belakang',
    'email',
    'password',
    'nomor_hp',
    'foto_profil',
    'role'
])]

#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /* TABLE CONFIGURATION */
    // Nama tabel
    protected $table = 'user';

    // Primary key
    protected $primaryKey = 'id_user';

    // PK bukan auto increment
    public $incrementing = false;

    // PK bertipe string
    protected $keyType = 'string';

    /* MASS ASSIGNMENT */
    protected $fillable = [
        'id_user',
        'nama_depan',
        'nama_belakang',
        'email',
        'password',
        'nomor_hp',
        'foto_profil',
        'role'
    ];

    /* HIDDEN ATTRIBUTE */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /* RELATIONSHIP */
    // User memiliki satu data pemilik kos
    public function pemilikKos()
    {
        return $this->hasOne(PemilikKos::class, 'id_user');
    }

    // User memiliki banyak booking
    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_user');
    }

    // User memiliki banyak review
    public function review()
    {
        return $this->hasMany(Review::class, 'id_user');
    }

    // User memiliki banyak wishlist
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'id_user');
    }
}
