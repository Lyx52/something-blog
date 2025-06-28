<div class="mb-4 max-w-sm mx-auto">
    <label class="block text-gray-700 font-bold mb-2" for="{{ $inputName }}-input">
        {{ $label  }}
    </label>
    <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        @class(['border-red-500'=> $errors->has($inputName)])
        id="{{ $inputName }}-input"
        name="{{ $inputName }}"
        type="{{ $type  }}"
        {{ $attributes }}
    >
    @error($inputName)
    <p class="text-red-500 text-xs italic mt-2">{{$message}}</p>
    @enderror
</div>
