<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: #f0f8ff; /* Light blue background */
                font-family: 'Figtree', sans-serif;
                color: #333;
            }
            .navbar-custom {
                background: linear-gradient(135deg, #6a89cc, #4a69bd); /* Blue gradient */
                padding: 1.2rem 0;
                box-shadow: 0 2px 15px rgba(0,0,0,0.1);
                min-height: 80px;
            }
            .main-content {
                margin-top: 30px;
            }
            .content-card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.08);
                border: none;
                padding: 2.5rem;
                border-left: 5px solid #6a89cc;
            }
            .btn-custom {
                border-radius: 8px;
                padding: 0.6rem 1.5rem;
                font-weight: 500;
                font-size: 1rem;
                transition: all 0.3s ease;
                border: none;
            }
            .btn-primary-custom {
                background: linear-gradient(135deg, #6a89cc, #4a69bd);
                color: white;
            }
            .btn-primary-custom:hover {
                background: linear-gradient(135deg, #5a79bc, #3a59ad);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(106, 137, 204, 0.3);
            }
            .btn-success-custom {
                background: linear-gradient(135deg, #2ecc71, #27ae60);
                color: white;
            }
            .btn-success-custom:hover {
                background: linear-gradient(135deg, #27ae60, #219653);
                transform: translateY(-2px);
            }
            .btn-outline-light-custom {
                border: 2px solid white;
                color: white;
                background: transparent;
            }
            .btn-outline-light-custom:hover {
                background: white;
                color: #4a69bd;
            }
            .table-custom {
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 2px 15px rgba(0,0,0,0.05);
                font-size: 1rem;
                background: white;
            }
            .table-custom thead {
                background: linear-gradient(135deg, #6a89cc, #4a69bd);
                color: white;
            }
            .table-custom th {
                font-weight: 600;
                font-size: 1.1rem;
                padding: 1.2rem;
                border: none;
            }
            .table-custom td {
                padding: 1.2rem;
                vertical-align: middle;
                border-color: #e6f2ff;
                background: #f8fbff;
            }
            .table-custom tbody tr:hover td {
                background: #e6f2ff;
                transform: scale(1.01);
                transition: all 0.2s ease;
            }
            .page-title {
                color: #2c3e50;
                font-weight: 700;
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
            }
            .page-subtitle {
                color: #7f8c8d;
                font-size: 1.2rem;
                margin-bottom: 2rem;
                font-weight: 400;
            }
            .brand-text {
                font-size: 2rem;
                font-weight: 700;
                color: white;
            }
            .action-buttons .btn {
                margin: 0 3px;
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
                border-radius: 6px;
                transition: all 0.3s ease;
            }
            .btn-view {
                background: #3498db;
                color: white;
            }
            .btn-edit {
                background: #2ecc71;
                color: white;
            }
            .btn-delete {
                background: #e74c3c;
                color: white;
            }
            .btn-view:hover, .btn-edit:hover, .btn-delete:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                opacity: 0.9;
            }
            .alert {
                border-radius: 10px;
                border: none;
                padding: 1.2rem;
                font-size: 1rem;
            }
            .alert-success {
                background: #d4edda;
                color: #155724;
                border-left: 4px solid #28a745;
            }
            .alert-danger {
                background: #f8d7da;
                color: #721c24;
                border-left: 4px solid #dc3545;
            }
            .welcome-text {
                font-size: 1.1rem;
                color: white;
                font-weight: 500;
            }
            .blog-item {
                background: #f8fbff;
                border-radius: 10px;
                padding: 1.5rem;
                margin-bottom: 1.5rem;
                border-left: 4px solid #6a89cc;
                transition: all 0.3s ease;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            }
            .blog-item:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            }
            .blog-title {
                font-size: 1.4rem;
                font-weight: 600;
                color: #2c3e50;
                margin-bottom: 0.8rem;
            }
            .blog-content {
                color: #555;
                line-height: 1.6;
                margin-bottom: 1.2rem;
            }
            .form-control {
                border-radius: 8px;
                padding: 0.8rem 1rem;
                border: 1px solid #ddd;
                transition: all 0.3s ease;
            }
            .form-control:focus {
                border-color: #6a89cc;
                box-shadow: 0 0 0 3px rgba(106, 137, 204, 0.2);
            }
            .form-label {
                font-weight: 600;
                color: #4a69bd;
                margin-bottom: 0.5rem;
            }
        </style>
    </head>
    <body>
        <!-- Navigation Menu -->
        <nav class="navbar-custom">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Logo/Brand -->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('blogs.index') }}" class="text-decoration-none">
                            <h3 class="mb-0 brand-text">
                                <i class="fas fa-blog me-2"></i>
                                BlogMaster
                            </h3>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="d-flex align-items-center gap-3">
                        @auth
                            <!-- Logged In User -->
                            <span class="welcome-text me-3">
                                <i class="fas fa-user me-2"></i>
                                Welcome, {{ Auth::user()->name }}
                            </span>
                            
                            <!-- Logout Button -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-light btn-custom">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </button>
                            </form>
                        @else
                            <!-- Guest User -->
                            <a href="{{ route('login') }}" class="btn btn-success-custom btn-custom">
                                <i class="fas fa-key me-2"></i>
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-light-custom btn-custom">
                                <i class="fas fa-user-plus me-2"></i>
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="container main-content">
            <div class="content-card">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Error Message -->
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Custom Scripts -->
        <script>
            // Auto-hide alerts after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);
            });

            // Confirm delete
            function confirmDelete() {
                return confirm('Are you sure you want to delete this blog?');
            }

            // Add smooth animations to buttons
            document.querySelectorAll('.btn').forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        </script>
    </body>
</html>