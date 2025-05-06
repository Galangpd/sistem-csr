<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        if (Auth::user()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
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
                    'perusahaan' => redirect()->route('dashboard')->with('success', 'Login berhasil sebagai Perusahaan!'),
                    'masyarakat' => redirect()->route('dashboard')->with('success', 'Login berhasil sebagai Masyarakat!'),
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
