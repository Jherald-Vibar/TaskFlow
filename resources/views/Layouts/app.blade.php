<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <nav class="flex-1 space-y-4 md:space-y-1">
                <a href="{{route('dashboard')}}" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/dashboard.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a href="{{route('user-task')}}" class="block p-3 rounded-lg hover:bg-black hover:text-white">
                    <img src="{{ asset('images/task.png') }}" width="24px" alt="Settings" class="inline-block mr-2">
                        <span class="text-sm font-medium">My Task</span>
                </a>
                <a href="{{route('today')}}" class="block p-3 rounded-lg hover:bg-black hover:text-white">
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

                <div class="relative">
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $unreadCount }}
                        </span>
                    @endif

                    <button class="text-gray-600" id="notification-button" onclick="toggleDropdown();">
                        {{-- Bell Icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2V2h3v2.2q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22"/>
                        </svg>
                    </button>

                    <div class="absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg overflow-hidden hidden" id="notification-dropdown">
                        <div class="p-4 border-b">
                            <h3 class="text-lg font-semibold text-gray-800">Task Notifications</h3>
                        </div>

                        <div class="max-h-60 overflow-y-auto p-2 space-y-2">
                            @forelse ($notifications as $notif)
                                <div class="p-2 flex items-start justify-between bg-gray-50 border border-gray-200 rounded-md">
                                    <div class="text-sm text-gray-600">
                                        <strong>Task Created:</strong> {{ $notif->task->task_name }}
                                        <br>
                                        <span class="text-xs text-gray-500">Due: {{ $notif->task->due_date }}</span>
                                        <span class="text-xs text-gray-500">Created {{ $notif->task->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($notif->status == 0)
                                            <form action="{{ route('markSingleRead', ['id'=> $notif->notification_id]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700 text-sm">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12.5 21l-1.4-1.4l3.55-3.55l-3.55-3.55l1.4-1.4l3.55 3.55l3.55-3.55l1.4 1.4l-3.55 3.55L21 19.6L19.6 21l-3.55-3.55zM7 21v-2h2v2zM5 5H3q0-.825.588-1.412T5 3zm2 0V3h2v2zm4 0V3h2v2zm4 0V3h2v2zm4 0V3q.825 0 1.413.588T21 5zM5 19v2q-.825 0-1.412-.587T3 19zm-2-2v-2h2v2zm0-4v-2h2v2zm0-4V7h2v2zm16 0V7h2v2z"/></svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="ml-2 text-gray-500 text-sm">Read</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500 text-center">No new tasks.</div>
                            @endforelse
                        </div>

                        @if($unreadCount > 0)
                            <form action="{{ url('/user/notifications/mark-all-read') }}" method="POST" class="p-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                                    Mark All as Read
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2V6M18 2V6M6 6H18M4 6V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V6H4V6Z" />
                        </svg>
                        <span id="current-date" class="block text-gray-800 text-xs sm:text-sm font-medium">{{ now('Asia/Manila')->format('l, F j, Y') }}</span>
                    </div>
                    <span id="current-time" class="block text-indigo-600 text-xs sm:text-sm font-semibold">
                        --
                    </span>
                </div>
            </header>

           <!-- Main -->
           <main class="flex-1 p-3 sm:p-4 md:p-6 lg:p-8 bg-gray-50">
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

        function toggleDropdown() {
        document.getElementById('notification-dropdown').classList.toggle('hidden');
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
