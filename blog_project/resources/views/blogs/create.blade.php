<!-- resources/views/blogs/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h1 class="mb-4">Create New Blog</h1>

    <!-- Validation error dekhabo jodi thake -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Blog create form -->
    <form action="{{ route('blogs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Blog Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter blog title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Blog Content</label>
            <textarea name="content" class="form-control" rows="5" placeholder="Write something..." required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Blog</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back</a>
    </form>

</body>
</html>
