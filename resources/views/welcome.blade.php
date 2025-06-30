<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
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
=======
    <title>{{ config('app.name') }} | To-Do List Web Application</title>
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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
</head>
<body class="bg-gradient-to-br from-primary-50 to-secondary-50 min-h-screen">
    @include('layouts.navbar')
    <div id="#features" class="py-10 bg-gradient-to-br from-white to-primary-50" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 bg-gradient-to-r from-primary-700 to-secondary-700 bg-clip-text text-transparent">Simplify Your Tasks with TaskFlow</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-primary-500" data-aos="zoom-in" data-aos-delay="100">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Simple & Intuitive</h3>
                    <p class="text-gray-600">Designed with user experience in mind. Organize your tasks without the clutter.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-secondary-500" data-aos="zoom-in" data-aos-delay="200">
                    <div class="w-14 h-14 bg-gradient-to-br from-secondary-400 to-secondary-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Easy Task Management</h3>
                    <p class="text-gray-600">Add, edit, and complete tasks with a straightforward approach that keeps things simple.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-t-4 border-primary-500" data-aos="zoom-in" data-aos-delay="300">
                    <div class="w-14 h-14 bg-gradient-to-br from-primary-400 to-secondary-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Track Your Progress</h3>
                    <p class="text-gray-600">Visualize the full progress of your tasks and stay motivated as you achieve your goals.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="flex flex-col md:flex-row-reverse justify-between items-center gap-12">
            <div class="flex flex-col w-full md:w-1/2 space-y-6" data-aos="fade-left">
                <div class="space-y-2">
                    <h1 class="font-sans font-bold text-5xl md:text-6xl bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">TASK<span class="text-primary-700">FLOW</span></h1>
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                        A powerful and intuitive to-do list web app designed to enhance productivity and streamline task management.
                    </p>
                </div>
                <p class="text-gray-600 text-lg">
                    TaskFlow allows users to effortlessly create, organize, and track their daily tasks with a clean and user-friendly interface.
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="{{ route('registrationForm') }}" class="px-8 py-3 text-white font-medium rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        Get Started
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2" data-aos="fade-right">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-200 to-secondary-200 rounded-3xl -rotate-3 scale-105 opacity-50"></div>
                    <div class="relative">
                        <img src="{{ asset('images/home-right.png') }}" class="w-full h-auto rounded-2xl shadow-2xl" alt="Swiftlist Screenshot">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="features" class="py-16 bg-white" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">What to Expect</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-primary-50 to-secondary-50 p-8 rounded-2xl shadow-lg" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mt-4 mb-2">Task Creation</h4>
                    <p class="text-gray-700">Create tasks with titles, descriptions, due dates, and priority levels to keep track of what matters most.</p>
                </div>
                <div class="bg-gradient-to-br from-primary-50 to-secondary-50 p-8 rounded-2xl shadow-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mt-4 mb-2">List Management</h4>
                    <p class="text-gray-700">Organize your tasks into custom lists for work, personal, shopping, or any category you need.</p>
                </div>
                <div class="bg-gradient-to-br from-primary-50 to-secondary-50 p-8 rounded-2xl shadow-lg" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 mt-4 mb-2">Progress Tracking</h4>
                    <p class="text-gray-700">Watch your productivity improve as you complete tasks and reach your goals with visual progress indicators.</p>
                </div>
>>>>>>> b0762e7 (Updated)
            </div>
        </div>
    </div>

<<<<<<< HEAD

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
=======
    <div class="py-20 bg-gradient-to-br from-secondary-50 to-primary-50/40 backdrop-blur-sm" data-aos="fade-up">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12 bg-white/60 dark:bg-gray-900/60 rounded-3xl shadow-xl p-8 lg:p-12">
                <div class="w-full lg:w-2/3">
                    <div class="rounded-3xl overflow-hidden shadow-lg transform hover:scale-105 transition duration-300">
                        <div class="aspect-video">
                            <video
                                class="w-full h-full object-cover"
                                controls
                                title="TaskFlow Demo Video"
                                poster="{{ asset('images/video-thumbnail.jpg') }}"
                            >
                                <source src="{{ asset('video_demo/TaskFLow Demo.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 text-center lg:text-left space-y-6">
                    <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                        See TaskFlow In Action
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                        Watch this quick demo to learn how to manage, track, and organize your tasks with ease. TaskFlow brings clarity and control to your productivity process.
                    </p>
                    <a href="#features" class="inline-block mt-4 px-6 py-3 bg-primary-600 text-white font-semibold rounded-full shadow-lg hover:bg-primary-700 transition">
                        Explore Features
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-r from-primary-600 to-secondary-600 py-16" data-aos="zoom-in">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Get Organized?</h2>
            <a href="{{ route('registrationForm') }}" class="px-8 py-4 bg-white text-primary-700 font-medium rounded-lg hover:bg-gray-100 shadow-lg transition duration-300 transform hover:-translate-y-1 inline-block">
                Start Your Free Account
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-8 bg-white border-t border-gray-200" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="font-bold text-2xl bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">TASK<span class="text-primary-700">FLOW</span></h3>
                    <p class="text-sm text-gray-600 mt-1">Simplify your task management</p>
                </div>
                <div class="flex gap-8">
                    <a href="#" class="text-gray-600 hover:text-primary-600 transition">About</a>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-6 pt-6 text-center md:text-left">
                <p class="text-gray-600">&copy; 2025 {{config('app.name')}}. All rights reserved.</p>
            </div>
        </div>
>>>>>>> b0762e7 (Updated)
    </footer>

    <!-- Init AOS -->
    <script>
<<<<<<< HEAD
=======

        function displayCurrentDate() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);
            document.getElementById('current-date').textContent = formattedDate;
        }


>>>>>>> b0762e7 (Updated)
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>
