<nav class="fixed w-full z-20 top-0 start-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="hidden md:flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Flowbite Logo">
            <span class="self-center text-2xl font-bold whitespace-nowrap text-white text-shadow">Sistem CSR</span>
        </a>

        <button data-collapse-toggle="navbar-sticky" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 md:hidden dark:text-gray-400 dark:hover:bg-gray-700"
            aria-controls="navbar-sticky" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 md:py-2 mt-4 md:px-6 shadow-lg font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href=""
                        class="nav-item">Home</a>
                </li>
                <li>
                    <a href=""
                        class="nav-item">Data 1</a>
                </li>
                <li>
                    <a href=""
                        class="nav-item">Data 2</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // transparanrt topbar saat scrolling
    window.addEventListener('scroll', function() {
        const header = document.querySelector('nav');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>