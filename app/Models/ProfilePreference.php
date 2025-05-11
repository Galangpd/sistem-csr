<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilePreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_perusahaan',
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

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
