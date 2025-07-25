<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    const ROLE_PERUSAHAAN = 'perusahaan';
    const ROLE_MASYARAKAT = 'masyarakat';

    public function isPerusahaan(): bool {
        return $this->role === self::ROLE_PERUSAHAAN;
    }

    public function isMasyarakat(): bool {
        return $this->role === self::ROLE_MASYARAKAT;
    }

    public function perusahaan() {
        return $this->hasOne(Perusahaan::class);
    }
    public function masyarakat() {
        return $this->hasOne(Masyarakat::class);
    }
}
