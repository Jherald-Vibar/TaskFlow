<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} | Forgot Password</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#b9e6fe',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                    },
                },
            },
        }
    </script>

    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-primary-50 to-secondary-50 min-h-screen">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-2xl bg-white">
            <div class="flex flex-col lg:flex-row">
                <!-- Left side (image) -->
                <div class="hidden lg:block lg:w-1/2 relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-secondary-600 opacity-90"></div>
                    <img src="{{ asset('images/auth-image.png') }}" alt="Forgot Password" class="w-full h-full object-cover mix-blend-overlay">
                    <div class="absolute inset-0 flex items-center justify-center p-8 text-center">
                        <div>
                            <h2 class="text-white text-3xl font-bold mb-4"></h2>
                            <p class="text-white text-lg opacity-90"></p>
                        </div>
                    </div>
                </div>

                <!-- Right side (form) -->
                <div class="w-full lg:w-1/2 p-8">
                    <div class="mb-8 text-center lg:text-left">
                        <h1 class="text-2xl font-bold text-gray-800">Forgot Password</h1>
                        <p class="text-gray-600 mt-2">Enter your email to receive a reset link</p>
                    </div>

                    <form method="POST" action="{{route('resetPass')}}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input id="email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-300 focus:border-primary-500 outline-none transition-colors"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="name@example.com"
                                required
                                autofocus
                            />
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full px-4 py-3 text-white font-medium bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                Send Reset Link
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-center">
                        <a href="{{ route('loginForm') }}" class="text-primary-600 hover:text-primary-800 font-medium">
                            Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(session('status'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('status') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                title: "Validation Error!",
                text: `{!! implode('<br>', $errors->all()) !!}`,
                icon: "error"
            });
        @endif

        @if(session('success'))
        Swal.fire({
        title: "Success!",
        text: "{{ session('success') }}",
        icon: "success",
        confirmButtonText: "OK"
            });
        @endif
    </script>
</body>
</html>
