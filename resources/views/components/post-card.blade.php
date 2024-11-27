<div class="bg-white shadow-md rounded-lg overflow-hidden">

    <div class="px-6 py-4">
        <h2 class="text-2xl font-semibold text-gray-800">
            @if($titleLink)
            <a class="hover:underline" href="{{ route('post.show', $post) }}">{{ ucwords($post->title) }}</a>
            @else
            {{ $post->title }}
            @endif
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            By <span class="font-medium text-gray-700">{{ $post->user->name }}</span>
            | Posted on {{ $post->created_at->format('F j, Y') }}
        </p>
    </div>

    <div class="px-6 py-4 border-t">
        <p class="text-gray-600 text-lg">{{ $post->body }}</p>
    </div>

    <div class="px-6 py-4">
        <h3 class="text-lg font-semibold text-gray-700">Comments ({{ $post->comments->count() }})</h3>
    </div>

    {{ $slot }}
</div>
