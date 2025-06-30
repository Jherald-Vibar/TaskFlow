<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<nav class="bg-gradient-to-r from-primary-600 to-secondary-600 shadow-md">
    <div class="w-full flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('homepage') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center">
               <img src="{{asset('images/logo.png')}}" width="36" alt="">
            </div>
            <span class="self-center text-2xl font-bold whitespace-nowrap text-white tracking-tight">Task<span class="text-blue-200">Flow</span></span>
        </a>
        <button id="navbar-toggle" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <div class="font-medium flex flex-col md:flex-row items-center justify-end gap-4">
                @auth
                <a href="{{ route('user-task') }}" class="block py-2 px-3 text-white hover:bg-primary-700 md:hover:bg-transparent md:border-0 md:hover:text-primary-100 transition-colors duration-200">User Task</a>
                @else
                <a href="{{route('loginForm')}}" class="px-4 py-2 text-white bg-white/20 hover:bg-white/30 rounded-lg transition-all duration-200 backdrop-blur-sm">Sign In</a>
                @endauth
            </div>
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
