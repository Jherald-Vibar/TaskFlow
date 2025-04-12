<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password - TaskFlow</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main -->
    <div class="py-16">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
            <div class="hidden lg:block lg:w-1/2 bg-cover"
                style="background-image:url('{{ asset('images/auth-image.png') }}')">
            </div>
            <div class="w-full p-8 lg:w-1/2">
                <h2 class="text-2xl font-semibold text-gray-700 text-center">Forgot Password</h2>
                <p class="text-sm text-gray-600 text-center mt-2">Enter your email to receive a reset link</p>

                <form method="POST" action="{{route('resetPass')}}">
                    @csrf
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email Address</label>
                        <input id="email" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Send Reset Link</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('loginForm') }}" class="text-sm text-gray-500 hover:underline">Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
