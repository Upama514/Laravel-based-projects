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
                            <li class="text-gray-700">
                                <strong>{{ $book->title }}</strong> 
                                @if($book->author)
                                    by {{ $book->author }}
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