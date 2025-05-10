<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilePreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bidang_usaha',
        'jenis_bantuan',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kalurahan',
    ];

    protected $casts = [
        'bidang_usaha' => 'array',
        'jenis_bantuan' => 'array',
    ];

    // Relasi jika ingin mengakses data user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
