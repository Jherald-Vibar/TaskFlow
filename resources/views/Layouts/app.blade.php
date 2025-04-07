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
            <header class="bg-white p-4 shadow-md flex justify-between items-center">
                <h1 class="text-xl font-bold">{{$title}}</h1>
                <div class="flex items-center space-x-3">
                    <form action="{{ route('searchTask') }}" method="GET" class="mb-4 flex items-center space-x-2">
                        <input type="text" name="query" value="{{ request('query') }}"
                               placeholder="Search tasks..."
                               class="border p-2 rounded-lg flex-grow">
                        <button class="bg-gradient-to-r from-red-500 via-red-600 to-red-700 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/search.png') }}" alt="" class="w-5 h-5">
                        </button>
                    </form>
                </div>
                <div class="text-sm text-gray-600">
                    <span id="current-date"></span>
                </div>
            </header>

           <!-- Main -->
            <main class="flex-1 p-6 bg-gray-50">
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
