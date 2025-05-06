<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role === 'perusahaan') {
            $data = User::where('role', 'masyarakat')->with('masyarakat')->get();
        } elseif ($user->role === 'masyarakat') {
            $data = User::where('role', 'perusahaan')->with('perusahaan')->get();
        } else {
            $data = User::with(['perusahaan', 'masyarakat'])->get();
        }
    
        return view('dashboard.index', compact('data', 'user'));
    }
}
