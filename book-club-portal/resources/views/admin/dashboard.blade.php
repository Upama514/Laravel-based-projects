@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">All Users & Their Books</h2>
        
        @foreach($users as $user)
            <div class="user-section mb-6 p-4 border rounded">
                <h3 class="font-semibold text-lg">
                    {{ $user->name }} 
                    <span class="text-sm text-gray-600">({{ $user->email }})</span>
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded ml-2">
                        Role: {{ $user->role }}
                    </span>
                </h3>
                
                @if($user->books->count() > 0)
                    <h4 class="font-medium mt-3 mb-2">Books ({{ $user->books->count() }}):</h4>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($user->books as $book)
                            <li class="text-gray-700 mb-4">
                                <strong>{{ $book->title }}</strong> 
                                @if($book->author)
                                    by {{ $book->author }}
                                @endif
                                <p class="text-gray-600 text-sm">{{ $book->description }}</p>

                                <!-- Comment form -->
                                <form action="{{ route('comments.store', $book->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <textarea name="content" class="w-full border rounded p-2 text-sm" placeholder="Write a comment..." required></textarea>
                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded mt-1">Add Comment</button>
                                </form>

                                <!-- Show existing comments -->
                                @if($book->comments->count() > 0)
                                    <ul class="mt-2 border-t pt-2 text-sm text-gray-700">
                                        @foreach($book->comments as $comment)
                                            <li>
                                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}
                                                <span class="text-xs text-gray-500">({{ $comment->created_at->diffForHumans() }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 mt-2">No books added yet.</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
