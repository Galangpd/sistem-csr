<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Perusahaan;
use App\Models\BidangUsaha;
use App\Models\JenisBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class SettingController extends Controller
{
    public function perusahaan(){
    
        $user = Auth::user();
        $data = null;
    
        $data = Perusahaan::where('user_id', $user->id)->first();
    
        return view('perusahaan.setting', compact('data', 'user'));
    }

    public function masyarakat(){
    
        $user = Auth::user();
        $bidangUsaha = BidangUsaha::all();
        $jenisBantuan = JenisBantuan::all();
        $provinsi = Province::all();
        $data = null;
    
        $data = Masyarakat::where('user_id', $user->id)->first();
        $kabupaten = City::where('province_code', $data->provinsi)->get();
        $kecamatan = District::where('city_code', $data->kabupaten)->get();
        $kalurahan = Village::where('district_code', $data->kecamatan)->get();
    
        return view('masyarakat.setting', compact('data', 'user', 'bidangUsaha', 'jenisBantuan', 'provinsi', 'kabupaten', 'kecamatan', 'kalurahan'));
    }

    public function updateUser(Request $request){
        $request->validate([
        'username' => 'required|string|unique:users,username,' . Auth::id(),
        'email' => 'required|email|unique:users,email,' . Auth::id(),
        'password' => 'nullable|string|min:6|confirmed',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            $updateData = [
                'username' => $request->username,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            if ($user->role === 'perusahaan') {
                $perusahaan = $user->perusahaan;
                if ($perusahaan) {
                    $perusahaan->update([
                        'email' => $request->email,
                    ]);
                }
            } elseif ($user->role === 'masyarakat') {
                $masyarakat = $user->masyarakat;
                if ($masyarakat) {
                    $masyarakat->update([
                        'email' => $request->email,
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Data Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data user.');
        }
    }
}
