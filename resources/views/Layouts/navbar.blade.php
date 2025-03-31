<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<nav class="bg-red-800">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('homepage') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">TaskFlow</span>
        </a>
        <button id="navbar-toggle" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col justify-center items-center p-4 md:p-0 mt-4 border border-red-800 rounded-lg bg-red-800 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                @auth
                <li><a href="" class="block py-2 px-3 text-white hover:bg-red-700 md:hover:bg-transparent md:border-0 md:p-0">Dashboard</a></li>
                @else
                <li><a href="{{route('homepage')}}" class="block py-2 px-3 text-white hover:bg-red-700 md:hover:bg-transparent md:border-0 md:p-0">Home</a></li>
                <li><a href="{{route('loginForm')}}" class="block py-2 px-3 text-white hover:bg-red-700 md:hover:bg-transparent md:border-0 md:p-0">Sign In</a></li>
                @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>

    const toggleButton = document.getElementById('navbar-toggle');
    const navbarMenu = document.getElementById('navbar-default');

    toggleButton.addEventListener('click', () => {
        navbarMenu.classList.toggle('hidden');
    });
</script>
