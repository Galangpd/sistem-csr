<nav class="w-full start-0 relative z-10">
    <div class="w-full bg-[#003973]">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Flowbite Logo">
                <span class="self-center text-2xl font-bold whitespace-nowrap text-white text-shadow">CSR</span>
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