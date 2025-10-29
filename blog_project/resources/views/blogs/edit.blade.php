<!-- resources/views/blogs/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h1 class="mb-4">Edit Blog</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Blog Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Blog Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back</a>
    </form>

</body>
</html>
