<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Masyarakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nama_masyarakat', 
        'logo',
        'bidang_usaha',
        'alamat',
        'kalurahan', 
        'kecamatan', 
        'kabupaten', 
        'provinsi', 
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
