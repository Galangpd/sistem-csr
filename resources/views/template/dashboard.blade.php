<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <link rel="shortcut icon" href="{{ asset('img/logo-ec.svg') }}" type="image/x-icon">
    <title>Dashboard CSR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    @stack('style')
</head>
<body>
    @include('template.navbar-admin')
    @include('template.sidebar')
    @include('sweetalert2::index')

    <div class="p-2 md:ml-[190px] lg:p-4 lg:ml-[260px] h-max mt-10 md:mt-0">
        @yield('konten')
    </div>

    <script>
        window.onpageshow = function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        };
    </script>
    
    <script>
        //memutar arrah arrow dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-user');
            const icon = document.getElementById('dropdown-icon');
            const isExpanded = dropdown.classList.toggle('hidden');

            // Toggle rotation class on icon
            if (isExpanded) {
                icon.classList.remove('rotate-180');
                icon.classList.add('rotate-0');
            } else {
                icon.classList.remove('rotate-0');
                icon.classList.add('rotate-180');
            }
        }

        // Tutup dropdown saat mengklik di luar area dropdown
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('dropdown-user');
            const icon = document.getElementById('dropdown-icon');
            const button = document.querySelector('[data-dropdown-toggle="dropdown-user"]');

            if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                // Pastikan dropdown tertutup dan ikon dalam posisi awal
                dropdown.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    @stack('script')
</body>
</html>