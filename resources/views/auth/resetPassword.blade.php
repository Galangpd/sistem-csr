<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('asset/logo-oia.svg') }}" type="image/x-icon">

    <title>Reset Password</title>

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
    <div class="flex w-full sm:w-3/4 md:w-1/2 bg-white rounded-xl shadow-lg overflow-hidden">
        
        <div class="w-full py-16 lg:px-15 px-10">
                <div class="w-full">
                    <a href="/">
                    <div class="mb-10 flex items-center space-x-3">
                            <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Logo CSR">
                            <div class="self-center text-[#003973] text-3xl font-extrabold">CSR</div>
                        </div>
                    </a>
                    
                    <div class="mb-10">
                        <div class="text-slate-600 text-3xl font-bold">Reset Password</div>
                    </div>

                    @include('template.alert')

                </div>
                <form action="{{ route('password.email') }}" method="POST">
                @csrf
                    <div class="mt-4">
                        <label for="email" class="text-sm text-slate-400">Email</label>
                        <input id="email" name="email" required placeholder="Masukkan Email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            type="text" />
                    </div>

                    <div class="mt-5">
                        <button type="submit"
                            class="button-custom w-full justify-center">
                            Kirim Link Reset Password
                        </button>
                    </div>
                </form>
                <div class="mt-3">
                    <a href="/login" class="rounded-lg w-fit bg-white text-slate-400 hover:underline">
                        Kembali ke halaman login
                        </a>
                </div>
        </div>
    </div>
</div>

</body>

</html>
