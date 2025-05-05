@extends('template.dashboard')
@section('konten')

<div class="p-4 md:mt-0">
    <div class="md:flex md:justify-between">
        <h1 class="font-bold font-blue-500 text-xl md:text-md lg:text-2xl text-black">Penilaian Kelompok Masyarakat</h1>
    </div>
</div>

<div class="card border border-gray-300 shadow-lg">
    
    <form id="sortForm" method="POST" action="/submit-order">
        <div id="list-bidang" class="mb-5 px-5">
            <label for="bidang-usaha" class="block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Bidang Usaha</label>
            <div class="mb-3"><span class="text-sm"><i>Urutkan berdasarkan prioritas</i></span></div>
            <div class="sortable-item" data-id="3"><span class="handle">⋮⋮</span>Pendidikan</div>
            <div class="sortable-item" data-id="1"><span class="handle">⋮⋮</span>Kesehatan</div>
            <div class="sortable-item" data-id="2"><span class="handle">⋮⋮</span>Budaya</div>
            <div class="sortable-item" data-id="2"><span class="handle">⋮⋮</span>Lingkungan</div>
            <div class="sortable-item" data-id="2"><span class="handle">⋮⋮</span>Agama</div>
        </div>

        <hr class="mb-5">

        <div class="mb-5 px-5" id="list-bantuan">
            <label for="bidang-usaha" class="block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Jenis Bantuan</label>
            <div class="mb-3"><span class="text-sm"><i>Urutkan berdasarkan prioritas</i></span></div>
            <div class="sortable-item" data-id="3"><span class="handle">⋮⋮</span>Uang Tunai</div>
            <div class="sortable-item" data-id="1"><span class="handle">⋮⋮</span>Sarana dan Prasarana</div>
            <div class="sortable-item" data-id="2"><span class="handle">⋮⋮</span>Peralatan Usaha</div>
            <div class="sortable-item" data-id="2"><span class="handle">⋮⋮</span>Pelatihan</div>
        </div>

        <hr class="mb-5">

        <label for="lokasi" class="block px-5 mb-2 text-lg font-semibold text-gray-900 dark:text-white">Lokasi</label>
        <div class="mb-5 px-5 grid gap-6 md:grid-cols-2">
                <div>
                    <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                    <select id="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Provinsi</option>
                        <option value="US">Daerah Istimewa Yogyakarta</option>
                        <option value="CA">Jawa Tengah</option>
                        <option value="FR">Jawa Timur</option>
                        <option value="DE">Jawa Barat</option>
                    </select>
                </div> 
                <div>
                    <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                    <select id="kabupaten" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Kabupaten</option>
                        <option value="US">Sleman</option>
                        <option value="CA">Bantul</option>
                        <option value="FR">Kulonprogo</option>
                        <option value="DE">Gunung Kidul</option>
                    </select>
                </div> 
                <div>
                    <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                    <select id="kecamatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Kecamatan</option>
                        <option value="US">Minggir</option>
                        <option value="CA">Moyudan</option>
                        <option value="FR">Gamping</option>
                        <option value="DE">Godean</option>
                    </select>
                </div> 
                <div>
                    <label for="kalurahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalurahan</label>
                    <select id="kalurahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih Kalurahan</option>
                        <option value="US">Sendangrejo</option>
                        <option value="CA">Sendangsari</option>
                        <option value="FR">Sendangmulyo</option>
                        <option value="DE">Sendangarum</option>
                    </select>
                </div>
        </div>

        <input type="hidden" name="order" id="orderInput">

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

    // function updateOrder() {
    //     const items = document.querySelectorAll('#sortable-list .sortable-item');
    //     const order = Array.from(items).map(item => item.getAttribute('data-id'));
    //     document.getElementById('orderInput').value = order.join(',');
    // }

    // document.getElementById('sortForm').addEventListener('submit', function (e) {
    //     updateOrder(); // ensure the order is updated before submit
    // });
</script>
@endpush