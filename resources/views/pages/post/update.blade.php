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
                @php
                    // Fetch selected post category id's
                    $selectedCategories = $post->categories()->get()->pluck('id');
                @endphp

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Categories</h2>
                    @error('categories[]')
                    <p class="text-red-500 text-xs italic my-2">{{$message}}</p>
                    @enderror
                    <div class="flex flex-wrap gap-3"
                         id="checkboxContainer"
                    >
                        @foreach($categories as $category)
                            <x-category-checkbox
                                name="categories[]"
                                :category="$category"
                                :checked="$selectedCategories->contains($category->id)"
                            />
                        @endforeach
                    </div>
                </div>

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
