<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{asset('images/logo.png')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Main Container -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white p-5 flex flex-col fixed inset-y-0 left-0 z-10 overflow-y-auto shadow-lg">
            <div class="flex items-center space-x-3 mb-5">
                @auth
                @if(empty($account->image))
                <img src="{{Auth::user()->image ?? asset('images/profile.png') }}" alt="Profile" class="w-10 h-10 rounded-full">
                @else
                <img src="{{ asset('profile-pic/'.$account->image) }}" alt="Profile" class="w-10 h-10 rounded-full">
                @endif
                <div>
                @endauth
                    @auth
                    <h2 class="font-bold text-lg">{{ $account->username }}</h2>
                    <p class="text-xs opacity-75">{{ Auth::user()->email }}</p>
                    @endauth
                </div>
            </div>
            <!-- Navigation Links -->
            <nav class="flex-1 space-y-4">
                <a href="#" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/dashboard.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a href="{{route('user-task')}}" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/task.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                        <span class="text-sm font-medium">My Task</span>
                </a>
                <a href="#" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/today.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                    <span class="text-sm font-medium">Today</span>
                </a>
                <a href="{{route('categoryView')}}" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/categories.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                    <span class="text-sm font-medium">Task Category</span>
                </a>
                <a href="{{route('upcomingTask' ,['date' => now('Asia/Manila')->format('Y-m-d')])}}" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/upcoming.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                    <span class="text-sm font-medium">Upcoming Task</span>
                </a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="block p-3 w-full text-left hover:bg-black  hover:text-white rounded-lg transition duration-300">
                        <img src="{{ asset('images/settings.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                        <span class="text-sm font-medium">Settings</span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-black border rounded-lg shadow-lg">
                        <a href="{{route('accountSettings')}}" class="block px-4 text-white py-2 ">
                            <img src="{{ asset('images/account.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                            <span class="text-sm font-medium">Account Settings</span>
                            </a>
                        </a>
                        <a href="" class="block px-4 text-white py-2 ">
                            <img src="{{ asset('images/general.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                            <span class="text-sm font-medium">General Settings</span>
                            </a>
                        </a>
                    </div>
                </div>
                <a href="#" class="block p-3 hover:bg-black rounded-lg hover:text-white">
                    <img src="{{ asset('images/help.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                    <span class="text-sm font-medium">Help</span>
                </a>
            </nav>

            <div class="mt-5 border-t-2 border-black">
                <a href="{{route('logout')}}" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/logout.png') }}" width="24px" alt="Logout" class="inline-block mr-2">
                    <span class="text-sm font-medium">Logout</span>
                </a>
            </div>
        </aside>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">

            <!-- Navbar -->
            <header class="bg-white p-3 shadow-md flex items-center justify-between space-x-6">
                <h1 class="text-2xl sm:text-2xl font-bold text-gray-800 tracking-wide">{{ $title }}</h1>
                <form action="{{ route('searchTask') }}" method="GET" class="flex items-center space-x-3 bg-gray-100 p-2 rounded-lg shadow-md">
                    <input type="text" name="query" value="{{ request('query') }}"
                           placeholder="Search tasks..."
                           class="border border-gray-300 p-2 rounded-lg w-72 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200">
                    <button type="submit" class="bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        <img src="{{ asset('images/search.png') }}" alt="Search" class="w-5 h-5">
                    </button>
                </form>
                <div class="text-sm text-gray-600 flex flex-col items-center space-y-2">
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2V6M18 2V6M6 6H18M4 6V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V6H4V6Z" />
                        </svg>
                        <span id="current-date" class="block text-gray-800 text-xs sm:text-sm font-medium">{{ now('Asia/Manila')->format('l, F j, Y') }}</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V12L16 14M12 6C9.23858 6 7 8.23858 7 11C7 13.7614 9.23858 16 12 16C14.7614 16 17 13.7614 17 11C17 8.23858 14.7614 6 12 6ZM12 11V6C12 5.44772 11.5523 5 11 5C10.4477 5 10 5.44772 10 6V11C10 11.5523 10.4477 12 11 12H12C12.5523 12 13 11.5523 13 11C13 10.4477 12.5523 10 12 10H11C10.4477 10 10 9.55228 10 9H12C12.5523 9 13 9.55228 13 10H14C14.4477 10 15 9.55228 15 9H16C16.4477 9 17 9.55228 17 10H16C15.4477 10 15 9.55228 15 9H14Z" />
                        </svg>
                        <span id="current-time" class="block text-indigo-600 text-xs sm:text-sm font-semibold">{{ now('Asia/Manila')->format('h:i A') }}</span>
                    </div>
                </div>
            </header>

           <!-- Main -->
            <main class="flex-1 p-3 bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>

    <script>

        function displayCurrentDate() {
            const today = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = today.toLocaleDateString('en-US', options);
            document.getElementById('current-date').textContent = formattedDate;
        }

        displayCurrentDate();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
