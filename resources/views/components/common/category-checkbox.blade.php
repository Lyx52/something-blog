<label class="relative flex items-center cursor-pointer select-none">
    <input type="checkbox" value="{{ $category->id }}" class="sr-only peer"
        {{ $attributes }}
    >
    <span class="px-4 py-2 rounded-full font-medium transition duration-200 ease-in-out
                                 bg-gray-100 text-gray-800
                                 peer-checked:bg-blue-100 peer-checked:text-blue-800
                                 hover:bg-gray-200 peer-checked:hover:bg-blue-200 select-none">
        {{ $category->title }}
    </span>
</label>
