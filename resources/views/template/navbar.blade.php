<nav class="w-full start-0 relative z-10">
    <div class="w-full bg-[#003973]">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="hidden md:flex items-center space-x-3">
                <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Flowbite Logo">
                <span class="self-center text-2xl font-bold whitespace-nowrap text-white text-shadow">CSR</span>
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