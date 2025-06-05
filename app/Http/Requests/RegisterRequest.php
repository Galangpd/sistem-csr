<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'nama_masyarakat' => 'required|string',
            'nama_perusahaan' => 'required|string',
            'bidang_usaha' => 'required|string',
            'jenis_bantuan' => 'required|string',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kalurahan' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama_masyarakat.required' => 'Nama kelompok masyarakat harus diisi',
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
            'provinsi.required' => 'Provinsi harus dipilih',
            'kabupaten.required' => 'Kabupaten harus dipilih',
            'kecamatan.required' => 'Kecamatan harus dipilih',
            'kalurahan.required' => 'Kalurahan harus dipilih',
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Password tidak sesuai',
            'alamat.required' => 'Alamat harus diisi',
            'bidang_usaha.required' => 'Bidang usaha harus diisi',
            'jenis_bantuan.required' => 'Jenis bantuan harus dipilih',
        ];
    }
}
