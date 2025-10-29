@extends('layouts.app')

@section('content')
<h1>Dashboard</h1>

@if(Auth::user()->role === 'admin')
    <h2>All Users and Books</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Books</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->books as $book)
                            <div>{{ $book->title }} - {{ $book->author ?? 'N/A' }}</div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h2>My Books</h2>
    <ul>
        @foreach(Auth::user()->books as $book)
            <li>{{ $book->title }} - {{ $book->author ?? 'N/A' }}</li>
        @endforeach
    </ul>
@endif

@endsection
