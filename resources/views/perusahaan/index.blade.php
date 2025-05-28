@extends('template.dashboard')
@section('konten')

<div class="p-4">
    <div class="md:flex md:justify-between">
        <h1 class="font-bold text-[20px] md:text-md lg:text-xl xl:text-2xl text-black">Daftar Kelompok Masyarakat</h1>
    </div>
</div>

<div class="card">
    <div class="max-w-full mx-auto mb-5">
        <div class="mb-5">
            <a href="{{ route('penilaian.perusahaan') }}" class="w-full flex justify-center rounded-lg mx-auto bg-blue-600 hover:bg-blue-700 text-center p-3 mb-3 text-white">Pengaturan Penilaian</a>
        </div>
        
        <div class="md:flex md:justify-between mb-5">
            <h1 class="font-bold text-[20px] md:text-md lg:text-xl xl:text-2xl text-black">Hasil Perankingan</h1>
        </div>

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
                        Jenis Bantuan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Alamat
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Skor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dataMasyarakat as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th class="px-6 py-4">{{ $loop->iteration }}</th>
                    <td class="px-6 py-4">
                        <img src="{{ asset($item['logo']  ?? 'asset/user.png') }}" class="h-20 ml-3" />
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item['nama_masyarakat'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['bidang_usaha'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['jenis_bantuan'] ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['alamat'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item['total_skor'] }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('detail.masyarakat', $item['id_masyarakat']) }}">
                            <button type="button" class="focus:outline-none text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Detail</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>

</div>

@endsection

@push('script')

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 2000
            });
        </script>
    @endif
    
@endpush