@extends("layouts/page-layout")
@section("content")
    <div class="container mx-auto p-4 md:p-8 lg:p-12 w-full">
        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-10 lg:p-12 mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
                <div class="text-gray-600 text-sm md:text-base mb-4 sm:mb-0">
                    By <span class="font-medium text-blue-600">{{ $author->username }}</span> on {{ $post->created_at->format('F d, Y H:i') }}
                </div>
                <div class="flex gap-3">
                    @can("update", $post)
                        <x-link
                            label="Edit Post"
                            :href="route('post.update.page', [ 'post' => $post ])"
                            linkType="light"
                        />
                    @endcan
                    @can("delete", $post)
                        <form method="post" action="{{ route('post.delete', [ 'post' => $post ]) }}">
                            @csrf
                            @method("delete")
                            <x-button buttonType="danger" type="submit" label="Delete Post" />
                        </form>
                    @endcan
                </div>

            </div>

            <div class="prose max-w-none text-gray-800 leading-relaxed text-base md:text-lg">
                {!! $post->body !!}
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-10 lg:p-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Comments</h2>
            @auth
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Leave a Comment</h3>
                    <form method="post" action="{{ route('comment.create', [ 'post' => $post ]) }}">
                        @csrf
                        <x-text-editor
                            config="simple"
                            editorName="comment"
                        />
                        <input type="hidden" name="id" value="{{ $post->id }}" />
                        <x-button
                            buttonType="primary"
                            type="submit"
                            label="Post Comment"
                        />
                    </form>
                </div>
            @endauth

            <div>
                @foreach($comments as $comment)
                    <div class="bg-gray-50 rounded-xl p-6 mb-4 shadow-sm border border-gray-200">
                        <div class="flex items-center mb-2">
                            <p class="font-semibold text-gray-800 text-lg mr-2">{{ $comment->author->username }}</p>
                            <p class="text-gray-500 text-sm">{{ $comment->created_at->format('F d, Y H:i') }}</p>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            {!! $comment->comment !!}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
