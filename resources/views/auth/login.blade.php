<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('asset/logo-oia.svg') }}" type="image/x-icon">

    <title>Login Sistem CSR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="px-4">

    <div class="relative -z-10">
        <div class="fixed">
            <div class="fixed -top-48 -left-48 w-[500px] h-[500px] rounded-full"
                style="background: radial-gradient(circle, rgba(59, 131, 246, 0.474) 0%, rgba(59,130,246,0) 70%);">
            </div>
            <div class="fixed -bottom-48 -right-48 w-[500px] h-[500px] rounded-full"
                style="background: radial-gradient(circle, rgba(255, 196, 0, 0.729) 0%, rgba(59,130,246,0) 70%);"></div>
        </div>
    </div>

    <div class="min-h-screen flex items-center justify-center">
    <div class="flex lg:w-5/6 xl:w-4/6 w-full bg-white rounded-xl shadow-lg overflow-hidden">
        
        <div class="w-full md:w-3/6 py-16">
                <div class="w-full lg:px-15 px-10">
                    <a href="/">
                    <div class="mb-10 flex items-center space-x-3">
                            <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Logo CSR">
                            <div class="self-center text-[#003973] text-3xl font-extrabold">CSR</div>
                        </div>
                    </a>
                    
                    <div class="mb-10">
                        <div class="text-slate-600 text-3xl font-normal">Sign In</div>
                        <div class="text-slate-600 text-sm">to your account</div>
                    </div>

                    <div class="w-full md:hidden">
                        <div class="bg-primary/30 h-full px-8 flex items-center">
                            <img src="{{ asset('asset/hand2.png') }}" class="h-64 w-full object-cover" alt="Hand Image" />
                        </div>
                    </div>

                    @include('template.alert')

                <form action="{{ route('auth.login') }}" method="POST">
                @csrf
                    <div class="mt-4">
                        <label for="username" class="text-sm text-slate-400">Username</label>
                        <input id="username" name="username" required placeholder="Masukkan Username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="text" />
                    </div>

                    <div class="mt-4">
                        <label for="password" class="text-sm text-slate-400">Password</label>
                        <input id="password" name="password" required placeholder="Masukkan Password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="password" />
                        <div class="mt-2">
                            <a href="{{ route('auth.resetPassword') }}" class="w-full text-slate-400 font-normal text-sm hover:underline">Lupa Password?</a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="button-custom w-full justify-center">
                            Submit
                        </button>
                    </div>
                </div>
            </form>

            <div class="px-10 lg:px-15">
                <a href="/pilih-pengguna"
                    class="w-full flex justify-center text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 shadow-lg shadow-gray-500/50 dark:shadow-lg dark:shadow-gray-800/80 font-medium rounded-lg text-sm px-4 py-2 text-center">
                    Register
                </a>
            </div>
        </div>

        <div class="md:w-3/6 hidden md:block">
            <div class="bg-primary/30 h-full px-8 flex items-center">
                <img src="{{ asset('asset/hand2.png') }}" class="h-64 w-full object-cover" alt="Hand Image" />
            </div>
        </div>
    </div>
</div>

</body>

</html>
