@extends("layouts/page-layout")
@section("content")
    <div class="text-center p-8 bg-white rounded-lg shadow-xl max-w-md mx-auto mt-50">
        <h1 class="text-6xl font-extrabold text-red-500 mb-4 animate-bounce">
            404
        </h1>
        <p class="text-2xl text-gray-800 font-semibold mb-2">
            Page Not Found
        </p>
        <p class="text-gray-600 mb-6">
            Oops! The page you're looking for doesn't exist.
        </p>
        <a href="{{ route("home.index.page") }}" class="inline-block bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">
            Go back home
        </a>
    </div>
@endsection
