@extends("layouts/page-layout")
@section("content")
    <div class="text-center p-8 bg-white rounded-lg shadow-xl max-w-md mx-auto mt-50">
        <h1 class="text-6xl font-extrabold text-red-500 mb-4 animate-bounce">
            403
        </h1>
        <p class="text-2xl text-gray-800 font-semibold mb-2">
            Access Denied
        </p>
        <p class="text-gray-600 mb-6">
            You do not have permission to access this resource.
        </p>
        <x-link
            label="Back to home"
            :href="route('home.index.page')"
        />
    </div>
@endsection
