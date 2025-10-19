<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
</head>
<body>
    <h1>Add Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task title">
        <button type="submit">Save</button>
    </form>
    <a href="{{ route('tasks.index') }}">Back</a>
</body>
</html>
