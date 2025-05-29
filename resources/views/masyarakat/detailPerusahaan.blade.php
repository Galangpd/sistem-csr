@extends('template.dashboard')
@section('konten')

<div class="p-4 mt-0 lg:mt-16">
    <div>
        <h1 class="font-bold font-blue-500 md:text-md lg:text-2xl text-black">Detail Perusahaan</h1>
        <a href="{{ route('dashboard.masyarakat') }}" class="button-custom text-white bg-blue-600 hover:bg-blue-700"><svg viewBox="0 0 1024 1024" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path><path fill="#ffffff" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path></g></svg> Kembali</a>
    </div>
</div>

<div class="rounded-2xl border border-gray-300 shadow-lg bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

      <div class="flex flex-col items-center gap-5 xl:flex-row xl:justify-between">

        <div class="relative w-32 h-32">
            <img src="{{ asset($perusahaan->logo ?? 'asset/user.png') }}" alt="user"
            id="photoPreview"
            class="w-full h-full object-cover rounded-full border border-gray-300 dark:border-gray-800">
        </div>
          
        <div class="w-full text-start">
            <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Perusahaan</h1>
        </div>
          <div class="w-full lg:w-1/2 px-2 lg:px-7 rounded-lg border border-gray-300 py-5">
                <div class="mb-6">
                    <label for="nama_perusahaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Perusahaan</label>
                    
                    <input type="text"
                        value="{{ $perusahaan->nama_perusahaan }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled readonly />

                </div>
                <div class="mb-6">
                    <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bidang Usaha</label>
                    <input type="text"
                        value="{{ $perusahaan->bidang_usaha }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled readonly />
                </div> 

                <div class="mb-6">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text"
                        value="{{ $perusahaan->alamat }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled readonly />
                </div> 
                
          </div>
      </div>
</div>


@endsection