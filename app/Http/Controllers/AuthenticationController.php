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
use App\Http\Requests\RegisterRequest;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

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
            'bidang_usaha' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'email' => 'required|string|unique:users,email',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'perusahaan',
            ]);

            Perusahaan::create([
                'user_id' => $user->id,
                'nama_perusahaan' => $request->nama_perusahaan,
                'bidang_usaha' => $request->bidang_usaha,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => $request->email,
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Registrasi akun berhasil! Tunggu akun anda diverifikasi terlebih dahulu');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registrasi Gagal: ' . $e->getMessage());
        }
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
            'telepon' => 'required|string',
            'email' => 'required|string|unique:users,email',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'masyarakat',
            ]);

            Masyarakat::create([
                'user_id' => $user->id,
                'nama_masyarakat' => $request->nama_masyarakat,
                'bidang_usaha_id' => $request->bidang_usaha,
                'jenis_bantuan_id' => $request->jenis_bantuan,
                'alamat' => $request->alamat,
                'provinsi_id' => $request->provinsi,
                'kabupaten_id' => $request->kabupaten,
                'kecamatan_id' => $request->kecamatan,
                'kalurahan_id' => $request->kalurahan,
                'telepon' => $request->telepon,
                'email' => $request->email,
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Registrasi akun berhasil! Tunggu akun anda diverifikasi terlebih dahulu');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registrasi Gagal: ' . $e->getMessage());
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
                $user = Auth::user();

                if ($user->status === 'rejected') {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Akun Anda telah ditolak dan tidak dapat login.');
                }

                if ($user->status === 'pending') {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Akun Anda belum disetujui oleh admin.');
                }

                $request->session()->regenerate();
        
                $role = Auth::user()->role;
        
                return match ($role) {
                    'perusahaan' => redirect()->route('dashboard.perusahaan')->with('success', 'Login berhasil sebagai Perusahaan!'),
                    'masyarakat' => redirect()->route('dashboard.masyarakat')->with('success', 'Login berhasil sebagai Masyarakat!'),
                    default => redirect()->back()->with('error', 'Role pengguna tidak dikenali.'),
                };
            }
        
            return redirect()->back()->with('error', 'Gagal login! Username atau password salah');
        
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function resetPassword()
    {
        return view('auth.resetPassword');
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('error', 'Email tidak terdaftar.')->withErrors($e->errors());
        }


        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.newPassword', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil diperbarui.');
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    
}
