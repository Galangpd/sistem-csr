@extends('template.dashboard')
@section('konten')

<div class="p-4">
    <div class="md:flex md:justify-between">
        <h1 class="font-bold text-[20px] md:text-md lg:text-xl xl:text-2xl text-black">Daftar Pendaftaran Pengguna Perusahaan</h1>
    </div>
</div>

<div class="card">
    <div class="max-w-full mx-auto mb-5">
        <form method="GET" action="{{ route('register.perusahaan.admin') }}">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input onchange="this.form.submit()" name="search" value="{{ request()->search }}" type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Perusahaan"  />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>

    <div class="mt-4 relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Perusahaan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Daftar
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($perusahaans as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th class="px-6 py-4">{{ $loop->iteration }}</th>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->perusahaan->nama_perusahaan }}
                    </td>
                    <td class="px-6 py-4">
                         {{ $item->email ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                         {{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}
                    </td>
                    <td class="px-4 py-4 uppercase text-white text-center font-semibold">
                        @if ($item->status == 'approved')
                            <span class="bg-green-500 p-2 rounded-lg">{{ $item->status }}</span>
                        @elseif ($item->status == 'rejected')
                            <span class="bg-red-500 p-2 rounded-lg">{{ $item->status }}</span>
                        @else
                            <span class="bg-yellow-500 p-2 rounded-lg">{{ $item->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center flex justify-center items-center">
                        @if ($item->status == 'pending')
                            <a href="{{ route('detail.perusahaan.admin', $item->perusahaan->id) }}">
                                <button type="button" class="button-custom focus:outline-none text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Detail</button>
                            </a>
                            <form action="{{ route('admin.approve', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="button-custom focus:outline-none text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Approve</button>
                            </form>
                            <form action="{{ route('admin.reject', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="button-custom focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-green-800">Tolak</button>
                            </form>
                        @else
                            <a href="{{ route('detail.perusahaan.admin', $item->perusahaan->id) }}">
                                <button type="button" class="button-custom focus:outline-none text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Detail</button>
                            </a>
                        @endif
                        
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
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: true,
                    timer: 2000
                }).then(() => {
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                });
            });
        </script>
    @endif

    
@endpush
