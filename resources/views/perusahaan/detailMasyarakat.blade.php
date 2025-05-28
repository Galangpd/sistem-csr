@extends('template.dashboard')
@section('konten')

<div class="p-4 mt-0 lg:mt-16">
    <div>
        <h1 class="font-bold font-blue-500 md:text-md lg:text-2xl text-black">Detail Masyarakat</h1>
    </div>
</div>

<div class="rounded-2xl border border-gray-300 shadow-lg bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

      <div class="flex flex-col items-center gap-5 xl:flex-row xl:justify-between">

        <div class="relative w-32 h-32 cursor-pointer">
            <img src="{{ asset($masyarakat->logo ?? 'asset/user.png') }}" alt="user"
            id="photoPreview"
            class="w-full h-full object-cover rounded-full border border-gray-300 dark:border-gray-800">
        </div>
          
        <div class="w-full text-start">
            <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Kelompok Masyarakat</h1>
        </div>
          <div class="w-full lg:w-1/2 px-2 lg:px-7 rounded-lg border border-gray-300 py-5">
                <div class="mb-6">
                    <label for="nama_masyarakat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Organisasi/Instansi</label>
                    
                    <input type="text"
                        value="{{ $masyarakat->nama_masyarakat }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled readonly />

                </div>
                <div class="mb-6">
                    <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bidang Fokus Organisasi/Instansi</label>
                    <input type="text"
                        value="{{ $bidangUsaha->nama }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled readonly />
                </div> 
                <div class="mb-6">
                    <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Bantuan yang diharapkan</label>
                    <input type="text"
                        value="{{ $jenisBantuan->nama }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled readonly />
                </div> 

                <div class="mb-6">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text"
                        value="{{ $masyarakat->alamat }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled readonly />
                </div> 
                
                <div class="mb-6">
                    <div class="mb-5 grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                                <input type="text"
                                    value="{{ $provinsi?->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled readonly />
                            </div> 
                            <div>
                                <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                                <input type="text"
                                    value="{{ $kabupaten?->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled readonly />
                            </div> 
                            <div>
                                <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                                <input type="text"
                                    value="{{ $kecamatan?->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled readonly />
                            </div> 
                            <div>
                                <label for="kalurahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalurahan</label>
                                <input type="text"
                                    value="{{ $kalurahan?->name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    disabled readonly />
                            </div>
                    </div>
                </div> 
          </div>
      </div>
</div>


@endsection