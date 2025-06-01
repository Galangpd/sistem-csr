@extends('template.guest')

@section('konten')
    <div class="absolute -z-0 inset-0 overflow-hidden">
        <img src="{{ asset('asset/home.jpg') }}" class="w-full h-full md:h-auto object-cover"
            style="mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 50%, rgba(0, 0, 0, 0) 90%, rgba(0, 0, 0, 0) 100%);" />
    </div>

    <div class="relative max-w-screen-xl mx-auto px-4 flex items-center h-screen">
        <div class="lg:w-1/2">
            <div class="font-bold text-white lg:text-6xl text-3xl text-shadow flex items-center">
                <span class="self-center text-3xl font-bold whitespace-nowrap text-white text-shadow">CSR</span>
            </div>
            <div class="mt-2 text-white text-shadow lg:text-lg">
                Sistem Informasi CSR adalah sebuah platform yang memungkinkan perusahaan dan kelompok masyarakat penerima manfaat untuk saling bertemu dalam proses penyaluran dana atau bantuan sosial. Sistem ini juga dilengkapi dengan fitur pencocokan otomatis sehingga proses penyaluran CSR menjadi lebih tepat sasaran selaras dengan visi perusahaan dan kebutuhan masyarakat.
            </div>

            <div class="mt-2 flex md:order-2 space-x-3 md:space-x-0">
                    <a href="/login"
                        class="button-custom">
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
