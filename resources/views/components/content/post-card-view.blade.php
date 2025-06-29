<div class="bg-white shadow-xl rounded-2xl p-6 transform hover:scale-105 transition duration-300 ease-in-out">
    <a href="{{ route('post.view.page', [ 'post' => $post ]) }}" class="flex flex-col">
        <h2 class="text-2xl font-bold text-gray-900 mb-3 leading-snug">
            {{ $post->title }}
        </h2>
        <p class="text-gray-700 mb-4 line-clamp-3">
            {!! $post->intro() !!}
        </p>
        <div class="text-gray-600 text-sm mb-4">
            By <span class="font-medium text-blue-600">{{ $post->author()->username }}</span> on {{ $post->created_at }}
        </div>
    </a>

    <div class="flex justify-end gap-3">
        @can("update", $post)
            <x-link
                label="Edit"
                :href="route('post.update.page', [ 'post' => $post ])"
                linkType="light"
            />
        @endcan
        @can("delete", $post)
            <form method="post" action="{{ route('post.delete', [ 'post' => $post ]) }}">
                @csrf
                @method("delete")
                <x-button buttonType="danger" type="submit" label="Delete" />
            </form>
        @endcan
    </div>
</div>
