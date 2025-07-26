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
        'bidang_usaha_id',
        'jenis_bantuan_id',
        'alamat',
        'email',
        'telepon',
        'provinsi_id', 
        'kabupaten_id', 
        'kecamatan_id', 
        'kalurahan_id', 
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bidang_usaha(){
        return $this->belongsTo(BidangUsaha::class, 'bidang_usaha_id', 'id');
    }

    public function jenis_bantuan(){
        return $this->belongsTo(JenisBantuan::class, 'jenis_bantuan_id', 'id');
    }
    public function provinsi(){
        return $this->belongsTo(Province::class, 'provinsi_id', 'code');
    }
    public function kabupaten(){
        return $this->belongsTo(City::class, 'kabupaten_id', 'code');
    }
    public function kecamatan(){
        return $this->belongsTo(District::class, 'kecamatan_id', 'code');
    }
    public function kalurahan(){
        return $this->belongsTo(Village::class, 'kalurahan_id', 'code');
    }
}
