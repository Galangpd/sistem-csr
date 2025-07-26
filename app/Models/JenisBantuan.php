<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisBantuan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
    ];

    public function masyarakat()
    {
        return $this->hasMany(Masyarakat::class, 'jenis_bantuan');
    }
}
