@extends('template.guest')

@section('konten')

<div class="relative max-w-screen mx-auto px-4 h-full py-10 flex flex-col justify-center items-center bg-gray-100 shadow-lg">
    <h1 class="mb-8 mt-20 text-3xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
        Register Kelompok Masyarakat
    </h1>

    @if ($errors->any())
        <div id="alert-2" class="flex items-center w-full md:max-w-1/2 p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <div class="ms-3 text-sm font-medium">
                Registrasi gagal
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif

    <div class="w-full md:max-w-1/2 rounded-lg p-4 bg-white border border-gray-300 shadow-lg">
        
        <form action="{{ route('register.masyarakat') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="nama_masyarakat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Organisasi/Instansi</label>
                <input type="text" value="{{ old('nama_masyarakat') }}" name="nama_masyarakat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="PT Sentosa" required />
                @error('nama_masyarakat')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bidang Fokus Organisasi/Instansi</label>
                <select id="bidang_usaha" name="bidang_usaha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected disabled>Pilih Bidang Usaha</option>
                    @foreach ($bidangUsaha as $bidang)
                        <option value="{{ $bidang->id }}" {{ old('bidang_usaha') == $bidang->id ? 'selected' : '' }}>
                            {{ $bidang->nama }}
                        </option>
                    @endforeach
                </select>
                @error('bidang_usaha')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div> 
            <div class="mb-6">
                <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Bantuan yang diharapkan</label>
                <select id="jenis_bantuan" name="jenis_bantuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" selected disabled>Pilih Jenis Bantuan</option>
                    @foreach ($jenisBantuan as $bantuan)
                        <option value="{{ $bantuan->id }}" {{ old('jenis_bantuan') == $bantuan->id ? 'selected' : '' }}>
                            {{ $bantuan->nama }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_bantuan')
                     <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div> 
            <div class="mb-6">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                <input type="text" value="{{ old('alamat') }}" name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="yogyakarta" required />
                @error('alamat')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <div class="mb-5 grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->code }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div> 
                        <div>
                            <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected disabled>Pilih Provinsi terlebih dahulu</option>
                            </select>
                            @error('kabupaten')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div> 
                        <div>
                            <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected disabled>Pilih Kabupaten terlebih dahulu</option>
                            </select>
                            @error('kecamatan')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div> 
                        <div>
                            <label for="kalurahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalurahan</label>
                            <select name="kalurahan" id="kalurahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected disabled>Pilih Kecamatan terlebih dahulu</option>
                            </select>
                            @error('kalurahan')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                </div>
            </div> 
            <div class="mb-6">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" value="{{ old('username') }}" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ptsentosa" required />
                @error('username')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div> 
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" value="{{ old('password') }}" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
            </div> 
            <div class="mb-6">
                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                <input type="password" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                @error('password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div> 
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">Submit</button>
        </form>

    </div>
</div>

@endsection


@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $('#provinsi').change(function () {
        let provinsiID = $(this).val();
        $('#kabupaten').html('<option selected disabled>Loading...</option>');
        $('#kecamatan').html('<option selected disabled>Loading...</option>');
        $('#kalurahan').html('<option selected disabled>Loading...</option>');
        $.get('/get-kabupaten/' + provinsiID, function (data) {
            let options = '<option selected disabled>Pilih Kabupaten</option>';
            data.forEach(item => {
                options += `<option value="${item.code}">${item.name}</option>`;
            });
            $('#kabupaten').html(options);
            $('#kecamatan').html('<option selected disabled>Pilih Kabupaten terlebih dahulu</option>');
            $('#kalurahan').html('<option selected disabled>Pilih Kecamatan terlebih dahulu</option>');
        });
    });

    $('#kabupaten').change(function () {
        let kabupatenID = $(this).val();
        $('#kecamatan').html('<option selected disabled>Loading...</option>');
        $('#kalurahan').html('<option selected disabled>Loading...</option>');
        $.get('/get-kecamatan/' + kabupatenID, function (data) {
            let options = '<option selected disabled>Pilih Kecamatan</option>';
            data.forEach(item => {
                options += `<option value="${item.code}">${item.name}</option>`;
            });
            $('#kecamatan').html(options);
            $('#kalurahan').html('<option selected disabled>Pilih Kecamatan terlebih dahulu</option>');
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