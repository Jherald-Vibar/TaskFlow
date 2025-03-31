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
        <aside class="w-64 bg-red-600 text-white p-5 flex flex-col">
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
                    <h2 class="font-bold">{{$account->username}}</h2>
                    <p class="text-xs opacity-75">{{Auth::user()->email}}</p>
                    @endauth
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 space-y-4">
                <a href="#" class="block bg-white text-red-600 p-3 rounded-lg">📊 Dashboard</a>
                <a href="{{route('user-today')}}" class="block p-3">📅 Today</a>
                <a href="#" class="block p-3">✅ My Tasks</a>
                <a href="#" class="block p-3">📌 Task Categories</a>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="block p-3 w-full text-left">⚙️ Settings ▼</button>
                    <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white border rounded-lg shadow-lg">
                        <a href="{{route('accountSettings')}}" class="block px-4 text-black py-2 hover:bg-gray-100">👤 Account Settings</a>
                        <a href="#" class="block px-4 text-black py-2 hover:bg-gray-100">⚙️ General Settings</a>
                    </div>
                </div>

                <a href="#" class="block p-3">❓ Help</a>
            </nav>

            <a href="{{route('logout')}}" class="mt-5 block p-3 bg-white text-red-600 rounded-lg">🚪 Logout</a>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Navbar -->
            <header class="bg-white p-4 shadow-md flex justify-between items-center">
                <h1 class="text-xl font-bold">{{$title}}</h1>
                <div class="flex items-center space-x-3">
                    <form action="{{ route('searchTask') }}" method="GET" class="mb-4">
                        <input type="text" name="query" value="{{ request('query') }}"
                               placeholder="Search tasks..."
                               class="border p-2 rounded-lg">
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg">🔍</button>
                    </form>
                </div>
                <div class="text-sm text-gray-600">

                    <span id="current-date"></span>
                </div>
            </header>

           <!--Main-->
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
