<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function updateProfile(Request $request){
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kalurahan' => 'nullable|string|max:255',
        ]);
    
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $masyarakat = Masyarakat::where('user_id', $user->id)->first();
    
            if ($request->hasFile('photo')) {
                if ($masyarakat->logo) {
                    $oldPath = str_replace('storage/', '', $masyarakat->logo);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
            
                $path = $request->file('photo')->store('assets/profile', 'public');
                $masyarakat->logo = 'storage/' . $path;
            }
            
    
    
            $masyarakat->update([
                'nama_masyarakat' => $request->nama,
                'bidang_usaha' => $request->bidang_usaha,
                'alamat' => $request->alamat,
                'kalurahan' => $request->kalurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
            ]);

            DB::commit();
    
            return redirect()->back()->with('success', 'Profil Kelompok Masyarakat berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update profil: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    
    }

}
