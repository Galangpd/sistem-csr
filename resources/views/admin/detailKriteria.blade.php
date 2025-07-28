@extends('template.dashboard')
@section('konten')

<div class="p-4 mt-0">
    <div>
        <h1 class="font-bold font-blue-500 md:text-md lg:text-2xl text-black">Daftar Kriteria</h1>
        <a href="{{ route('kriteria.admin') }}" class="button-custom text-white bg-blue-600 hover:bg-blue-700"><svg viewBox="0 0 1024 1024" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path><path fill="#ffffff" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path></g></svg> Kembali</a>
    </div>
</div>

<div class="card">
    <div class="max-w-full mx-auto mb-5">
        <button
            type="button"
            data-url="{{ route($create) }}"
            class="updateProductButton button-custom text-white bg-blue-600 hover:bg-blue-700"
            data-modal-target="updateProductModal"
            data-modal-toggle="updateProductModal">
            Tambah
        </button>
        <form method="GET" action="{{ route($route) }}">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input onchange="this.form.submit()" name="search" value="{{ request()->search }}" type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Kriteria"  />
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
                    <th colspan="4" scope="col" class="px-6 py-3">
                        Nama Kriteria
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($kriterias as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th class="px-6 py-4">{{ $loop->iteration }}</th>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->nama }}
                    </td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4"></td>
                    <td class="px-6 py-4">
                        {{-- <button 
                            type="button"
                            class="updateProductButton button-custom focus:outline-none text-white bg-yellow-600 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-green-800"
                            data-id="{{ $item->id }}"
                            data-nama="{{ $item->nama }}"
                            data-url="{{ route($update, $item->id) }}"
                            data-modal-target="updateProductModal"
                            data-modal-toggle="updateProductModal">
                            Edit
                        </button> --}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>

</div>

<!-- Modal update -->
<div id="updateProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b border-slate-400 sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Tambah Data
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProductModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="#" id="updateForm">
            @csrf
                <div class="w-full">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan nama kriteria">
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-5">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById('updateProductButton').click();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const updateButtons = document.querySelectorAll('.updateProductButton');
            const form = document.getElementById('updateForm');

            updateButtons.forEach(button => {
                button.addEventListener('click', function () {

                    form.action = button.dataset.url;
                    inputNama.value = nama;
                });
            });
        });
    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById('popup-modal').click();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll('.open-delete-modal');
            const form = document.getElementById('deleteForm');
            const modal = document.getElementById('popup-modal');

            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const url = button.getAttribute('data-url');
                    form.action = url;

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });
        });
    </script> --}}

    <script>
        document.querySelectorAll('[data-modal-hide="modal-delete"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = document.getElementById('modal-delete');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });
    </script>


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
    @elseif (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
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
