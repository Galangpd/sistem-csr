<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 bg-white md:w-[250px] h-screen rounded-xl shadow-lg border border-gray-300 md:m-4 md:h-[calc(100vh-2rem)] md:flex md:flex-col justify-between transition-transform -translate-x-full md:translate-x-0"
    aria-label="Sidebar">
    <div class="py-6 ml-4">
        <a href="/" class="flex flex-col justify-start space-x-3 rtl:space-x-reverse">
            <div class="flex items-center">
                <img src="{{ asset('asset/logo-oia.svg') }}" class="h-10 ml-3" />
                <div class="text-xl font-bold break-words mx-2">CSR</div>
            </div>
        </a>
    </div>
    <div class="h-full px-3 overflow-y-auto">
        <ul class="space-y-2 font-medium">
             @if ($user->role === 'admin')
                {{-- Menu khusus Admin --}}
                <li>
                    <a href="{{ route('dashboard.admin') }}"
                        class="side-menu hover:text-white {{ Request::is('admin/dashboard*') ? 'side-menu-active text-white' : '' }}">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-house"></i>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="side-menu hover:text-white {{ Request::is('admin/pendaftaran*') ? 'side-menu-active text-white' : '' }}">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-users-gear"></i>
                            <span>Pendaftaran</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('perusahaan.admin') }}"
                        class="side-menu hover:text-white {{ Request::is('admin/perusahaan*') ? 'side-menu-active text-white' : '' }}">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-building"></i>
                            <span>Perusahaan</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('masyarakat.admin') }}"
                        class="side-menu hover:text-white {{ Request::is('admin/masyarakat*') ? 'side-menu-active text-white' : '' }}">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-user"></i>
                            <span>Masyarakat</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="side-menu hover:text-white {{ Request::is('admin/kriteria*') ? 'side-menu-active text-white' : '' }}">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-sliders"></i>
                            <span>Kriteria</span>
                        </div>
                    </a>
                </li>

            @elseif ($user->role === 'perusahaan' || $user->role === 'masyarakat')
            {{-- Menu untuk perusahaan atau masyarakat --}}
            <li>
                <a href="{{ route($user->role === 'perusahaan' ? 'dashboard.perusahaan' : 'dashboard.masyarakat') }}"
                    class="side-menu hover:text-white {{ Request::is('dashboard*') ? 'side-menu-active text-white' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route($user->role === 'perusahaan' ? 'setting.perusahaan' : 'setting.masyarakat') }}"
                    class="side-menu hover:text-white {{ Request::is('setting*') ? 'side-menu-active text-white' : '' }}">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-gear"></i>
                        <span>Setting</span>
                    </div>
                </a>
            </li>
            @endif
            
        </ul>
    </div>
    <div class="m-4 flex-col justify-start items-center text-center md:flex">
        <p class="font-primary text-sm text-slate-800 w-full truncate">{{ Auth::user()->username }}</p>
        <p class="font-semibold text-sm text-slate-800 w-full truncate">{{ Auth::user()->email }}</p>
        <a href="{{ route('auth.logout') }}"
            class="w-fit items-center text-slate-500 hover:text-red-600 gap-3 mt-2 font-medium rounded-lg text-sm px-4 py-2 text-center transition-all transform duration-200 ease-in-out"
            role="menuitem">
            <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
        </a>
    </div>

</aside>
