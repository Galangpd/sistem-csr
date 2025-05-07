<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasyarakatController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $data = Perusahaan::all();
    
        return view('masyarakat.index', compact('data', 'user'));
    }

    public function settingProfile(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $data = Masyarakat::where('user_id', $user->id)->first();

        return view('settings.index', compact('data', 'user'));
    }
}
