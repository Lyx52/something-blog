
<nav class="bg-gray-800 p-4">
    <div class="mx-auto flex items-center justify-between">
        <div>
            <a href="{{ route("home.index.page")  }}" class="text-white text-xl font-bold">{{ config("app.name") }}</a>
        </div>


        <div class="hidden md:flex space-x-3">
            @guest
                <a href="{{ route('auth.login.page') }}" class="text-gray-400 hover:text-white">Login</a>
                <a href="{{ route('auth.register.page') }}" class="text-gray-400 hover:text-white">Register</a>
            @endguest
            @auth
                <form class="d-flex" method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="text-gray-400 hover:text-white cursor-pointer" type="submit">Logout</button>
                </form>
                <a href="{{ route('auth.login.page') }}" class="text-gray-400 hover:text-white">{{ auth()->user()->username }}</a>
            @endauth
        </div>

        <div class="md:hidden">
            <button id="open-menu-button" class="text-gray-300 hover:text-white focus:outline-none cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

<div id="blur-backdrop" class="fixed inset-0 bg-opacity-30 backdrop-blur-xs z-40 hidden"></div>

<div id="mobile-menu" class="fixed top-0 left-0 w-64 h-full bg-gray-900 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
    <div class="p-4 flex flex-col">
        <button id="close-menu-button" class="text-gray-300 hover:text-white focus:outline-none mb-4 me-2 ms-auto cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <nav class="flex flex-col space-y-4 ms-4">
            @guest
                <a href="{{ route('auth.login.page') }}" class="text-gray-400 hover:text-white text-lg border-b">Login</a>
                <a href="{{ route('auth.register.page') }}" class="text-gray-400 hover:text-white text-lg border-b">Register</a>
            @endguest
            @auth
                <form class="d-flex" method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="text-gray-400 hover:text-white text-lg border-b cursor-pointer" type="submit">Logout</button>
                </form>
                <a href="{{ route('auth.login.page') }}" class="text-gray-400 hover:text-white">{{ auth()->user()->username }}</a>
            @endauth
        </nav>
    </div>
</div>

@vite('resources/js/components/navbar.js')
