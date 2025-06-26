<nav class="fixed w-full start-0 z-30">
    <div class="w-full bg-white shadow-lg shadow-gray-300">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Flowbite Logo">
                <span class="self-center text-2xl font-bold whitespace-nowrap text-[#003973] text-shadow">CSR</span>
            </a>

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