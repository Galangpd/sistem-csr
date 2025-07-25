<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nama_perusahaan', 
        'logo',
        'bidang_usaha',
        'alamat',
        'email',
        'telepon',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function profilePreference(){
        return $this->hasOne(ProfilePreference::class);
    }
}
