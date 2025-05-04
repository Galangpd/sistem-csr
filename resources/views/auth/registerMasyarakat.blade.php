@extends('template.guest')

@section('konten')

<div class="relative max-w-screen mx-auto px-4 h-full py-10 flex flex-col justify-center items-center bg-white shadow-lg">
    <h1 class="mb-8 text-3xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
        Register Kelompok Masyarakat
    </h1>

    <div class="w-full md:max-w-1/2 rounded-lg p-4 border border-gray-300 shadow-lg">
        
        <form>
            <div class="mb-6">
                <label for="nama_masyarakat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Organisasi/Instansi</label>
                <input type="text" id="nama_masyarakat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="PT Sentosa" required />
            </div>
            <div class="mb-6">
                <label for="bidang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bidang Fokus Organisasi/Instansi</label>
                <input type="text" id="bidang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="pertambangan" required />
            </div> 
            <div class="mb-6">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                <input type="text" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="yogyakarta" required />
            </div> 
            <div class="grid mb-6 gap-6 md:grid-cols-2">
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
                <div class="mb-6">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ptsentosa" required />
                </div> 
            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
            </div> 
            <div class="mb-6">
                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                <input type="password" id="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
            </div> 
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

    </div>
</div>

    

@endsection