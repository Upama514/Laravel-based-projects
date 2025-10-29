@extends('layouts.app')

@section('content')
<h2>Edit Book</h2>
<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Title:</label><br>
        <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
    </div>
    <div>
        <label>Author:</label><br>
        <input type="text" name="author" value="{{ old('author', $book->author) }}">
    </div>
    <div>
        <label>Description:</label><br>
        <textarea name="description">{{ old('description', $book->description) }}</textarea>
    </div>
    <button type="submit">Update Book</button>
</form>
@endsection
