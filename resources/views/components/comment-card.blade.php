<div class="bg-gray-100 rounded-lg p-4 mb-4 shadow-md">

    <p class="text-sm text-gray-600 mb-2">
        By <span class="font-medium text-gray-700">{{ $comment->user->name }}</span>
        <span class="text-gray-400">| {{ $comment->created_at->diffForHumans() }}</span>
    </p>


    <p class="text-gray-800 mb-4">{{ $comment->text }}</p>

    @if(Auth::user())
        <div class="flex justify-end items-center text-center gap-2 mt-2">

            @if (auth()->check() && auth()->user()->id === $comment->user_id)
                <a href="{{ route('post.comment.edit', [$comment->post_id, $comment->id]) }}" class="text-yellow-500 hover:underline text-md">
                    Edit
                </a>
            @endif


            @if (auth()->check() && auth()->user()->id === $comment->user_id)
                <form action="{{ route('post.comment.destroy', [$comment->post_id, $comment->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline text-md">
                        Delete
                    </button>
                </form>
            @endif
        </div>

        <button
            onclick="toggleReplyForm('{{ $comment->id }}')"
            class="text-blue-500 text-sm hover:underline flex items-center mb-2"
        >
            <img src="/images/reply.png" alt="Reply" class="w-4 h-4 mr-1">
            Reply
        </button>

        <div id="reply-form-{{ $comment->id }}" class="hidden mt-2">
            <form action="{{ route('post.comment.store', $comment->post_id) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea
                    name="text"
                    rows="3"
                    class="w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none p-2"
                    placeholder="Write your reply..."
                    required
                ></textarea>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2 hover:bg-blue-600 transition"
                >
                    Post Reply
                </button>
            </form>
        </div>
    @endif

    @if ($comment->children->isNotEmpty())
        <div class="mt-4 pl-6 border-l border-gray-200">
            @foreach ($comment->children as $childComment)
                <x-comment-card :comment="$childComment" />
            @endforeach
        </div>
    @endif
</div>
