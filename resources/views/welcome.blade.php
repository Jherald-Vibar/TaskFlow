<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config(key: 'app.name') }} | To-Do List Web Application</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AOS (Animate on Scroll) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body class="bg-white">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row justify-between items-center p-4 mt-10">
        <!-- Left Section -->
        <div class="flex flex-col w-full md:w-1/2 bg-transparent text-black p-4 space-y-3" data-aos="fade-right">
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-black">TO-DO</h1>
            <h1 class="font-sans font-bold text-4xl md:text-5xl text-black">LIST</h1>
            <p class="font-serif text-black font-semibold text-justify p-4">
                TaskFlow is a powerful and intuitive to-do list web app designed to enhance productivity and streamline task management. Built by the Vibar Development Team, TaskFlow allows users to effortlessly create, organize, and track their daily tasks with a clean and user-friendly interface.
            </p>
            <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-x-4 md:space-y-0">
                <button type="submit" onclick="window.location.href='{{ route('registrationForm') }}'" class="text-white bg-red-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                    Sign Up
                </button>
                <button type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100">
                    Learn More
                </button>
            </div>
        </div>

        <!-- Right Image -->
        <div class="w-full md:w-1/2 bg-transparent text-white p-4" data-aos="fade-left">
            <div class="flex justify-center items-center">
                <img src="{{ asset('images/home-right.png') }}" class="w-full md:w-auto max-h-[400px]" alt="TaskFlow Screenshot">
            </div>
        </div>
    </div>


    <div class="py-12 px-4 md:px-16 bg-gray-100" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Why Choose TaskFlow?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-center">
            <!-- Card 1 -->
            <div class="bg-white shadow-xl rounded-2xl p-6 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="100">
                <h3 class="text-xl font-semibold text-red-700 mb-2">Simple & Intuitive</h3>
                <p class="text-gray-600">Designed with user experience in mind. Organize your tasks without the clutter.</p>
            </div>
            <div class="bg-white shadow-xl rounded-2xl p-6 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="200">
                <h3 class="text-xl font-semibold text-red-700 mb-2">Smart Reminders</h3>
                <p class="text-gray-600">Never miss a task again with timely notifications and daily summaries.</p>
            </div>
            <div class="bg-white shadow-xl rounded-2xl p-6 hover:shadow-2xl transition" data-aos="zoom-in" data-aos-delay="300">
                <h3 class="text-xl font-semibold text-red-700 mb-2">Track Your Progress</h3>
                <p class="text-gray-600">Visualize the full progress of your tasks and stay motivated as you achieve your goals.</p>
            </div>
        </div>
    </div>
    </div>


    <footer class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 p-4 justify-start items-center bg-white border-t" data-aos="fade-up">
        <a href="https://www.facebook.com/jherald.vibar.1/" target="_blank">
            <button type="button" class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                    <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                </svg>
                Jherald Vibar
            </button>
        </a>

        <a href="https://github.com/Katastrofiii" target="_blank">
            <button type="button" class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/>
                </svg>
                Katastrofiii
            </button>
        </a>

        <a href="mailto:vibar_jherald@spcc.edu.ph" target="_blank">
            <button type="button" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                <svg class="w-4 h-4 me-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                    <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                </svg>
                vibar_jherald@spcc.edu.ph
            </button>
        </a>
    </footer>

    <!-- Init AOS -->
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>
