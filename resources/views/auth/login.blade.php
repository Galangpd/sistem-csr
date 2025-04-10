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
                style="background: radial-gradient(circle, rgba(255, 132, 0, 0.507) 0%, rgba(59,130,246,0) 70%);"></div>
        </div>
    </div>

    <div class="min-h-screen flex items-center justify-center">
        <div class="flex md:w-4/6 w-full bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="md:w-3/6">
                <form action="/" method="post">
                    @csrf
                    <div class="w-full md:px-20 px-10 py-16">
                        <div class="mb-10 flex items-center space-x-3 rtl:space-x-reverse ">
                            <img src="{{ asset('asset/logo-oia.svg') }}" class="h-5" alt="Flowbite Logo">
                            <div class="">
                                <div class="self-center text-slate-600 text-lg font-extrabold">CSR.</div>
                            </div>
                        </div>
                        <div class="mb-10 flex items-center space-x-3 rtl:space-x-reverse ">
                            <div class="">
                                <div class="self-center text-slate-600 text-3xl font-normal">Sign In
                                </div>
                                <div class="self-center text-slate-600 text-sm">to your account</div>
                            </div>
                        </div>

                        @include('template.alert')

                        <div class="mt-4">
                            <label for="" class="text-sm text-slate-400">Username:</label>
                            <input required placeholder="Username..." name="username"
                                class=" text-gray-700 focus:outline-none focus:shadow-outline  border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                                type="text" />
                        </div>
                        <div class="mt-4">
                            <label for="" class="text-sm text-slate-400">Password:</label>
                            <input required placeholder="Password..." name="password"
                                class=" text-gray-700 focus:outline-none focus:shadow-outline  border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                                type="password" />
                        </div>
                        <div class="mt-8">
                            <button
                                class="w-full flex justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
                                Submit</button>
                            <button
                                class="w-full flex justify-center text-white bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 shadow-lg shadow-gray-500/50 dark:shadow-lg dark:shadow-gray-800/80 font-medium rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
                                Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="md:w-3/6 hidden md:block">
                <div class="bg-primary/30 h-full flex items-center">
                        <img src="{{ asset('asset/hand.png') }}" class="h-64 w-full object-cover"/>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
