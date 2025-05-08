<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user = Auth::user();
        $data = null;
    
        if ($user->role === 'perusahaan') {
            $data = Perusahaan::where('user_id', $user->id)->first();
        } elseif ($user->role === 'masyarakat') {
            $data = Masyarakat::where('user_id', $user->id)->first();
        }
    
        return view('settings.index', compact('data', 'user'));
    }

    public function updateUser(Request $request){
        $request->validate([
        'username' => 'required|string|unique:users,username,' . Auth::id(),
        'password' => 'nullable|string|min:6|confirmed',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            $updateData = [
                'username' => $request->username,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            DB::commit();

            return redirect()->back()->with('success', 'Data Pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data user.');
        }
    }
}
