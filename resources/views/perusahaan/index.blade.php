@extends('template.dashboard')
@section('konten')

<div class="p-4">
    <div class="md:flex md:justify-between">
        <h1 class="font-bold font-blue-500 text-[20px] md:text-md lg:text-xl xl:text-2xl text-black">Daftar Kelompok Masyarakat</h1>
    </div>
</div>

<div class="card">
    
    <form class="max-w-full mx-auto mb-5">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Kelompok Masyarakat" required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    <div class="relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Logo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Kelompok Masyarakat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Bidang Usaha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th class="px-6 py-4">{{ $loop->iteration }}</th>
                    <td class="px-6 py-4">
                        <img src="{{ asset($item->logo) }}" class="h-20 ml-3" />
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->nama_masyarakat }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->bidang_usaha ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->alamat }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection