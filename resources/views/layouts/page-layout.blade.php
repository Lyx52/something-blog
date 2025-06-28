<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Something blog</title>

        @vite('resources/js/app.js')
    </head>
    <body class="flex flex-col h-screen">
        <header class="mb-3">
            @include("components/navbar")
            @yield("header")
        </header>
        <main class="mx-auto px-4 md:px-2">
            @yield('content')
        </main>
        <footer class="mt-auto">
            @yield("footer")
        </footer>
    </body>
</html>
