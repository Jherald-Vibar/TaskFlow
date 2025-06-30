<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#f0f9ff', 100: '#e0f2fe', 200: '#b9e6fe', 300: '#7dd3fc', 400: '#38bdf8', 500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1', 800: '#075985', 900: '#0c4a6e', },
                        secondary: { 50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7', 400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b', },
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">
   <button onclick="toggleSidebar()" class="fixed top-4 left-4 z-50 p-2 bg-primary-600 text-white rounded-lg shadow-md lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <div class="flex h-screen">
        <aside id="sidebar" class="w-64 bg-gradient-to-b from-primary-600 to-secondary-600 text-white flex flex-col fixed inset-y-0 left-0 z-40 overflow-y-auto shadow-xl rounded-r-xl transform transition-transform duration-300 -translate-x-full lg:translate-x-0 lg:block">
            <div class="p-4 border-b border-white/10">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
                        <img src="{{asset('images/logo.png')}}" width="64" alt="TaskFlow Logo">
                    </div>
                    <span class="ml-1 text-2xl font-bold text-white">Task<span class="text-blue-200">Flow</span></span>
                </div>

                <div class="flex items-center space-x-3 mt-6 p-3 bg-white/10 rounded-lg backdrop-blur-sm">
                    @auth
                    <div class="relative">
                        @if(empty($account->image))
                        <img src="{{ Auth::user()->image ?? asset('images/profile.png') }}" alt="Profile" class="w-12 h-12 rounded-full border-2 border-white/50">
                        @else
                        <img src="{{ asset('profile-pic/'.$account->image) }}" alt="Profile" class="w-12 h-12 rounded-full border-2 border-white/50">
                        @endif
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border border-white"></div>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-white">{{ $account->username }}</h2>
                        <p class="text-xs text-white/70">{{ Auth::user()->email }}</p>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 py-4 px-3 space-y-1">
                <p class="text-xs uppercase text-white/50 font-semibold px-3 mt-2 mb-2">Main Menu</p>

                <a href="{{route('dashboard')}}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200 group">
                    <img src="{{ asset('images/dashboard.png') }}" width="22px" alt="Dashboard" class="group-hover:scale-110 transition-transform">
                    <span class="ml-3 text-sm font-medium">Dashboard</span>
                </a>

                <a href="{{route('user-task')}}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200 group">
                    <img src="{{ asset('images/task.png') }}" width="22px" alt="Tasks" class="group-hover:scale-110 transition-transform">
                    <span class="ml-3 text-sm font-medium">Task List</span>
                </a>

                 <a href="{{route('upcomingTask', )}}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200 group">
                    <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.25 3C4.00736 3 3 4.00736 3 5.25V18.75C3 19.9926 4.00736 21 5.25 21H18.75C19.9926 21 21 19.9926 21 18.75V5.25C21 4.00736 19.9926 3 18.75 3H5.25ZM10.7803 8.78033L8.78033 10.7803C8.48744 11.0732 8.01256 11.0732 7.71967 10.7803L6.71967 9.78033C6.42678 9.48744 6.42678 9.01256 6.71967 8.71967C7.01256 8.42678 7.48744 8.42678 7.78033 8.71967L8.25 9.18934L9.71967 7.71967C10.0126 7.42678 10.4874 7.42678 10.7803 7.71967C11.0732 8.01256 11.0732 8.48744 10.7803 8.78033ZM16.75 8.5C17.1642 8.5 17.5 8.83579 17.5 9.25C17.5 9.66421 17.1642 10 16.75 10H13.25C12.8358 10 12.5 9.66421 12.5 9.25C12.5 8.83579 12.8358 8.5 13.25 8.5H16.75ZM12.5001 14.75C12.5001 14.3358 12.8358 14 13.2501 14H16.7499C17.1642 14 17.4999 14.3358 17.4999 14.75C17.4999 15.1642 17.1642 15.5 16.7499 15.5H13.2501C12.8358 15.5 12.5001 15.1642 12.5001 14.75ZM10.7803 13.2197C11.0732 13.5126 11.0732 13.9874 10.7803 14.2803L8.78033 16.2803C8.48744 16.5732 8.01256 16.5732 7.71967 16.2803L6.71967 15.2803C6.42678 14.9874 6.42678 14.5126 6.71967 14.2197C7.01256 13.9268 7.48744 13.9268 7.78033 14.2197L8.25 14.6893L9.71967 13.2197C10.0126 12.9268 10.4874 12.9268 10.7803 13.2197Z" fill="#FFFFFF"/>
                    </svg>
                    <span class="ml-3 text-sm font-medium">Upcoming Task</span>
                </a>


                <a href="{{route('today')}}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200 group">
                    <img src="{{ asset('images/today.png') }}" width="22px" alt="Today" class="group-hover:scale-110 transition-transform">
                    <span class="ml-3 text-sm font-medium">Daily Tasks</span>
                </a>

                <a href="{{route('task-insight')}}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200 group">
                     <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 2048 2048"><path fill="#fff" d="M960 384q119 0 224 45t183 124t123 183t46 224q0 63-8 118t-25 105t-44 99t-64 100q-29 40-51 72t-36 64t-21 70t-7 89v179q0 40-15 75t-41 61t-61 41t-75 15H832q-40 0-75-15t-61-41t-41-61t-15-75v-180q0-51-7-88t-21-69t-36-65t-51-72q-37-51-63-99t-44-99t-26-106t-8-118q0-119 45-224t124-183t183-123t224-46m192 1472v-64H768v64q0 26 19 45t45 19h256q26 0 45-19t19-45m256-896q0-93-35-174t-96-143t-142-96t-175-35q-93 0-174 35t-143 96t-96 142t-35 175q0 89 18 153t47 114t61 94t61 92t48 108t21 143h384q1-83 20-142t48-108t61-92t61-94t47-115t19-153M960 256q-26 0-45-19t-19-45V64q0-26 19-45t45-19t45 19t19 45v128q0 26-19 45t-45 19M192 928H64q-26 0-45-19T0 864t19-45t45-19h128q26 0 45 19t19 45t-19 45t-45 19m53 261q26 0 45 19t19 46q0 20-11 35t-30 24q-11 5-30 13t-41 17t-40 15t-32 7q-26 0-45-19t-19-46q0-20 11-35t30-24q11-4 30-13t41-17t40-15t32-7m152-645q0 26-19 45t-45 19q-18 0-33-9l-109-67q-14-9-22-23t-9-32q0-26 19-45t45-19q16 0 33 10l110 66q14 8 22 23t8 32m83-368q0-26 19-45t45-19q17 0 32 9t24 24l62 112q8 14 8 30q0 27-19 46t-45 19q-17 0-32-9t-24-24l-62-112q-8-14-8-31m1376 624q26 0 45 19t19 45t-19 45t-45 19h-128q-26 0-45-19t-19-45t19-45t45-19zm2 501q0 26-19 45t-45 19q-11 0-30-6t-41-16t-40-17t-31-14q-18-8-29-24t-12-36q0-27 19-45t46-19q12 0 31 7t40 16t40 18t31 13q18 8 29 23t11 36m-271-693q-26 0-45-19t-19-45q0-17 8-32t22-23l110-66q17-10 33-10q26 0 45 19t19 45q0 17-8 31t-23 24l-109 67q-15 9-33 9m-337-321q0-16 8-30l62-112q8-15 23-24t33-9q26 0 45 19t19 45q0 17-8 31l-62 112q-8 15-23 24t-33 9q-26 0-45-19t-19-46"/></svg>
                    <span class="ml-3 text-sm font-medium">Task Insight</span>
                </a>

                <a href="{{route('categoryView')}}" class="flex items-center px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200 group">
                    <img src="{{ asset('images/categories.png') }}" width="22px" alt="Categories" class="group-hover:scale-110 transition-transform">
                    <span class="ml-3 text-sm font-medium">Task Categories</span>
                </a>

                <p class="text-xs uppercase text-white/50 font-semibold px-3 mt-6 mb-2">User Preferences</p>

                <div id="settingsDropdown" class="relative">
                    <button id="settingsButton" type="button"
                        class="flex items-center w-full px-3 py-2.5 rounded-lg hover:bg-white/10 transition-colors duration-200 group">
                        <img src="{{ asset('images/settings.png') }}" width="22px" alt="Settings"
                            class="group-hover:scale-110 transition-transform">
                        <span class="ml-3 text-sm font-medium">Settings</span>
                        <svg id="arrowIcon" class="ml-auto w-4 h-4 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="pl-10 pr-3 py-1 space-y-1 hidden">
                        <a href="{{ route('accountSettings') }}"
                            class="flex items-center px-2 py-1.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
                            <img src="{{ asset('images/account.png') }}" width="18px" alt="Account" class="opacity-80">
                            <span class="ml-2 text-sm">Account Settings</span>
                        </a>
                        <a href="{{ route('activity-log') }}"
                            class="flex items-center px-2 py-1.5 rounded-lg hover:bg-white/10 transition-colors duration-200">
                            <svg width="18px" height="18px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M0 1.5C0 1.22386 0.223858 1 0.5 1H2.5C2.77614 1 3 1.22386 3 1.5C3 1.77614 2.77614 2 2.5 2H0.5C0.223858 2 0 1.77614 0 1.5ZM4 1.5C4 1.22386 4.22386 1 4.5 1H14.5C14.7761 1 15 1.22386 15 1.5C15 1.77614 14.7761 2 14.5 2H4.5C4.22386 2 4 1.77614 4 1.5ZM4 4.5C4 4.22386 4.22386 4 4.5 4H11.5C11.7761 4 12 4.22386 12 4.5C12 4.77614 11.7761 5 11.5 5H4.5C4.22386 5 4 4.77614 4 4.5ZM0 7.5C0 7.22386 0.223858 7 0.5 7H2.5C2.77614 7 3 7.22386 3 7.5C3 7.77614 2.77614 8 2.5 8H0.5C0.223858 8 0 7.77614 0 7.5ZM4 7.5C4 7.22386 4.22386 7 4.5 7H14.5C14.7761 7 15 7.22386 15 7.5C15 7.77614 14.7761 8 14.5 8H4.5C4.22386 8 4 7.77614 4 7.5ZM4 10.5C4 10.2239 4.22386 10 4.5 10H11.5C11.7761 10 12 10.2239 12 10.5C12 10.7761 11.7761 11 11.5 11H4.5C4.22386 11 4 10.7761 4 10.5ZM0 13.5C0 13.2239 0.223858 13 0.5 13H2.5C2.77614 13 3 13.2239 3 13.5C3 13.7761 2.77614 14 2.5 14H0.5C0.223858 14 0 13.7761 0 13.5ZM4 13.5C4 13.2239 4.22386 13 4.5 13H14.5C14.7761 13 15 13.2239 15 13.5C15 13.7761 14.7761 14 14.5 14H4.5C4.22386 14 4 13.7761 4 13.5Z"
                                    fill="#FFFFFF"
                                />
                            </svg>
                            <span class="ml-2 text-sm">Activity Log</span>
                        </a>
                    </div>
                </div>
            </nav>

           <div class="p-4 mt-auto">
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" onclick="confirmLogout()" class="flex items-center justify-center w-full px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition-colors duration-200">
                        <img src="{{ asset('images/logout.png') }}" width="20px" alt="Logout" class="mr-2">
                        <span class="text-sm font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-64 transition-all duration-300">

            <!-- Navbar -->
           <header class="bg-white p-3 shadow-md flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800 tracking-wide">{{ $title }}</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                {{ $unreadCount }}
                            </span>
                        @endif

                        <button class="text-gray-600" id="notification-button" onclick="toggleDropdown();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2V2h3v2.2q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22"/>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-72 z-50 bg-white shadow-lg rounded-lg overflow-hidden hidden" id="notification-dropdown">
                            <div class="p-4 border-b">
                                <h3 class="text-lg font-semibold text-gray-800">Task Notifications</h3>
                            </div>
                            <div class="max-h-60 overflow-y-auto p-2 space-y-2">
                                @forelse ($notifications as $notif)
                                    <div class="p-2 bg-gray-50 border border-gray-200 rounded-md text-sm text-gray-600">
                                        <strong>Task Created:</strong> {{ $notif->task->task_name }}<br>
                                        <span class="text-xs text-gray-500">Due: {{ $notif->task->due_date }} | Created {{ $notif->task->created_at->diffForHumans() }}</span>
                                        <div class="mt-1">
                                            @if($notif->status == 0)
                                                <form action="{{ route('markSingleRead', ['id'=> $notif->notification_id]) }}" method="POST">@csrf @method('PATCH')
                                                    <button type="submit" class="text-blue-500 text-sm hover:underline">Mark as Read</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500 text-sm">Read</span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500">No new tasks.</div>
                                @endforelse
                            </div>
                            @if($unreadCount > 0)
                                <form action="{{ url('/user/notifications/mark-all-read') }}" method="POST" class="p-4">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 text-white py-2 rounded-lg hover:from-primary-700 hover:to-secondary-700">Mark All as Read</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col items-start space-y-1">
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2V6M18 2V6M6 6H18M4 6V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V6H4V6Z" />
                            </svg>
                            <span id="current-date" class="text-gray-800 text-xs sm:text-sm font-medium">
                                {{ now('Asia/Manila')->format('l, F j, Y') }}
                            </span>
                        </div>
                        <span id="current-time" class="ml-5 text-indigo-600 text-xs sm:text-sm font-semibold">
                            --
                        </span>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-4 sm:p-6 md:p-8 bg-gray-50">@yield('content')</main>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('notification-dropdown').classList.toggle('hidden');
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function confirmLogout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log me out!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }


    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('settingsButton');
        const dropdown = document.getElementById('dropdownMenu');
        const arrowIcon = document.getElementById('arrowIcon');

        let open = false;

        function toggleDropdown() {
            open = !open;
            if (open) {
                dropdown.classList.remove('hidden');
                arrowIcon.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                arrowIcon.style.transform = 'rotate(0deg)';
            }
        }


        button.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDropdown();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            if (open) {
                open = false;
                dropdown.classList.add('hidden');
                arrowIcon.style.transform = 'rotate(0deg)';
            }
        });
    });


     function displayCurrentDate() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);
            document.getElementById('current-date').textContent = formattedDate;
        }

        displayCurrentDate();


        function updateTime() {
        const now = new Date();
        const options = {
            timeZone: 'Asia/Manila',
            hour: '2-digit',
            minute: '2-digit',
            hour12: true,
        };

        const timeString = now.toLocaleTimeString('en-US', options);
        document.getElementById('current-time').textContent = timeString;
        }
        updateTime();
        setInterval(updateTime, 60000);
    </script>

</body>
</html>
