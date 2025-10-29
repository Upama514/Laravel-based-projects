<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Club Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-indigo-700 text-white shadow-md">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <div class="flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-indigo-200 transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-indigo-200 transition-colors">About</a>
                </div>
                
                <div class="flex space-x-4 items-center">
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-indigo-200 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="bg-indigo-500 hover:bg-indigo-600 px-3 py-1 rounded transition-colors">
                            Get Started
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="hover:text-indigo-200 transition-colors">Dashboard</a>
                        <a href="{{ route('books.index') }}" class="hover:text-indigo-200 transition-colors">My Books</a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-indigo-200 transition-colors">
                                Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-4xl mx-auto w-full px-4 py-8">
        <!-- Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Content -->
        <div class="bg-white rounded-lg shadow p-6">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <p>© 2025 Book Club Portal | All rights reserved</p>
        </div>
    </footer>
</body>
</html>