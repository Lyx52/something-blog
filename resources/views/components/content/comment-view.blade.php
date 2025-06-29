<div class="bg-gray-50 rounded-xl p-6 mb-4 shadow-sm border border-gray-200">
    <div class="flex items-center mb-2">
        <p class="font-semibold text-gray-800 text-lg mr-2">{{ $comment->author()->username }}</p>
        <p class="text-gray-500 text-sm">{{ $comment->created_at->format('F d, Y H:i') }}</p>
        @can("delete", $comment)
            <form class="ms-auto" method="post" action="{{ route('comment.delete', [ 'comment' => $comment ]) }}">
                @csrf
                @method("delete")
                <x-button buttonType="danger" type="submit" label="Delete" />
            </form>
        @endcan
    </div>
    <p class="text-gray-700 leading-relaxed">
        {!! $comment->comment !!}
    </p>
</div>
