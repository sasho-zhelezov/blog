@extends('components.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Comment</h1>

    <form action="{{ route('post.comment.update', [$comment->post_id, $comment->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <textarea
            name="text"
            rows="4"
            class="w-full border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none p-2"
            placeholder="Edit your comment..."
            required>{{ old('text', $comment->text) }}
        </textarea>

        @error('text')
            <div class="text-red-500 mt-2">{{ $message }}</div>
        @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2">
            Update Comment
        </button>
    </form>
</div>
@endsection
