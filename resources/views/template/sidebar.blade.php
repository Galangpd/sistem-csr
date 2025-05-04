<aside id="logo-sidebar"
    class="fixed bg-white md:w-[250px] h-screen rounded-xl shadow-lg border border-gray-300 z-10 md:m-4 md:h-[calc(100vh-2rem)] flex flex-col justify-between transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="py-6 ml-4">
        <a href="/" class="flex flex-col justify-start space-x-3 rtl:space-x-reverse">
            <div class="flex items-center">
                <img src="{{ asset('asset/logo-oia.svg') }}" class="h-10 ml-3" />
                <div class="text-xl font-bold break-words mx-2">Sistem CSR</div>
            </div>
        </a>
    </div>
    <div class="h-full px-3 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="/"
                    class="side-menu {{ Request::is('dashboard*') ? 'side-menu-active' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/"
                    class="side-menu {{ Request::is('pencarian*') ? 'side-menu-active' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-house"></i>
                        <span>Pencarian</span>
                    </div>
                </a>
            </li>
            
        </ul>
    </div>
    <div class="m-4 flex-col justify-start items-center text-center hidden md:flex">
        <p class="font-primary font-semibold text-slate-800 w-full truncate">test</p>
        <p class="font-primary text-sm text-slate-800 w-full truncate">test@gmail.com</p>
        <a href="/"
            class="w-fit items-center text-slate-500 hover:text-red-600 gap-3 mt-2 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all transform duration-200 ease-in-out"
            role="menuitem">
            <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
        </a>
    </div>

</aside>
