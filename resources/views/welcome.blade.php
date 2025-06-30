<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            </div>
        </div>
    </div>

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
    </footer>

    <!-- Init AOS -->
    <script>

        function displayCurrentDate() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);
            document.getElementById('current-date').textContent = formattedDate;
        }


        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>
