
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
                <a href="{{ route('post.create.page') }}" class="text-gray-400 hover:text-white">Create post</a>
                <a href="{{ route('home.my-posts.page') }}" class="text-gray-400 hover:text-white flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                    {{ auth()->user()->username }}
                </a>
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

<div id="mobile-menu" class="fixed top-0 left-0 w-64 h-full bg-gray-900 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden opacity-0 transition-opacity">
    <div class="p-4 flex flex-col">
        <button id="close-menu-button" class="text-gray-300 hover:text-white focus:outline-none mb-4 me-2 ms-auto cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <nav class="flex flex-col space-y-4 ms-4">
            @guest
                <a href="{{ route('auth.login.page') }}" class="text-gray-400 hover:text-white text-lg">Login</a>
                <a href="{{ route('auth.register.page') }}" class="text-gray-400 hover:text-white text-lg">Register</a>
            @endguest
            @auth
                <form class="d-flex" method="post" action="{{ route('auth.logout') }}">
                    @csrf
                    <button class="text-gray-400 hover:text-white text-lg cursor-pointer" type="submit">Logout</button>
                </form>
                <a href="{{ route('post.create.page') }}" class="text-gray-400 hover:text-white">Create post</a>
                <a href="{{ route('home.my-posts.page') }}" class="text-gray-400 hover:text-white flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                    {{ auth()->user()->username }}
                </a>
            @endauth
        </nav>
    </div>
</div>
