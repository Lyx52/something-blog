@php use Illuminate\Support\Js; @endphp
    <div class="mb-4 w-full mx-auto">
        <label class="block text-gray-700 font-bold mb-2" for="{{ $editorName }}-text-editor">
            {{ $label  }}
        </label>
        @error($editorName)
        <p class="text-red-500 text-xs italic mt-2">{{$message}}</p>
        @enderror
        <script>
            // Append editor config to current instances
            window.editorConfiguration = {
                ...(window.editorConfiguration || {}),
                {{$editorName}}: {{ Js::from($toolbar) }}
            }
        </script>
        <textarea class="flex-1" name="{{ $editorName }}" id="{{ $editorName }}-text-editor" {{ $attributes }}>
            {{ $value }}
        </textarea>
</div>
