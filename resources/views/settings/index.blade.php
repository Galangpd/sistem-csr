@extends('template.dashboard')
@section('konten')

<div class="p-4 mt-0 lg:mt-16">
    <div>
        <h1 class="font-bold font-blue-500 md:text-md lg:text-2xl text-black">Profile</h1>
    </div>
</div>

<div class="rounded-2xl border border-gray-300 shadow-lg bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">

    <form action="{{ $user->role === 'perusahaan' ? route('update.setting.perusahaan') : route('update.setting.masyarakat') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="flex flex-col items-center gap-5 xl:flex-row xl:justify-between">
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
            @if ($user->role === 'perusahaan')
                <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Perusahaan</h1>
            @elseif ($user->role === 'masyarakat')
                <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Kelompok Masyarakat</h1>
            @else
                <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Perusahaan</h1>
            @endif
        </div>
          <div class="w-full lg:w-1/2 px-2 lg:px-7 rounded-lg border border-gray-300 py-5">
                <div class="mb-6">
                    @if ($user->role === 'perusahaan')
                        <label for="nama_perusahaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Perusahaan</label>
                    @elseif ($user->role === 'masyarakat')
                        <label for="nama_masyarakat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Organisasi/Instansi</label>
                    @else
                        <label for="nama_perusahaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Perusahaan</label>
                    @endif
                    
                    <input type="text"
                        value="{{ old('nama', $data->nama_perusahaan ?? $data->nama_masyarakat ?? '') }}" 
                        name="nama" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ $user->role === 'perusahaan' ? 'Nama Perusahaan' : 'Nama Kelompok Masyarakat' }}" 
                        required />

                </div>
                <div class="mb-6">

                    <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bidang Usaha</label>

                    <input type="text" 
                    value="{{ old('bidang_usaha', $data->bidang_usaha ?? '') }}" name="bidang_usaha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Bidang Usaha" required />
                </div> 
                <div class="mb-6">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text" 
                    value="{{ old('alamat', $data->alamat ?? '') }}" 
                    name="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="yogyakarta" required />
                </div> 
                
                
                <div class="grid mb-6 gap-6 md:grid-cols-2">
                    <div>
                        <label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                        <select name="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Provinsi</option>
                            <option value="Yogyakarta">Daerah Istimewa Yogyakarta</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                        </select>
                    </div> 
                    <div>
                        <label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                        <select name="kabupaten" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Kabupaten</option>
                            <option value="Sleman">Sleman</option>
                            <option value="Bantul">Bantul</option>
                            <option value="Kulonprogo">Kulonprogo</option>
                            <option value="Gunung Kidul">Gunung Kidul</option>
                        </select>
                    </div> 
                    <div>
                        <label for="kecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                        <select name="kecamatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Kecamatan</option>
                            <option value="Minggir">Minggir</option>
                            <option value="Moyudan">Moyudan</option>
                            <option value="Gamping">Gamping</option>
                            <option value="Godean">Godean</option>
                        </select>
                    </div> 
                    <div>
                        <label for="kalurahan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalurahan</label>
                        <select name="kalurahan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Kalurahan</option>
                            <option value="Sendangrejo">Sendangrejo</option>
                            <option value="Sendangsari">Sendangsari</option>
                            <option value="Sendangmulyo">Sendangmulyo</option>
                            <option value="Sendangarum">Sendangarum</option>
                        </select>
                    </div> 
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Perbarui</button>
    </form>
          </div>

          <div class="w-full text-start">
            <h1 class="font-bold font-blue-500 md:text-md lg:text-xl text-black">Profil Pengguna</h1>
            </div>
            <div class="w-full lg:w-1/2 px-2 lg:px-7 rounded-lg border border-gray-300 py-5">
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
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Perbarui</button>
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
@endpush