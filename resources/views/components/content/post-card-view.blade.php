<div class="bg-white shadow-xl rounded-2xl p-6 transform hover:scale-105 transition duration-300 ease-in-out">
    <a href="{{ route('post.view.page', [ 'post' => $post ]) }}" class="flex flex-col">
        <h2 class="text-2xl font-bold text-gray-900 mb-3 leading-snug">
            {{ $post->title }}
        </h2>
        <p class="text-gray-700 mb-4 line-clamp-3">
            {!! $post->intro() !!}
        </p>
        <div class="flex flex-wrap items-center text-gray-600 text-sm md:text-base mb-4 sm:mb-0">
            <span class="me-2">
                By&nbsp;<span class="font-medium text-blue-600">{{ $post->author()->username }}</span>&nbsp;on&nbsp;{{ $post->created_at->format('F d, Y H:i') }}
            </span>
            <div class="flex flex-wrap gap-2">
                @foreach($post->categories()->get() as $category)
                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                        {{ $category->title }}
                    </span>
                @endforeach
            </div>
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
