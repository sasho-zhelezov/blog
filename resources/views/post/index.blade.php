@extends('components.app')

@section('content')
@props(['titleLink' => true])

<div class="container mx-auto py-8">
    <h1 class="text-4xl font-bold text-center mb-8">Blog Posts</h1>

    <div class="space-y-8">
        @forelse ($posts as $post)
        <x-post-card :titleLink="$titleLink" :post="$post" />
        @empty
        <p class="text-center text-gray-500">No posts available. Check back later!</p>
        @endforelse

        @if($posts->count())
        <div class="mt-6 pagination">
            {{ $posts->links() }}
        </div>
        @endif()
    </div>
</div>
@endsection
