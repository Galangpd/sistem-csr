<?php

namespace App\Models;

use App\Models\Perusahaan;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilePreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_perusahaan',
        'core_factor',
        'secondary_factor',
        'bidang_usaha',
        'jenis_bantuan',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kalurahan',
    ];

    protected $casts = [
        'core_factor' => 'array',
        'secondary_factor' => 'array',
        'bidang_usaha' => 'array',
        'jenis_bantuan' => 'array',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
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
