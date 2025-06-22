@extends('template.guest')

@section('konten')

    <div class="relative w-full mx-auto bg-white px-10 flex flex-col md:flex-row items-center h-screen overflow-hidden">
         <div class="absolute inset-0 z-10 pointer-events-none">
            <div class="absolute -top-48 -left-48 w-[500px] h-[500px] rounded-full"
                style="background: radial-gradient(circle, rgba(59, 131, 246, 0.666) 0%, rgba(59,130,246,0) 70%);">
            </div>
            <div class="absolute -bottom-48 -right-48 w-[500px] h-[500px] rounded-full"
                style="background: radial-gradient(circle, rgba(255, 196, 0, 0.729) 0%, rgba(59,130,246,0) 70%);">
            </div>
        </div>

        <div class="w-full md:w-1/2 mt-8 mb-8 md:mb-0 flex justify-center">
            <img src="{{ asset('asset/home2.png') }}" alt="Ilustrasi CSR" class="w-3/4 h-3/4 object-contain">
        </div>

        <div class="w-full md:w-1/2 space-y-6 me-5">
            <div class="font-bold lg:text-6xl text-3xl text-shadow flex items-center">
                <span class="self-center text-3xl font-bold whitespace-nowrap text-[#003973] text-shadow">CSR</span>
            </div>
            <div class="mt-2 text-slate-600 text-shadow lg:text-lg">
                Sistem Informasi CSR adalah sebuah platform yang memungkinkan perusahaan dan kelompok masyarakat penerima manfaat untuk saling bertemu dalam proses penyaluran dana atau bantuan sosial. Sistem ini juga dilengkapi dengan fitur pencocokan otomatis sehingga proses penyaluran CSR menjadi lebih tepat sasaran selaras dengan visi perusahaan dan kebutuhan masyarakat.
            </div>

            <div class="mt-2 flex md:order-2 space-x-3 md:space-x-0">
                    <a href="/login"
                        class="flex justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 hover:shadow-xl dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-2xl text-lg px-6 py-3 text-center me-2 mb-2">
                        Mulai
                    </a>
            </div>
        </div>
    </div>

    <style>
        .svgMap-map-wrapper {
            background: rgb(243 244 246) !important;
        }

        .svgMap-map-controls-wrapper {
            margin-left: 60%;
        }
    </style>
@endsection
