<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;

class LokasiController extends Controller
{
    public function getKabupaten($provinsiId)
    {
        return response()->json(City::where('province_code', $provinsiId)->get());
    }

    public function getKecamatan($kabupatenId)
    {
        return response()->json(District::where('city_code', $kabupatenId)->get());
    }

    public function getKalurahan($kecamatanId)
    {
        return response()->json(Village::where('district_code', $kecamatanId)->get());
    }
}
