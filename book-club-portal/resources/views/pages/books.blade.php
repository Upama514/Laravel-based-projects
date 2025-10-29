@extends('layouts.app')

@section('content')
<h2>My Books</h2>
<a href="{{ route('books.create') }}">Add New Book</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    @foreach($books as $book)
    <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->description }}</td>
        <td>
            <a href="{{ route('books.edit', $book->id) }}">Edit</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
