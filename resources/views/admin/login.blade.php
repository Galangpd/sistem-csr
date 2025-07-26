<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('asset/logo-oia.svg') }}" type="image/x-icon">

    <title>Admin CSR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="px-4">


    <div class="min-h-screen flex items-center justify-center">
    <div class="w-full sm:w-3/4 lg:w-2/5 bg-white rounded-xl border border-slate-300 shadow-2xl overflow-hidden">
        
        <div class="w-full py-16">
                <div class="w-full lg:px-15 px-10">
                    <a href="/">
                    <div class="mb-10 flex items-center space-x-3">
                            <img src="{{ asset('asset/logo-oia.svg') }}" class="h-7" alt="Logo CSR">
                            <div class="self-center text-[#003973] text-3xl font-extrabold">CSR</div>
                        </div>
                    </a>
                    
                    <div class="mb-10">
                        <div class="text-slate-600 text-3xl font-normal">Sign In</div>
                    </div>

                    @include('template.alert')

                <form action="{{ route('admin.login') }}" method="POST">
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
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="button-custom w-full justify-center">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
