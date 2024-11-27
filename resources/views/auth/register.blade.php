@extends('components.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-center mb-4">Register</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <x-input name="name" placeholder="Full Name" value="{{ old('name') }}" required />
        <x-input name="email" type="email" placeholder="Email Address" value="{{ old('email') }}" required />
        <x-input name="password" type="password" placeholder="Password" required />
        <x-input name="password_confirmation" type="password" placeholder="Confirm Password" required />

        <x-button class="w-full">Register</x-button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Sign In</a>
    </p>
</div>
@endsection
