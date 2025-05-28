<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\ProfilePreference;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MasyarakatController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $data = $this->profileMatching();
    
        return view('masyarakat.index', compact('data', 'user'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required',
            'jenis_bantuan' => 'required',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kalurahan' => 'required',
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
                'jenis_bantuan' => $request->jenis_bantuan,
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

    public function profileMatching()
    {
        $user = Auth::user();
        $masyarakat = Masyarakat::where('user_id', $user->id)->firstOrFail();
        $perusahaans = Perusahaan::all();

        $hasil = [];

        foreach ($perusahaans as $perusahaan) {
            $preference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->first();

            if (!$preference) continue;

            // Hitung skor masing-masing kriteria
            $skor_bidang_usaha  = $this->hitungGap($preference->bidang_usaha, $masyarakat->bidang_usaha);
            $skor_jenis_bantuan = $this->hitungGap($preference->jenis_bantuan, $masyarakat->jenis_bantuan);
            $skor_wilayah       = $this->hitungGapLokasi($perusahaan, $masyarakat);

            // Hitung total skor
            $total_skor = $skor_bidang_usaha + $skor_jenis_bantuan + $skor_wilayah;

            $hasil[] = [
                'logo' => $perusahaan->logo,
                'nama_perusahaan' => $perusahaan->nama_perusahaan,
                'bidang_usaha' => $perusahaan->bidang_usaha,
                'jenis_bantuan' => $perusahaan->jenis_bantuan,
                'alamat' => $perusahaan->alamat,
                'total_skor' => $total_skor,
            ];
        }

        // Urutkan dari skor tertinggi
        usort($hasil, fn($a, $b) => $b['total_skor'] <=> $a['total_skor']);

        return $hasil;
    }

    private function hitungGap(array $prioritas, string $nilai): float
    {
        $bobot_prioritas = [];
        $total = count($prioritas);
        foreach ($prioritas as $i => $item) {
            $bobot_prioritas[$item] = $total - $i;
        }

        $bobot_ideal = $bobot_prioritas[$prioritas[0]] ?? 0;
        $bobot_nilai = $bobot_prioritas[$nilai] ?? 0;

        $gap = $bobot_ideal - $bobot_nilai;
        return $this->konversiNilaiGap($gap);
    }

    private function hitungGapLokasi($perusahaan, $masyarakat): float
    {
        if ($perusahaan->kalurahan === $masyarakat->kalurahan) return $this->konversiNilaiGap(0);
        if ($perusahaan->kecamatan === $masyarakat->kecamatan) return $this->konversiNilaiGap(1);
        if ($perusahaan->kabupaten === $masyarakat->kabupaten) return $this->konversiNilaiGap(2);
        if ($perusahaan->provinsi === $masyarakat->provinsi) return $this->konversiNilaiGap(3);
        return $this->konversiNilaiGap(4);
    }

    private function konversiNilaiGap($gap)
    {
        $skorMap = [
            0 => 5,
            1 => 4.5,
            2 => 3.5,
            3 => 2.5,
            4 => 1.5,
        ];

        return $skorMap[$gap] ?? 0;
    }

}
