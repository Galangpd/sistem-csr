@extends('template.dashboard')
@section('konten')

<div class="p-4 mt-0">
    <div>
        <h1 class="font-bold font-blue-500 md:text-md lg:text-2xl text-black">Profile</h1>
        <a href="{{ route('dashboard.masyarakat') }}" class="button-custom text-white bg-blue-600 hover:bg-blue-700"><svg viewBox="0 0 1024 1024" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#ffffff" d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"></path><path fill="#ffffff" d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"></path></g></svg> Kembali</a>
    </div>
</div>

<div class="rounded-2xl border border-gray-300 shadow-lg bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

    <form action="{{ route('update.setting.masyarakat') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="flex flex-col items-center gap-5">
        <input type="file" id="photoInput" name="photo" accept="image/*" class="hidden" onchange="previewImage(event)">

        <div class="relative w-32 h-32 cursor-pointer" onclick="document.getElementById('photoInput').click()">
            <img src="{{ asset($data->logo ?? 'asset/user.png') }}" alt="user"
            id="photoPreview"
            class="w-full h-full object-cover rounded-full border border-gray-300 dark:border-gray-800">
            
            {{-- Icon edit di pojok kanan bawah --}}
            <div class="absolute bottom-0 right-0 bg-blue-500 p-2 rounded-full shadow">
                <i class="fa-solid fa-camera text-gray-200 text-lg"></i>
            </div>
        </div>
          
        <div class="w-full text-start">
            <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Kelompok Masyarakat</h1>
        </div>
          <div class="w-full px-2 lg:px-7 rounded-lg border border-gray-300 py-5">
                <div class="mb-6">
                    <label for="nama_masyarakat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Organisasi/Instansi</label>
                    
                    <input type="text"
                        value="{{ old('nama', $data->nama_masyarakat ?? '') }}" 
                        name="nama" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nama Kelompok Masyarakat" 
                        required />

                </div>
                <div class="mb-6">
                    <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bidang Fokus Organisasi/Instansi</label>
                    <select id="bidang_usaha" name="bidang_usaha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Bidang Usaha</option>
                        @foreach ($bidangUsaha as $bidang)
                            <option value="{{ $bidang->id }}" @if (isset($data->bidang_usaha) && $data->bidang_usaha == $bidang->id) selected @endif>{{ $bidang->nama }}</option>
                        @endforeach   
                    </select>
                </div> 
                <div class="mb-6">
                    <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Bantuan yang diharapkan</label>
                    <select id="jenis_bantuan" name="jenis_bantuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected disabled>Pilih Jenis Bantuan</option>
                        @foreach ($jenisBantuan as $bantuan)
                            <option value="{{ $bantuan->id }}" @if (isset($data->jenis_bantuan) && $data->jenis_bantuan == $bantuan->id) selected @endif>{{ $bantuan->nama }}</option>
                        @endforeach
                    </select>
                </div> 

                <div class="mb-6">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text" 
                    value="{{ old('alamat', $data->alamat ?? '') }}" 
                    name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="yogyakarta" required />
                </div> 
                
                <div class="mb-6">
                    <div class="mb-5 grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="" selected disabled>Pilih Provinsi</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item->code }}" @if (isset($data->provinsi) && $data->provinsi == $item->code) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div>
                                <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                                <select name="kabupaten" id="kabupaten" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="" selected disabled>Pilih Provinsi terlebih dahulu</option>
                                    @foreach ($kabupaten as $item)
                                        <option value="{{ $item->code }}" @if (isset($data->kabupaten) && $data->kabupaten == $item->code) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div>
                                <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="" selected disabled>Pilih Kabupaten terlebih dahulu</option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->code }}" @if (isset($data->kecamatan) && $data->kecamatan == $item->code) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div>
                                <label for="kalurahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalurahan</label>
                                <select name="kalurahan" id="kalurahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="" selected disabled>Pilih Kecamatan terlebih dahulu</option>
                                    @foreach ($kalurahan as $item)
                                        <option value="{{ $item->code }}" @if (isset($data->kalurahan) && $data->kalurahan == $item->code) selected @endif>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div> 
                <button type="submit" class="button-custom">Perbarui</button>
    </form>
          </div>

          <div class="w-full text-start">
            <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Pengguna</h1>
            </div>
            <div class="w-full px-2 lg:px-7 rounded-lg border border-gray-300 py-5">
        <form action="{{ $user->role === 'perusahaan' ? route('update.user.perusahaan') : route('update.user.masyarakat') }}" method="POST">
                    @csrf
                    @method('put')
            <div class="mb-6">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" 
                value="{{ old('username', $user->username ?? '') }}" 
                name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ptsentosa" required />
            </div> 
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" />
            </div> 
            <div class="mb-6">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                <input type="password" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" />
            </div> 
            @error('password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <button type="submit" class="button-custom">Perbarui</button>
          </div>
        </form>
    </div>

@endsection


@push('script')
<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function(){
            const img = document.getElementById('photoPreview');
            img.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
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
            $('#kecamatan').html('<option selected disabled>Pilih Kabupaten terlebih dahulu</option>');
            $('#kalurahan').html('<option selected disabled>Pilih Kecamatan terlebih dahulu</option>');
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