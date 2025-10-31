<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'content' => $request->content,
            'book_id' => $book->id,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
