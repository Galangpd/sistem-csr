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

        $user = Auth::user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
        
        $hasPreference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->exists();
        
        if (!$hasPreference) {
            return redirect()->route('penilaian.perusahaan');
        } else {
            $dataMasyarakat = $this->profileMatching();
            return view('perusahaan.index', compact('dataMasyarakat', 'user'));
        }
    
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
        $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
        $hasPreference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->exists();


        if (!$hasPreference) {
            $isEdit =  false;
            return view('perusahaan.penilaian', compact('user', 'isEdit'));
        }
    
        $isEdit =  true;
        return view('perusahaan.penilaian', compact('user', 'hasPreference', 'isEdit'));
    }

    public function storePreference(Request $request){

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
                'id_perusahaan' => $perusahaan->id,
                'bidang_usaha' => $request->bidang_usaha,
                'jenis_bantuan' => $request->jenis_bantuan,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kalurahan' => $request->kalurahan,
            ]);

            DB::commit();
        
        return redirect()->route('dashboard.perusahaan')->with('success', 'Preferensi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal update profil: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.' . $e->getMessage());
        }
    }

    public function updatePreference(Request $request)
    {
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
            $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
            $preference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->firstOrFail();

            $preference->update([
                    'id_perusahaan' => $perusahaan->id,
                    'bidang_usaha' => $request->bidang_usaha,
                    'jenis_bantuan' => $request->jenis_bantuan,
                    'provinsi' => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'kecamatan' => $request->kecamatan,
                    'kalurahan' => $request->kalurahan,
                ]);

            DB::commit();
            return redirect()->route('dashboard.perusahaan')->with('success', 'Preferensi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Gagal memperbarui preferensi: ' . $e->getMessage());
        }
    }

    public function profileMatching()
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::where('user_id', $user->id)->firstOrFail();
        $masyarakatList = Masyarakat::all();
        $preference = ProfilePreference::where('id_perusahaan', $perusahaan->id)->firstOrFail();

        $hasil = [];

        foreach ($masyarakatList as $masyarakat) {
            // Kriteria Bidang Usaha
            $result_bidang = $this->hitungGap($preference->bidang_usaha, $masyarakat->bidang_usaha);

            // Kriteria Jenis Bantuan
            $result_jenis = $this->hitungGap($preference->jenis_bantuan, $masyarakat->jenis_bantuan);

            // Kriteria Lokasi
            $gap_lokasi = $this->hitungGapLokasi(
                [
                    'kalurahan' => $perusahaan->kalurahan,
                    'kecamatan' => $perusahaan->kecamatan,
                    'kabupaten' => $perusahaan->kabupaten,
                    'provinsi' => $perusahaan->provinsi,
                ],
                [
                    'kalurahan' => $masyarakat->kalurahan,
                    'kecamatan' => $masyarakat->kecamatan,
                    'kabupaten' => $masyarakat->kabupaten,
                    'provinsi' => $masyarakat->provinsi,
                ]
            );

            $skor_lokasi = $this->konversiNilaiGap($gap_lokasi);

            // Total skor akhir
            $total_skor = $result_bidang['skor'] + $result_jenis['skor'] + $skor_lokasi;

            $hasil[] = [
                'id_masyarakat' => $masyarakat->id,
                'logo' => $masyarakat->logo,
                'nama_masyarakat' => $masyarakat->nama_masyarakat,
                'bidang_usaha' => $masyarakat->bidang_usaha,
                'jenis_bantuan' => $masyarakat->jenis_bantuan,
                'alamat' => $masyarakat->alamat,
                'total_skor' => $total_skor,
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

        $gap = abs($bobot_ideal - $bobot_masyarakat);

        return [
            'gap' => $gap,
            'skor' => $this->konversiNilaiGap($gap),
        ];
    }

    private function hitungGapLokasi($lokasiPerusahaan, $lokasiMasyarakat)
    {
        if ($lokasiPerusahaan['kalurahan'] === $lokasiMasyarakat['kalurahan']) {
            return 0;
        }

        if ($lokasiPerusahaan['kecamatan'] === $lokasiMasyarakat['kecamatan']) {
            return 1;
        }

        if ($lokasiPerusahaan['kabupaten'] === $lokasiMasyarakat['kabupaten']) {
            return 2;
        }

        if ($lokasiPerusahaan['provinsi'] === $lokasiMasyarakat['provinsi']) {
            return 3;
        }

        return 4;
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
