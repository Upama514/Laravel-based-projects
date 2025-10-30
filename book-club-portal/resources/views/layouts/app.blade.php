<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Club Portal</title>
    
    <!-- Replace Tailwind CDN with Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-indigo-700 { background-color: #4f46e5; }
        .bg-indigo-500 { background-color: #6366f1; }
        .hover\:bg-indigo-600:hover { background-color: #4f46e5; }
        .hover\:text-indigo-200:hover { color: #e0e7ff; }
        .bg-gray-50 { background-color: #f9fafb; }
        .bg-gray-800 { background-color: #1f2937; }
        .bg-white { background-color: white; }
        .text-white { color: white; }
        .shadow { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); }
        .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .rounded { border-radius: 0.375rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .min-h-screen { min-height: 100vh; }
        .flex { display: flex; }
        .flex-grow { flex-grow: 1; }
        .flex-col { flex-direction: column; }
        .justify-between { justify-content: space-between; }
        .items-center { align-items: center; }
        .max-w-6xl { max-width: 72rem; }
        .max-w-4xl { max-width: 56rem; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
        .py-8 { padding-top: 2rem; padding-bottom: 2rem; }
        .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
        .px-3 { padding-left: 0.75rem; padding-right: 0.75rem; }
        .py-1 { padding-top: 0.25rem; padding-bottom: 0.25rem; }
        .space-x-6 > * + * { margin-left: 1.5rem; }
        .space-x-4 > * + * { margin-left: 1rem; }
        .transition-colors { transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out; }
        .bg-green-100 { background-color: #dcfce7; }
        .border-green-400 { border-color: #4ade80; }
        .text-green-700 { color: #15803d; }
        .bg-red-100 { background-color: #fee2e2; }
        .border-red-400 { border-color: #f87171; }
        .text-red-700 { color: #b91c1c; }
        .mb-6 { margin-bottom: 1.5rem; }
        .p-6 { padding: 1.5rem; }
        .mt-8 { margin-top: 2rem; }
        .text-center { text-align: center; }
        .list-disc { list-style-type: disc; }
        .list-inside { list-style-position: inside; }
    </style>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>