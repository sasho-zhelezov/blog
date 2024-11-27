@extends('components.app')

@section('content')

<div class="container mx-auto py-8">
    <x-post-card :post="$post">

        <div class="px-6 py-4 border-t bg-gray-50">
            <div class="mt-4 space-y-4">
                @forelse ($post->comments as $comment)
                <x-comment-card :comment="$comment" />
                @empty
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>

            @if (Auth::user())
            <form action="{{ route('post.comment.store', $post->id) }}" method="POST" class="mt-6">
                @csrf
                <textarea name="text" rows="3" class="w-full border border-gray-200 rounded-md focus:ring focus:ring-blue-200 focus:outline-none p-2" placeholder="Write a comment..." required></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2">Post Comment</button>
            </form>
            @endif
        </div>
    </x-post-card>
</div>
@endsection
