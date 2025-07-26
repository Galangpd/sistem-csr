<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Perusahaan;
use App\Models\BidangUsaha;
use App\Models\JenisBantuan;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::user()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }
        }

        return view('admin.login');
    }

    public function login(Request $request){
            $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Anda tidak memiliki akses sebagai admin.',
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Kredensial tidak cocok dengan data kami.',
        ]);
    }

    public function index(){

        $user = Auth::user();
        $perusahaan = Perusahaan::count();
        $masyarakat = Masyarakat::count();

        return view('admin.dashboard', compact('perusahaan', 'masyarakat', 'user',));
    }

    public function perusahaan(Request $request)
    {

        $user = Auth::user();
        $data = Perusahaan::all();
        $keyword = $request->search;

        if ($request->search) {
        $data = $data->filter(function ($item) use ($keyword) {
            return stripos($item['nama_perusahaan'], $keyword) !== false;
        });
        }
    
        return view('admin.perusahaan', compact('data', 'user'));
    }

    public function masyarakat(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->search;

        $masyarakat = Masyarakat::with('bidang_usaha', 'jenis_bantuan')
            ->when($keyword, function ($query, $keyword) {
                $query->where('nama_masyarakat', 'LIKE', "%{$keyword}%");
            })
            ->get();

        $data = [
            'user' => $user,
            'masyarakats' => $masyarakat
        ];

        return view('admin.masyarakat', $data);
    }


    public function detailPerusahaan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::findOrFail($id);


         return view('admin.detailPerusahaan', compact('perusahaan', 'user'));
    }

    public function detailMasyarakat($id)
    {
        $user = Auth::user();
        $masyarakat = Masyarakat::with('bidang_usaha', 'jenis_bantuan', 'provinsi', 'kabupaten', 'kecamatan', 'kalurahan')->findOrFail($id);

        $data = [
            'user' => $user,
            'masyarakat' => $masyarakat
        ];

        // dd($data);

         return view('admin.detailMasyarakat', $data);
    }
}
