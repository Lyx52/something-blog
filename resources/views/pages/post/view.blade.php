@extends("layouts/page-layout")
@section("content")
    <div class="container mx-auto p-4 md:p-8 lg:p-12 w-full">
        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-10 lg:p-12 mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
                <div class="text-gray-600 text-sm md:text-base mb-4 sm:mb-0">
                    <div class="flex flex-wrap items-center text-gray-600 text-sm md:text-base mb-4 sm:mb-0">
                        <span class="me-2 mb-2">
                            By&nbsp;<span class="font-medium text-blue-600">{{ $author->username }}</span>&nbsp;on&nbsp;{{ $post->created_at->format('F d, Y H:i') }}
                        </span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->categories()->get() as $category)
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                                    {{ $category->title }}
                                </span>
                            @endforeach
                        </div>
                    </div>

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
                    <x-comment-view :comment="$comment" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
