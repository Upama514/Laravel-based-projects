@extends('layouts.app')

@section('content')
<h2>Add New Book</h2>
<form action="{{ route('books.store') }}" method="POST">
    @csrf
    <div>
        <label>Title:</label><br>
        <input type="text" name="title" value="{{ old('title') }}" required>
    </div>
    <div>
        <label>Author:</label><br>
        <input type="text" name="author" value="{{ old('author') }}">
    </div>
    <div>
        <label>Description:</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>
    <button type="submit">Add Book</button>
</form>
@endsection
