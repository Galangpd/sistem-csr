@extends('template.guest')

@section('konten')

<div class="relative max-w-screen-xl bg-white shadow-lg mx-auto px-4 flex items-center h-screen">
    <div class="grid max-w-full mx-auto gap-5 md:grid-cols-2">
        <a href="#" class="max-w-sm p-10 bg-white border border-gray-400 text-center rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="{{ asset('asset/perusahaan.png') }}" alt="Perusahaan" class="w-40 h-40 mx-auto" />
              
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Perusahaan</h5>
        </a>
        <a href="#" class="max-w-sm p-10 bg-white border border-gray-400 text-center rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="{{ asset('asset/masyarakat.png') }}" alt="Masyarakat" class="w-40 h-40 mx-auto" />
              
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Masyarakat</h5>
        </a>
    </div>
</div>
    

@endsection