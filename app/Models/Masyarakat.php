<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class Masyarakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nama_masyarakat', 
        'logo',
        'bidang_usaha',
        'jenis_bantuan',
        'alamat',
        'email',
        'telepon',
        'provinsi', 
        'kabupaten', 
        'kecamatan', 
        'kalurahan', 
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bidang_usaha(){
        return $this->belongsTo(BidangUsaha::class, 'bidang_usaha');
    }

    public function jenis_bantuan(){
        return $this->belongsTo(JenisBantuan::class, 'jenis_bantuan');
    }
    public function provinsi(){
        return $this->belongsTo(Province::class, 'provinsi');
    }
    public function kabupaten(){
        return $this->belongsTo(City::class, 'kabupaten');
    }
    public function kecamatan(){
        return $this->belongsTo(District::class, 'kecamatan');
    }
    public function kalurahan(){
        return $this->belongsTo(Village::class, 'kalurahan');
    }
}
