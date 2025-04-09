<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="shortcut icon" href="{{ asset('asset/logo-oia.svg') }}" type="image/x-icon">

    <title>Sistem CSR</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])    

</head>


<body class="bg-gray-100 overflow-x-hidden">
    @include('template.navbar')

    @yield('konten')
    @include('template.footer')


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('custom-script')
</body>

</html>
