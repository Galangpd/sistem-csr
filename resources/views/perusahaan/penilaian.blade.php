@extends('template.dashboard')
@section('konten')

<div class="p-4 md:mt-0">
    <div class="md:flex md:justify-between">
        <h1 class="font-bold font-blue-500 text-xl md:text-md lg:text-2xl text-black">Penilaian Kelompok Masyarakat</h1>
    </div>
</div>

<div class="card border border-gray-300 shadow-lg">
    
    <form id="sortForm" method="POST" action="{{ $isEdit ? route('update.penilaian.perusahaan') : route('store.penilaian.perusahaan') }}">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif
        <label for="bidang-usaha" class="block px-5 mb-2 text-lg font-semibold text-gray-900 dark:text-white">Bidang Usaha</label>
        <div class="mb-3 px-5"><span class="text-sm"><i>Urutkan berdasarkan prioritas</i></span></div>
        <div id="list-bidang" class="mb-5 px-5">
            @foreach ($bidang_usaha as $item)
                <div class="sortable-item" data-id="{{ $item->id }}"><span class="handle">⋮⋮</span>{{ $item->nama }}</div>
            @endforeach
        </div>

        <hr class="mb-5">

        <label for="bidang-usaha" class="block px-5 mb-2 text-lg font-semibold text-gray-900 dark:text-white">Jenis Bantuan</label>
        <div class="mb-3 px-5"><span class="text-sm"><i>Urutkan berdasarkan prioritas</i></span></div>
        <div class="mb-5 px-5" id="list-bantuan">
            @foreach ($jenis_bantuan as $item)
                <div class="sortable-item" data-id="{{ $item->id }}"><span class="handle">⋮⋮</span>{{ $item->nama }}</div>
            @endforeach
        </div>

        <hr class="mb-5">

        <label for="lokasi" class="block px-5 mb-2 text-lg font-semibold text-gray-900 dark:text-white">Lokasi</label>
        <div class="mb-5 px-5 grid gap-6 md:grid-cols-2">
                <div>
                    <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                    <select name="provinsi" id="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->code }}">{{ $item->name }}</option>
                                @endforeach
                    </select>
                </div> 
                <div>
                    <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                    <select name="kabupaten" id="kabupaten" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Provinsi terlebih dahulu</option>
                    </select>
                </div> 
                <div>
                    <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Kabupaten terlebih dahulu</option>
                    </select>
                </div> 
                <div>
                    <label for="kalurahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalurahan</label>
                    <select name="kalurahan" id="kalurahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Kecamatan terlebih dahulu</option>
                    </select>
                </div>
        </div>

        <div class="mb-5 px-5">
            <button type="submit" class="inline-flex w-auto text-center items-center gap-3 mt-2 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-4 py-2 me-2 mb-2">Submit</button>

        </div>
    </form>

</div>

@endsection

@push('style')
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .sortable-item {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 8px;
        border-radius: 6px;
        background-color: white;
        display: flex;
        align-items: center;
        cursor: move;
    }

    .handle {
        cursor: move;
        margin-right: 10px;
        font-size: 18px;
    }
</style>
@endpush

@push('script')
<script>
    const sortableBidang = new Sortable(document.getElementById('list-bidang'), {
        animation: 200,
        ghostClass: 'blue-background-class'
    });
    const sortableBantuan = new Sortable(document.getElementById('list-bantuan'), {
        animation: 200,
        ghostClass: 'blue-background-class'
    });

    document.getElementById('sortForm').addEventListener('submit', function(e) {
        getOrder();
    });

    function getOrder() {
        const bidangs = document.querySelectorAll('#list-bidang .sortable-item');
        const bantuans = document.querySelectorAll('#list-bantuan .sortable-item');
        const orderBidang = Array.from(bidangs).map(item => item.dataset.id);
        const orderBantuan = Array.from(bantuans).map(item => item.dataset.id);

        orderBidang.forEach((val, idx) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'bidang_usaha[]';
            input.value = val;
            document.getElementById('sortForm').appendChild(input);
        });

        orderBantuan.forEach((val, idx) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'jenis_bantuan[]';
            input.value = val;
            document.getElementById('sortForm').appendChild(input);
        });
        
        console.log('Urutan bidang usaha:', orderBidang);
        console.log('Urutan bantuan: ', orderBantuan);
        
        return order;
    }

</script>

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
@elseif(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            timer: 2000
        });
    </script>
@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#provinsi').change(function () {
        let provinsiID = $(this).val();
        $('#kabupaten').html('<option selected disabled>Loading...</option>');
        $.get('/get-kabupaten/' + provinsiID, function (data) {
            let options = '<option selected disabled>Pilih Kabupaten</option>';
            data.forEach(item => {
                options += `<option value="${item.code}">${item.name}</option>`;
            });
            $('#kabupaten').html(options);
        });
    });

    $('#kabupaten').change(function () {
        let kabupatenID = $(this).val();
        $('#kecamatan').html('<option selected disabled>Loading...</option>');
        $.get('/get-kecamatan/' + kabupatenID, function (data) {
            let options = '<option selected disabled>Pilih Kecamatan</option>';
            data.forEach(item => {
                options += `<option value="${item.code}">${item.name}</option>`;
            });
            $('#kecamatan').html(options);
        });
    });

    $('#kecamatan').change(function () {
        let kecamatanID = $(this).val();
        $('#kalurahan').html('<option selected disabled>Loading...</option>');
        $.get('/get-kalurahan/' + kecamatanID, function (data) {
            let options = '<option selected disabled>Pilih Kalurahan</option>';
            data.forEach(item => {
                options += `<option value="${item.code}">${item.name}</option>`;
            });
            $('#kalurahan').html(options);
        });
    });
</script>
@endpush