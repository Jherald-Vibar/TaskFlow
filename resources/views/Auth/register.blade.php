<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} | Register</title>
    <link rel="icon" href="{{asset('images/logo.png')}}">
    
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
    <!--Navbar-->
    @include('layouts.navbar')

    <!--Main-->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-2xl bg-white">
            <div class="flex flex-col lg:flex-row">
                <!-- Left side (form) -->
                <div class="w-full lg:w-1/2 p-8">
                    <div class="mb-8 text-center lg:text-left">
                        <h1 class="text-2xl font-bold text-gray-800">Create your account</h1>
                        <p class="text-gray-600 mt-2">Join Swiftlist and start managing your tasks</p>
                    </div>
                    
                    <!-- Google Sign-up -->
                    <a href="{{route('google-auth')}}" class="flex items-center justify-center p-3 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 transition-all duration-200 mb-6 shadow-sm">
                        <div class="mr-3">
                            <svg class="h-6 w-6" viewBox="0 0 40 40">
                                <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#FFC107" />
                                <path d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z" fill="#FF3D00" />
                                <path d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z" fill="#4CAF50" />
                                <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#1976D2" />
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Sign up with Google</span>
                    </a>
                    
                    <!-- Divider -->
                    <div class="flex items-center my-6">
                        <div class="flex-grow h-px bg-gray-300"></div>
                        <span class="px-4 text-sm text-gray-500">or sign up with email</span>
                        <div class="flex-grow h-px bg-gray-300"></div>
                    </div>

                    <!-- Registration Form -->
                    <form method="POST" action="{{route('store')}}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input id="name" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-300 focus:border-primary-500 outline-none transition-colors" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                placeholder="johndoe" 
                                required 
                                autofocus 
                            />
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input id="email" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-300 focus:border-primary-500 outline-none transition-colors" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="name@example.com" 
                                required 
                            />
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input id="password" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-300 focus:border-primary-500 outline-none transition-colors" 
                                type="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required 
                                onchange="validatePassword()"
                            />
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input id="password_confirmation" 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-300 focus:border-primary-500 outline-none transition-colors" 
                                type="password" 
                                name="password_confirmation" 
                                placeholder="••••••••" 
                                required 
                                onkeyup="validatePassword()"
                            />
                            <p id="password-match-message" class="text-sm text-red-500 mt-1 hidden">Passwords do not match</p>
                        </div>
                        
                        <div>
                            <button id="submit-btn" type="submit" 
                                class="w-full px-4 py-3 text-white font-medium bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <!-- Sign In Link -->
                    <div class="mt-8 text-center">
                        <p class="text-gray-600">
                            Already have an account? 
                            <a href="{{route('loginForm')}}" class="text-primary-600 hover:text-primary-800 font-medium">
                                Sign in
                            </a>
                        </p>
                    </div>
                </div>
                
                <!-- Right side (image) -->
                <div class="hidden lg:block lg:w-1/2 relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-secondary-600 to-primary-600 opacity-90"></div>
                    <img src="{{asset('images/register-image.png')}}" alt="Register" class="w-full h-full object-cover mix-blend-overlay">
                    <div class="absolute inset-0 flex items-center justify-center p-8 text-center">
                        <div>
                            <h2 class="text-white text-3xl font-bold mb-4"></h2>
                            <p class="text-white text-lg opacity-90"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0ea5e9'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    title: "Validation Error!",
                    text: `{!! implode('<br>', $errors->all()) !!}`,
                    icon: "error",
                    confirmButtonColor: '#0ea5e9'
                });
            @endif
        });

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("password_confirmation").value;
            var message = document.getElementById("password-match-message");
            var submitBtn = document.getElementById("submit-btn");
            
            if (confirmPassword === "") {
                message.classList.add("hidden");
                submitBtn.disabled = false;
                return;
            }
            
            if (password === confirmPassword) {
                message.classList.add("hidden");
                submitBtn.disabled = false;
            } else {
                message.classList.remove("hidden");
                submitBtn.disabled = true;
            }
        }
    </script>
</body>
</html>
