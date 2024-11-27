@extends('components.app')

@section('content')
<div class="container mx-auto max-w-md py-12">
    <h1 class="text-3xl font-bold text-center mb-8">Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-input name="email" type="email" placeholder="Enter your email" required/>
        <x-input name="password" type="password" placeholder="Enter your password" required autocomplete="new-password"/>

        <div class="flex items-center justify-between mb-4">
            <label for="remember" class="inline-flex items-center">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring focus:ring-blue-300">
                <span class="ml-2 text-gray-700">Remember Me</span>
            </label>
        </div>

        <x-button>Login</x-button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-indigo-500 hover:underline">Register</a>
    </p>
</div>
@endsection
