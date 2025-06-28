@extends("layouts/page-layout")
@section("content")
    <div class="container mx-auto p-4 md:p-8 lg:p-12">
        <!-- Blog Post Section -->
        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-10 lg:p-12 mb-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
                <div class="text-gray-600 text-sm md:text-base mb-4 sm:mb-0">
                    By <span class="font-medium text-blue-600">{{ $author->username }}</span> on {{ $post->created_at->format('F d, Y H:i') }}
                </div>
                <div class="flex">
                    @can("update", $post)
                        <a
                            href="{{ route("post.update.page", [ 'post' => $post ]) }}"
                            class="border border-gray-200 bg-gray-200 text-black rounded-md px-4 py-2 transition duration-300 ease select-none hover:bg-gray-300 focus:outline-none focus:shadow-outline cursor-pointer me-3"
                        >
                            Edit Post
                        </a>
                    @endcan
                    @can("delete", $post)
                        <form class="d-flex" method="post" action="{{ route('post.delete', [ 'post' => $post ]) }}">
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
                    <form>
                        <div class="mb-4">
                            <label for="comment-author" class="block text-gray-700 text-sm font-medium mb-2">Your Name</label>
                            <input type="text" id="comment-author" name="author" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" placeholder="John Doe">
                        </div>
                        <div class="mb-6">
                            <label for="comment-text" class="block text-gray-700 text-sm font-medium mb-2">Your Comment</label>
                            <textarea id="comment-text" name="comment" rows="6" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" placeholder="Type your comment here..."></textarea>
                        </div>
                        <button type="submit" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">
                            Post Comment
                        </button>
                    </form>
                </div>
            @endauth

            <!-- Existing Comments List -->
            <div id="comments-list">
                <!-- Comment 1 -->
                <div class="bg-gray-50 rounded-xl p-6 mb-4 shadow-sm border border-gray-200">
                    <div class="flex items-center mb-2">
                        <p class="font-semibold text-gray-800 text-lg mr-2">Alice Wonderland</p>
                        <p class="text-gray-500 text-sm">June 27, 2025 at 10:30 AM</p>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        This is a fantastic article! I especially appreciate the insights on component-based architectures. It's truly changed the way I approach front-end development. Keep up the great work!
                    </p>
                </div>

                <!-- Comment 2 -->
                <div class="bg-gray-50 rounded-xl p-6 mb-4 shadow-sm border border-gray-200">
                    <div class="flex items-center mb-2">
                        <p class="font-semibold text-gray-800 text-lg mr-2">Bob The Builder</p>
                        <p class="text-gray-500 text-sm">June 26, 2025 at 03:15 PM</p>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        Very informative! The section on serverless and edge computing was particularly helpful. I've been looking into those technologies for my next project. Thanks for sharing!
                    </p>
                </div>

                <!-- Comment 3 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-sm border border-gray-200">
                    <div class="flex items-center mb-2">
                        <p class="font-semibold text-gray-800 text-lg mr-2">Charlie Chaplin</p>
                        <p class="text-gray-500 text-sm">June 25, 2025 at 08:00 PM</p>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        Great read! I'd love to see a follow-up article discussing specific examples or case studies related to integrating AI into web experiences.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
