<nav class="fixed md:hidden top-0 z-20 w-full">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <button type="button" aria-expanded="false" data-dropdown-toggle="dropdown-user"
                        onclick="toggleDropdown()">
                        <div class="px-4 py-3 flex items-center text-slate-500" role="none">
                            <p class="text-sm text-gray-900 w-36 truncate" role="none">
                                test@email.com
                            </p>
                            <div class="mx-2">
                                <i class="fa-solid fa-angle-down transform transition-transform duration-300 ease-in-out"
                                    id="dropdown-icon"></i>
                            </div>
                        </div>
                    </button>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900" role="none">
                                test
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                test@email.com
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <!-- <li>
                                <a href=""
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Guest</a>
                            </li> -->
                            <li>
                                <a href="/" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100"
                                    role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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