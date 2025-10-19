<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - TodoMaster</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-purple: #8B5FBF;
            --light-purple: #9D71E8;
            --dark-purple: #6A4C9C;
            --very-light-purple: #F0E6FF;
            --white: #FFFFFF;
            --light-gray: #F8F9FA;
        }
        
        body {
            background: linear-gradient(135deg, var(--light-purple), var(--dark-purple));
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Bigger Navbar */
        .navbar {
            background: var(--dark-purple) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border-bottom: 4px solid var(--light-purple);
            padding: 1.2rem 0;
            min-height: 80px;
        }
        
        .navbar-brand {
            font-size: 2rem !important;
            font-weight: 800;
            color: var(--white) !important;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .navbar-brand i {
            font-size: 2.2rem;
        }
        
        .main-container {
            background: var(--white);
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(106, 76, 156, 0.25);
            margin-top: 2.5rem;
            margin-bottom: 2.5rem;
            overflow: hidden;
            border: 2px solid var(--very-light-purple);
            min-height: 600px;
        }

        /* Rest of your existing CSS remains the same */
        .task-completed {
            text-decoration: line-through;
            color: #9E9E9E !important;
        }
        
        .task-item {
            border: none;
            border-bottom: 2px solid var(--very-light-purple);
            padding: 1.5rem;
            transition: all 0.3s ease;
            background: var(--white);
        }
        
        .task-item:hover {
            background: var(--very-light-purple);
            transform: translateX(5px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(139, 95, 191, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 95, 191, 0.4);
            background: linear-gradient(135deg, var(--dark-purple), var(--primary-purple));
        }
        
        .btn-light {
            background: var(--white);
            border: 2px solid var(--primary-purple);
            color: var(--primary-purple);
            border-radius: 12px;
            font-weight: 600;
            padding: 0.8rem 2rem;
        }
        
        /* Form Page Specific Styles */
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 3rem;
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            color: var(--white);
            padding: 2.5rem;
            border-radius: 20px 20px 0 0;
        }
        
        .form-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .form-body {
            padding: 3rem;
        }
        
        .form-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-purple);
            margin-bottom: 0.8rem;
        }
        
        .form-control {
            border: 2px solid #E0E0E0;
            border-radius: 12px;
            padding: 1rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.3rem rgba(139, 95, 191, 0.1);
        }
        
        .form-control-lg {
            padding: 1.2rem;
            font-size: 1.2rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid var(--very-light-purple);
        }
    </style>
</head>
<body>
    <!-- Big Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tasks.index') }}">
                <i class="fas fa-check-double"></i>
                TodoMaster
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="main-container">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>