<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
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
    public function index(Request $request)
    {

        $user = Auth::user();
        $data = collect($this->profileMatching());
        $keyword = $request->search;

        if ($request->search) {
        $data = $data->filter(function ($item) use ($keyword) {
            return stripos($item['nama_perusahaan'], $keyword) !== false;
        });
        }
    
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
            'telepon' => 'required|string|max:16',
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
                'bidang_usaha_id' => $request->bidang_usaha,
                'jenis_bantuan_id' => $request->jenis_bantuan,
                'alamat' => $request->alamat,
                'kalurahan_id' => $request->kalurahan,
                'kecamatan_id' => $request->kecamatan,
                'kabupaten_id' => $request->kabupaten,
                'provinsi_id' => $request->provinsi,
                'telepon' => $request->telepon,
            ]);

            DB::commit();
    
            return redirect()->back()->with('success', 'Profil Kelompok Masyarakat berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update profil: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    
    }

    public function detailPerusahaan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::findOrFail($id);


         return view('masyarakat.detailPerusahaan', compact('perusahaan', 'user'));
    }

    public function profileMatching()
    {
        $user = Auth::user();
        $masyarakat = Masyarakat::where('user_id', $user->id)->firstOrFail();
        $perusahaans = Perusahaan::all();
        $kriteriaMap = Kriteria::pluck('id', 'nama')->toArray();

        $hasil = [];

        foreach ($perusahaans as $perusahaan) {
            $preference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->first();

            $coreFactors = $preference->core_factor ?? [];
            $secondaryFactors = $preference->secondary_factor ?? [];
            $coreScore = 0;
            $secondaryScore = 0;

            if (!$preference) continue;

            // Kriteria bidang usaha
            $scoreBidang = $this->hitungGap($preference->bidang_usaha, $masyarakat->bidang_usaha_id);
            if (in_array($kriteriaMap['Bidang Usaha'], $coreFactors)) {
                $coreScore += $scoreBidang;
            } elseif (in_array($kriteriaMap['Bidang Usaha'], $secondaryFactors)) {
                $secondaryScore += $scoreBidang;
            }
            
            // Kriteria jenis bantuan
            $scoreBantuan = $this->hitungGap($preference->jenis_bantuan, $masyarakat->jenis_bantuan_id);
            if (in_array($kriteriaMap['Jenis Bantuan'], $coreFactors)) {
                $coreScore += $scoreBantuan;
            } elseif (in_array($kriteriaMap['Jenis Bantuan'], $secondaryFactors)) {
                $secondaryScore += $scoreBantuan;
            }

            // Kriteria lokasi
            $scoreLokasi = $this->hitungGapLokasi($preference, $masyarakat);
            if (in_array($kriteriaMap['Lokasi'], $coreFactors)) {
                $coreScore += $scoreLokasi;
            } elseif (in_array($kriteriaMap['Lokasi'], $secondaryFactors)) {
                $secondaryScore += $scoreLokasi;
            }

            // Menghitung total score
            $coreAvg = count($coreFactors) ? ($coreScore / count($coreFactors)) : 0;
            $secondaryAvg = count($secondaryFactors) ? ($secondaryScore / count($secondaryFactors)) : 0;

            $totalScore = ($coreAvg * 0.6) + ($secondaryAvg * 0.4);

            $hasil[] = [
                'id_perusahaan' => $perusahaan->id,
                'logo' => $perusahaan->logo,
                'nama_perusahaan' => $perusahaan->nama_perusahaan,
                'bidang_usaha' => $perusahaan->bidang_usaha,
                'alamat' => $perusahaan->alamat,
                'total_skor' => $totalScore,
            ];
        }

        // Urutkan dari skor tertinggi
        usort($hasil, fn($a, $b) => $b['total_skor'] <=> $a['total_skor']);

        return $hasil;
    }

    private function hitungGap(array $prioritas, $nilai)
    {
        $bobot_prioritas = [];
        $total = count($prioritas);

        foreach ($prioritas as $i => $item) {
            $bobot_prioritas[$item] = $total - $i;
        }

        $bobot_ideal = $bobot_prioritas[$prioritas[0]] ?? 0;
        $bobot_nilai = $bobot_prioritas[$nilai] ?? 0;

        $gap = $bobot_ideal - $bobot_nilai;

        $skor = $this->konversiNilaiGap($gap);

        return $skor;
    }

    private function hitungGapLokasi($perusahaan, $masyarakat): float
    {
        if ($perusahaan->kalurahan_id === $masyarakat->kalurahan_id) return $this->konversiNilaiGap(0);
        if ($perusahaan->kecamatan_id === $masyarakat->kecamatan_id) return $this->konversiNilaiGap(1);
        if ($perusahaan->kabupaten_id === $masyarakat->kabupaten_id) return $this->konversiNilaiGap(2);
        if ($perusahaan->provinsi_id === $masyarakat->provinsi_id) return $this->konversiNilaiGap(3);
        return $this->konversiNilaiGap(4);
    }

    private function konversiNilaiGap($gap)
    {
        $skorMap = [
            0 => 5,
            1 => 4.5,
            -1 => 4,
            2 => 3.5,
            -2 => 3,
            3 => 2.5,
            -3 => 2,
            4 => 1.5,
            -4 => 1,
        ];

        return $skorMap[$gap] ?? 0;
    }

}
