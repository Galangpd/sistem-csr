@extends('template.guest')

@section('konten')

<div class="max-w-full py-10 mx-auto px-4 h-full md:h-screen flex flex-col justify-center items-center bg-gray-100 shadow-lg">
    
    <h1 class="mt-20 md:mt-0  text-3xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
        Siapakah anda?
    </h1>

    <div class="grid gap-6 md:grid-cols-2 mt-10 mb-20">
        <a href="{{ route('auth.register-perusahaan') }}" class="w-64 p-10 bg-white border border-gray-300 text-center rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="{{ asset('asset/perusahaan.png') }}" alt="Perusahaan" class="w-40 h-40 mx-auto mb-4" />
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Perusahaan</h5>
        </a>

        <a href="{{ route('auth.register-masyarakat') }}" class="w-64 p-10 bg-white border border-gray-300 text-center rounded-lg shadow-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="{{ asset('asset/masyarakat.png') }}" alt="Masyarakat" class="w-40 h-40 mx-auto mb-4" />
            <h5 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Masyarakat</h5>
        </a>
    </div>
</div>

    

@endsection