<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Masyarakat;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\ProfilePreference;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $data = Masyarakat::all();
    
        return view('perusahaan.index', compact('data', 'user'));
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
            $perusahaan = Perusahaan::where('user_id', $user->id)->first();
    
            if ($request->hasFile('photo')) {
                if ($perusahaan->logo) {
                    $oldPath = str_replace('storage/', '', $perusahaan->logo);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }
            
                $path = $request->file('photo')->store('assets/profile', 'public');
                $perusahaan->logo = 'storage/' . $path;
            }
            
    
    
            $perusahaan->update([
                'nama_perusahaan' => $request->nama,
                'bidang_usaha' => $request->bidang_usaha,
                'alamat' => $request->alamat,
                'kalurahan' => $request->kalurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
            ]);

            DB::commit();
    
            return redirect()->back()->with('success', 'Profil Perusahaan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update profil: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    
    }

    public function showPenilaian ()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
    
        return view('perusahaan.penilaian', compact('user'));
    }

    public function profileMatching(Request $request){
        // dd($request->all());
        $request->validate([
            'jenis_bantuan' => 'required|array',
            'bidang_usaha' => 'required|array',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kalurahan' => 'required|string',
        ]);

         try {
            DB::beginTransaction();

        $user = Auth::user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->first();

        ProfilePreference::create([
            'user_id' => $perusahaan->id,
            'bidang_usaha' => $request->bidang_usaha,
            'jenis_bantuan' => $request->jenis_bantuan,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kalurahan' => $request->kalurahan,
        ]);

        DB::commit();
        
        return redirect()->back()->with('success', 'Preferensi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update profil: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.' . $e->getMessage());
        }

    }
}
