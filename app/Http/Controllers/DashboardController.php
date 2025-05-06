<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role === 'perusahaan') {
            $data = Masyarakat::all();
        } elseif ($user->role === 'masyarakat') {
            $data = Perusahaan::all();
        } else {
            $data = [
                'perusahaan' => Perusahaan::all(),
                'masyarakat' => Masyarakat::all(),
            ];
        }
    
        return view('dashboard.index', compact('data', 'user'));
    }
}
