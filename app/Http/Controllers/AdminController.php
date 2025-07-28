<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Masyarakat;
use App\Models\Perusahaan;
use App\Models\BidangUsaha;
use App\Models\JenisBantuan;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\City;
use App\Http\Controllers\Controller;
use App\Mail\ApproveMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravolt\Indonesia\Models\Village;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::user()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }
        }

        return view('admin.login');
    }

    public function login(Request $request){
            $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Login berhasil sebagai Admin!');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Anda tidak memiliki akses sebagai admin.',
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Kredensial tidak cocok dengan data kami.',
        ]);
    }

    public function index(){

        $user = Auth::user();
        $perusahaan = Perusahaan::whereHas('user', function ($query) {
            $query->where('status', 'approved');
        })->count();
        $masyarakat = Masyarakat::whereHas('user', function ($query) {
            $query->where('status', 'approved');
        })->count();

        return view('admin.dashboard', compact('perusahaan', 'masyarakat', 'user',));
    }

    public function pendaftaranPerusahaan(Request $request){
        $user = Auth::user();

        $keyword = $request->search;

        $perusahaan = User::with('perusahaan')
        ->whereHas('perusahaan', function ($query) use ($keyword) {
            $query->where('nama_perusahaan', 'LIKE', "%{$keyword}%");
        })
        ->get();

        $data = [
            'user' => $user,
            'perusahaans' => $perusahaan
        ];

        return view('admin.pendaftaran-perusahaan', $data);
    }

    public function pendaftaranMasyarakat(Request $request){
        $user = Auth::user();

        $keyword = $request->search;

        $masyarakat = User::with('masyarakat')
        ->whereHas('masyarakat', function ($query) use ($keyword) {
            $query->where('nama_masyarakat', 'LIKE', "%{$keyword}%");
        })
        ->get();

        $data = [
            'user' => $user,
            'masyarakats' => $masyarakat
        ];

        return view('admin.pendaftaran-masyarakat', $data);
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->verified_at = now();
        $user->save();

        Mail::to($user->email)->send(new ApproveMail($user));

        return redirect()->back()->with('success', 'Akun berhasil disetujui.');
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->verified_at = now();
        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil ditolak.');
    }

    public function perusahaan(Request $request)
    {

        $user = Auth::user();
        $data = Perusahaan::whereHas('user', function ($query) {
            $query->where('status', 'approved');
        })->get();
        $keyword = $request->search;

        if ($request->search) {
        $data = $data->filter(function ($item) use ($keyword) {
            return stripos($item['nama_perusahaan'], $keyword) !== false;
        });
        }
    
        return view('admin.perusahaan', compact('data', 'user'));
    }

    public function masyarakat(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->search;

        $masyarakat = Masyarakat::whereHas('user', function ($query) {
            $query->where('status', 'approved');
        })->with('bidang_usaha', 'jenis_bantuan')
            ->when($keyword, function ($query, $keyword) {
                $query->where('nama_masyarakat', 'LIKE', "%{$keyword}%");
            })
            ->get();

        $data = [
            'user' => $user,
            'masyarakats' => $masyarakat
        ];

        return view('admin.masyarakat', $data);
    }

    public function kriteria(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->search;

        $kriteria = Kriteria::when($keyword, function ($query, $keyword) {
            return $query->where('nama', 'LIKE', "%{$keyword}%");
        })->get();

        $data = [
            'user' => $user,
            'kriterias' => $kriteria
        ];

        return view('admin.kriteria', $data);
    }


    public function detailPerusahaan($id)
    {
        $user = Auth::user();
        $perusahaan = Perusahaan::findOrFail($id);


         return view('admin.detailPerusahaan', compact('perusahaan', 'user'));
    }

    public function detailMasyarakat($id)
    {
        $user = Auth::user();
        $masyarakat = Masyarakat::with('bidang_usaha', 'jenis_bantuan', 'provinsi', 'kabupaten', 'kecamatan', 'kalurahan')->findOrFail($id);

        $data = [
            'user' => $user,
            'masyarakat' => $masyarakat
        ];

        // dd($data);

         return view('admin.detailMasyarakat', $data);
    }

    public function bidangUsaha(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->search;
        $kriteria = BidangUsaha::when($keyword, function ($query, $keyword) {
            return $query->where('nama', 'LIKE', "%{$keyword}%");
        })->get();

        $data = [
            'user' => $user,
            'kriterias' => $kriteria,
            'route' => 'bidangUsaha.kriteria.admin',
            'create' => 'create.bidangUsaha.admin'
        ];

        return view('admin.detailKriteria', $data);
    }

    public function jenisBantuan(Request $request)
    {
        $user = Auth::user();
        $keyword = $request->search;
        $kriteria = JenisBantuan::when($keyword, function ($query, $keyword) {
            return $query->where('nama', 'LIKE', "%{$keyword}%");
        })->get();

        $data = [
            'user' => $user,
            'kriterias' => $kriteria,
            'route' => 'jenisBantuan.kriteria.admin',
            'create' => 'create.jenisBantuan.admin'
        ];

        return view('admin.detailKriteria', $data);
    }

    public function tambahBidang(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:bidang_usahas,nama',
        ]);

        BidangUsaha::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('bidangUsaha.kriteria.admin')
                        ->with('success', 'Data bidang usaha berhasil ditambahkan.');
    }

    public function tambahBantuan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_bantuans,nama',
        ]);

        JenisBantuan::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('jenisBantuan.kriteria.admin')
                        ->with('success', 'Data jenis bantuan berhasil ditambahkan.');
    }

    // public function updateBidang(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:255|unique:bidang_usahas,nama,' . $id,
    //     ]);

    //     $bidangUsaha = BidangUsaha::findOrFail($id);

    //     $bidangUsaha->update([
    //         'nama' => $validated['nama']
    //     ]);

    //     return redirect()->back()->with('success', 'Data berhasil diperbarui');
    // }

    // public function updateBantuan(Request $request, $id)
    // {
    //     $kriteria = JenisBantuan::findOrFail($id);
    //     $kriteria->update([
    //         'nama' => $request->nama
    //     ]);

    //     return redirect()->back()->with('success', 'Data berhasil diperbarui');
    // }

    // public function hapusBidang($id)
    // {
    //     $kriteria = BidangUsaha::findOrFail($id);
    //     $kriteria->delete();

    //     return redirect()->back()->with('success', 'Data berhasil dihapus');
    // }

    // public function hapusBantuan($id)
    // {
    //     $kriteria = JenisBantuan::findOrFail($id);
    //     $kriteria->delete();

    //     return redirect()->back()->with('success', 'Data berhasil dihapus');
    // }
}
