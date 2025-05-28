<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Masyarakat;
use App\Models\Perusahaan;
use App\Models\BidangUsaha;
use App\Models\JenisBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravolt\Indonesia\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        if (Auth::user()) {
            $user = Auth::user();

            if ($user->role === 'perusahaan') {
                return redirect()->route('dashboard.perusahaan');
            } elseif ($user->role === 'masyarakat') {
                return redirect()->route('dashboard.masyarakat');
            }
        }

        return view('auth.login');
    }

    public function showRegisterPerusahaan()
    {

        return view('auth.registerPerusahaan');
    }

    public function showRegisterMasyarakat()
    {
        $bidangUsaha = BidangUsaha::all();
        $jenisBantuan = JenisBantuan::all();
        $provinsi = Province::all();

        return view('auth.registerMasyarakat', compact(
            'bidangUsaha',
            'jenisBantuan',
            'provinsi',
        ));
    }

    public function registerPerusahaan(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'nama_perusahaan' => 'required|string',
            'bidang_usaha' => 'nullable|string',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'perusahaan',
        ]);

        Perusahaan::create([
            'user_id' => $user->id,
            'nama_perusahaan' => $request->nama_perusahaan,
            'bidang_usaha' => $request->bidang_usaha,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi perusahaan berhasil!');
    }

    public function registerMasyarakat(Request $request)
    {
        $request->validate([
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:6|confirmed',
        'nama_masyarakat' => 'required|string',
        'bidang_usaha' => 'required|string',
        'jenis_bantuan' => 'required|string',
        'alamat' => 'required|string',
        'provinsi' => 'required|string',
        'kabupaten' => 'required|string',
        'kecamatan' => 'required|string',
        'kalurahan' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'masyarakat',
            ]);

            Masyarakat::create([
                'user_id' => $user->id,
                'nama_masyarakat' => $request->nama_masyarakat,
                'bidang_usaha' => $request->bidang_usaha,
                'jenis_bantuan' => $request->jenis_bantuan,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kalurahan' => $request->kalurahan,
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Registrasi kelompok masyarakat berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registrasi Gagal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Registrasi Gagal: ' . $e->getMessage());
        }
        

        
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => ['required', 'string'],
                'password' => ['required', 'string'],
            ]);
        
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
        
                $role = Auth::user()->role;
        
                return match ($role) {
                    'perusahaan' => redirect()->route('dashboard.perusahaan')->with('success', 'Login berhasil sebagai Perusahaan!'),
                    'masyarakat' => redirect()->route('dashboard.masyarakat')->with('success', 'Login berhasil sebagai Masyarakat!'),
                    default => throw new \Exception('Role tidak dikenali')
                };
            }
        
            return redirect()->back()->with('error', 'Gagal login! Username atau password salah');
        
        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
        
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
    
}
