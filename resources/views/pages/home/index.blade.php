@extends("layouts/page-layout")
@section("content")
    <div class="container mx-auto p-4 md:p-8 lg:p-12">
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 mb-10 text-center leading-tight">
            @if($userPosts)
                My Posts
            @else
                Latest Blog Posts
            @endif
        </h1>

        <div class="flex w-full">
            <div class="relative w-full max-w-3/4 md:max-w-2/5 mx-auto">
                <input
                    id="post-search"
                    type="search"
                    name="query"
                    placeholder="Search..."
                    class="w-full py-2 pl-10 pr-4 rounded-full bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    hx-trigger="input changed delay:500ms"
                    hx-target="#posts-container"
                    hx-swap="innerHTML"
                    hx-get="/load-more?page=1{{ $userPosts ? '&user=1' : '' }}"
                    hx-include="#post-search"
                    hx-indicator="#search-indicator"
                >
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-8 mb-8 mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Categories</h2>
            <div class="flex flex-wrap gap-3"
                 id="checkboxContainer"
            >
                @foreach($categories as $category)
                    <x-category-checkbox
                        :category="$category"
                        name="categories[]"
                        hx-trigger="change"
                        hx-get="/load-more?page=1{{ $userPosts ? '&user=1' : '' }}"
                        hx-include="[name='categories[]']"
                        hx-target="#posts-container"
                        hx-swap="innerHTML"
                        hx-indicator="#search-indicator"
                    />
                @endforeach
            </div>
        </div>

        <x-loading-indicator
            id="search-indicator"
            class="my-10"
        />

        <div id="posts-container" class="grid grid-cols-1 gap-8 mt-10">
            <x-posts-list-view :pagination="$pagination" />
        </div>

        <x-loading-indicator
            id="load-more-indicator"
            class="mt-10"
        />

        @if($pagination->hasMorePages())
            <div id="load-more-container" class="flex justify-center mt-10" hx-swap-oob="true">
                <x-button
                    id="loadMore"
                    label="Load More Posts"
                    hx-get="{{ $pagination->nextPageUrl() }}"
                    hx-trigger="click"
                    hx-swap="beforeend"
                    hx-target="#posts-container"
                    hx-indicator="#load-more-indicator"
                />
            </div>
        @else
            <div id="load-more-container" class="flex justify-center mt-10" hx-swap-oob="true">

            </div>
        @endif
    </div>
@endsection
