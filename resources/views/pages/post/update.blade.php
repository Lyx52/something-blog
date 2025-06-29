@extends("layouts/page-layout")
@section("content")
    <div class="mx-auto mt-8 overflow-hidden rounded-xl bg-white shadow-md h-fit max-w-3xl">
        <div class="p-8 flex flex-col h-fit">
            <h1 class="text-2xl md:text-4xl text-center font-extrabold text-gray-900 mb-6 leading-tight">
                Edit post
            </h1>
            <form class="pt-3 h-fit" method="post" action="{{ route('post.update') }}">
                @csrf
                <x-input
                    inputName="title"
                    label="Title"
                    placeholder="Title"
                    required
                    :value="$post->title"
                    class="w-full"
                />

                <x-text-editor
                    label="Body"
                    config="default"
                    editorName="body"
                    :value="$post->body"
                />
                <input type="hidden" value="{{ $post->id }}" name="id" />

                <div class="mb-4">
                    @error('generic')
                    <p class="text-red-500 text-xs italic my-2">{{$message}}</p>
                    @enderror
                    <x-button
                        buttonType="primary"
                        type="submit"
                        label="Update"
                    />
                </div>
            </form>
        </div>
    </div>
@endsection
