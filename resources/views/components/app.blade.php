<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'My Blog') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col h-screen justify-between">

    <header class="bg-white shadow-md">
        <nav class="container mx-auto flex justify-between items-center py-4 px-4">

            <a href="{{ route('post.index') }}" class="text-2xl font-bold text-gray-800">My Blog</a>


            <div>
                @auth
                    <span class="text-gray-600 mr-4">Welcome, {{ Auth::user()->name }}</span>
                    <form action="{{ route('login') }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-500 hover:underline mr-4">Sign In</a>
                    <a href="{{ route('register') }}" class="text-indigo-500 hover:underline">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="container mx-auto py-8">
        @if (session('error'))
        <div class="max-w-md mx-auto">
            <div role="alert" class="text-center border-red-300 rounded-md border-l-4 bg-red-100 p-4 text-red-700 opacity-75">
                <p class="font-bold">
                    Error
                </p>
                <p> {{ session('error') }}</p>
            </div>
        </div>
        @elseif (session('success'))
        <div class="max-w-md mx-auto">
            <div role="alert" class="text-center border-green-300 rounded-md border-l-4 bg-green-100 p-4 text-green-700 opacity-75">
                <p class="font-bold">
                    Success
                </p>
                <p> {{ session('success') }}</p>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white shadow-md py-4 mt-12">
        <div class="container mx-auto text-center text-gray-600">
            &copy; {{ date('Y') }} My Blog. All rights reserved.
        </div>
    </footer>
</body>
</html>
