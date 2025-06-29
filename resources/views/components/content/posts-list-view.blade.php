@foreach($pagination->items() as $post)
    <x-post-card-view :post="$post" />
@endforeach

<template>
    <div id="load-more-container" class="flex justify-center mt-10" hx-swap-oob="true">
        @if($pagination->hasMorePages())
            <x-button
                id="loadMore"
                label="Load More Posts"
                hx-get="{{ $pagination->nextPageUrl() }}"
                hx-trigger="click"
                hx-swap="beforeend"
                hx-target="#posts-container"
                hx-indicator="#loading-indicator"
            />
        @endif
    </div>
</template>
