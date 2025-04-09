@extends('template.guest')

@section('konten')
    <div class="absolute -z-0 inset-0 overflow-hidden">
        <img src="{{ asset('asset/home.jpg') }}" class="w-full h-full md:h-auto object-cover"
            style="mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 50%, rgba(0, 0, 0, 0) 90%, rgba(0, 0, 0, 0) 100%);" />
    </div>

    <div class="relative max-w-screen-xl mx-auto px-4 flex items-center h-screen">
        <div class="lg:w-1/2">
            <a href="/" class="flex md:hidden items-center space-x-3 rtl:space-x-reverse ">
                <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Flowbite Logo">
                <span class="self-center text-3xl font-bold whitespace-nowrap text-white text-shadow">Sistem CSR</span>
            </a>
            <div class="font-bold text-white lg:text-6xl text-3xl text-shadow">
                Sistem CSR
            </div>
            <div class="mt-2 text-white text-shadow lg:text-lg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat ab pariatur sequi enim, vitae, libero doloribus fuga, hic illo saepe quia commodi! Neque vero optio iste ullam eveniet a sunt, earum atque minus dolor asperiores inventore, placeat aliquid voluptas minima quis sit tempora qui. Natus excepturi quaerat eaque dicta magni!
            </div>

            <div class="mt-2 flex md:order-2 space-x-3 md:space-x-0">
                @if (!Auth::user())
                    <a href="/"
                        class="flex text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
                        Login
                    </a>
                @else
                    <a href="/" class="button-custom">
                        Dashboard
                    </a>
                @endif
            </div>
        </div>

        {{-- <div class="lg:w-1/2">
                <img src="{{ asset('asset/logo-oia.svg') }}" alt="">
            </div> --}}
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
