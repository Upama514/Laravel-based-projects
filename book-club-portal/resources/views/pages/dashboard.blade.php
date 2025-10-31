@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    @if(Auth::user()->role === 'admin')
        <h2 class="text-xl font-semibold mb-4">All Users and Books</h2>
        <table border="1" cellpadding="10" class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
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
                                <div>
                                    <strong>{{ $book->title }}</strong> - {{ $book->author ?? 'N/A' }}
                                    <p class="text-gray-600 text-sm">{{ $book->description }}</p>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h2 class="text-xl font-semibold mb-4">My Books</h2>
        @if(Auth::user()->books->count() > 0)
            <ul class="list-disc list-inside space-y-4">
                @foreach(Auth::user()->books as $book)
                    <li>
                        <strong>{{ $book->title }}</strong> - {{ $book->author ?? 'N/A' }}
                        <p class="text-gray-600">{{ $book->description }}</p>

                        <!-- Show comments -->
                        @if($book->comments->count() > 0)
                            <h4 class="mt-2 font-medium text-gray-800">Comments:</h4>
                            <ul class="ml-4 list-disc text-gray-700 text-sm">
                                @foreach($book->comments as $comment)
                                    <li>
                                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                                        <span class="text-xs text-gray-500">({{ $comment->created_at->diffForHumans() }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 text-sm">No comments yet.</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">You haven’t added any books yet.</p>
        @endif
    @endif
</div>
@endsection
