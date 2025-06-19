<?php

namespace App\Http\Controllers;

use App\Models\BidangUsaha;
use App\Models\JenisBantuan;
use App\Models\Kriteria;
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
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
        $keyword = $request->search;

        $hasPreference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->exists();

        if (!$hasPreference) {
            return redirect()->route('penilaian.perusahaan');
        }

        $dataMasyarakat = collect($this->profileMatching());

        if ($keyword) {
            $dataMasyarakat = $dataMasyarakat->filter(function ($item) use ($keyword) {
                return stripos($item['nama_masyarakat'], $keyword) !== false;
            });
        }

        return view('perusahaan.index', compact('dataMasyarakat', 'user', 'keyword'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
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
        $user = Auth::user();

        return view('perusahaan.penilaian', [
            'user' => $user,
            'provinsi' => Province::all(),
            'bidang_usaha' => BidangUsaha::all(),
            'jenis_bantuan' => JenisBantuan::all(),
            'kriteria' => Kriteria::all(),
        ]);
    }

    public function editPenilaian ()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
        $preference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->first();
        $kabupaten = City::where('province_code', $preference->provinsi)->get();
        $kecamatan = District::where('city_code', $preference->kabupaten)->get();
        $kalurahan = Village::where('district_code', $preference->kecamatan)->get();

        return view('perusahaan.editPenilaian', [
            'user' => $user,
            'provinsi' => Province::all(),
            'bidang_usaha' => BidangUsaha::all(),
            'jenis_bantuan' => JenisBantuan::all(),
            'kriteria' => Kriteria::all(),
            'preference' => $preference,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kalurahan' => $kalurahan,
        ]);
    }

    public function storePreference(Request $request)
    {
        $request->validate([
            'prioritas_kriteria' => 'required|array|min:1|max:2',
            'jenis_bantuan' => 'required|array',
            'bidang_usaha' => 'required|array',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kalurahan' => 'required|string',
        ]);

        $allKriteria = Kriteria::pluck('id')->toArray();

        $coreFactors = array_map('intval', $request->input('prioritas_kriteria', []));

        $secondaryFactors = array_values(array_diff($allKriteria, $coreFactors));

         try {
            DB::beginTransaction();

            $user = Auth::user();
            $perusahaan = Perusahaan::where('user_id', $user->id)->first();

            ProfilePreference::create([
                    'id_perusahaan' => $perusahaan->id,
                    'core_factor' => $coreFactors,
                    'secondary_factor' => $secondaryFactors,
                    'bidang_usaha' => array_map('intval', $request->bidang_usaha),
                    'jenis_bantuan' => array_map('intval', $request->jenis_bantuan),
                    'provinsi' => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'kecamatan' => $request->kecamatan,
                    'kalurahan' => $request->kalurahan,
                ]);

            DB::commit();
        
        return redirect()->route('dashboard.perusahaan')->with('success', 'Preferensi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan preferensi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan preferensi.' . $e->getMessage());
        }
    }

    public function updatePreference(Request $request)
    {
        $request->validate([
            'prioritas_kriteria' => 'required|array|min:1|max:2',
            'jenis_bantuan' => 'required|array',
            'bidang_usaha' => 'required|array',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kalurahan' => 'required|string',
        ]);

        $allKriteria = Kriteria::pluck('id')->toArray();

        $coreFactors = array_map('intval', $request->input('prioritas_kriteria', []));

        $secondaryFactors = array_values(array_diff($allKriteria, $coreFactors));

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
            $preference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->firstOrFail();

            $preference->update([
                    'id_perusahaan' => $perusahaan->id,
                    'core_factor' => $coreFactors,
                    'secondary_factor' => $secondaryFactors,
                    'bidang_usaha' => array_map('intval', $request->bidang_usaha),
                    'jenis_bantuan' => array_map('intval', $request->jenis_bantuan),
                    'provinsi' => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'kecamatan' => $request->kecamatan,
                    'kalurahan' => $request->kalurahan,
                ]);

            DB::commit();
            return redirect()->route('dashboard.perusahaan')->with('success', 'Preferensi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menambahkan preferensi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui preferensi: ' . $e->getMessage());
        }
    }

    public function detailMasyarakat($id)
    {
        $user = Auth::user();
        $masyarakat = Masyarakat::where('id', $id)->first();
        $bidangUsaha = BidangUsaha::where('id', $masyarakat->bidang_usaha)->first();
        $jenisBantuan = JenisBantuan::where('id', $masyarakat->jenis_bantuan)->first();
        $provinsi = Province::where('code', $masyarakat->provinsi)->first();
        $kabupaten = City::where('code', $masyarakat->kabupaten)->first();
        $kecamatan = District::where('code', $masyarakat->kecamatan)->first();
        $kalurahan = Village::where('code', $masyarakat->kalurahan)->first();


         return view('perusahaan.detailMasyarakat', compact('masyarakat', 'user', 'bidangUsaha', 'jenisBantuan', 'provinsi', 'kabupaten', 'kecamatan', 'kalurahan'));
    }

    public function profileMatching()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
        $masyarakatList = Masyarakat::all();
        $preference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->firstOrFail();
        $kriteriaMap = Kriteria::pluck('id', 'nama')->toArray();

        $coreFactors = $preference->core_factor ?? [];
        $secondaryFactors = $preference->secondary_factor ?? [];
        $bidangUsahaPref = $preference->bidang_usaha ?? [];
        $jenisBantuanPref = $preference->jenis_bantuan ?? [];
        
        $hasil = [];

        foreach ($masyarakatList as $masyarakat) {
            $coreScore = 0;
            $secondaryScore = 0;
            
            // Kriteria bidang usaha
            $scoreBidang = $this->hitungGap($bidangUsahaPref, $masyarakat->bidang_usaha);
            if (in_array($kriteriaMap['Bidang Usaha'], $coreFactors)) {
                $coreScore += $scoreBidang;
            } elseif (in_array($kriteriaMap['Bidang Usaha'], $secondaryFactors)) {
                $secondaryScore += $scoreBidang;
            }

            // Kriteria jenis bantuan
            $scoreJenis = $this->hitungGap($jenisBantuanPref, $masyarakat->jenis_bantuan);
            if (in_array($kriteriaMap['Jenis Bantuan'], $coreFactors)) {
                $coreScore += $scoreJenis;
            } elseif (in_array($kriteriaMap['Jenis Bantuan'], $secondaryFactors)) {
                $secondaryScore += $scoreJenis;
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

            $bidangUsaha = BidangUsaha::find($masyarakat->bidang_usaha);
            $jenisBantuan = JenisBantuan::find($masyarakat->jenis_bantuan);

            $hasil[] = [
                'id_masyarakat' => $masyarakat->id,
                'logo' => $masyarakat->logo,
                'nama_masyarakat' => $masyarakat->nama_masyarakat,
                'bidang_usaha' => $bidangUsaha->nama,
                'jenis_bantuan' => $jenisBantuan->nama,
                'alamat' => $masyarakat->alamat,
                'total_skor' => $totalScore,
            ];
        }

        // Mengurutkan hasil dari skor tertinggi ke terendah
        usort($hasil, fn($a, $b) => $b['total_skor'] <=> $a['total_skor']);

        return $hasil;
    }


    private function hitungGap(array $prioritas, $nilaiMasyarakat)
    {
        $bobot_prioritas = [];
        $total = count($prioritas);

        foreach ($prioritas as $index => $nilai) {
            $bobot_prioritas[$nilai] = $total - $index;
        }

        $bobot_ideal = $bobot_prioritas[$prioritas[0]] ?? 0;
        $bobot_masyarakat = $bobot_prioritas[$nilaiMasyarakat] ?? 0;

        $gap = $bobot_ideal - $bobot_masyarakat;

        $skor = $this->konversiNilaiGap($gap);

        return $skor;
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
