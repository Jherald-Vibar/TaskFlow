<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="icon" href="{{asset('images/logo.png')}}">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.navbar')
    <div class="py-16">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
            <div class="w-full p-8 lg:w-1/2">
                <h2 class="text-2xl font-bold text-center text-gray-700">Reset Your Password</h2>
                <form method="POST" action="{{route('resetPassword')}}">
                    @csrf
                    <input type="hidden" name="token" hidden value="{{ $token }}">
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email Address</label>
                        <input id="email" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">New Password</label>
                        <input id="password" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" name="password" required />
                    </div>

                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" name="password_confirmation" required />
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">Reset Password</button>
                    </div>
                </form>
            </div>
            <div class="hidden lg:block lg:w-1/2 bg-cover" style="background-image:url('{{asset('images/home-right.png')}}')">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('status'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('status') }}",
                    icon: 'success',
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
        });
    </script>
</body>
</html>
