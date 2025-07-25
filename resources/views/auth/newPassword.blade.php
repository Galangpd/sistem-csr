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
    <div class="flex w-1/2 bg-white rounded-xl shadow-lg overflow-hidden">
        
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

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div id="alert-2" class="flex items-center w-full p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            <div class="ms-3 text-sm font-medium">
                                Registrasi gagal! {{ $error }}
                            </div>
                            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                        @endforeach
                    @endif

                </div>
                <form action="{{ route('password.update') }}" method="POST">
                @csrf
                    <input type="hidden" name="token" value="{{ $token }}" class="hidden">
                    <input type="email" name="email" value="{{ $email }}" required class="hidden">
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" value="{{ old('password') }}" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                    </div> 
                    <div class="mb-6">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                        <input type="password" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required />
                        @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div> 

                    <div class="mt-8">
                        <button type="submit"
                            class="button-custom w-full justify-center">
                            Reset Password
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>

</body>

</html>
