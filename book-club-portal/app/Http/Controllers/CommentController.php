<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Get comments for a book
    public function index(Book $book)
    {
        $comments = $book->comments()->with('user:id,name')->latest()->get();
        return response()->json($comments, 200);
    }

    // Add comment to a book (Admin can comment on any book, users only on their own)
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // Check if user can comment on this book
        $user = Auth::user();
        if ($user->role !== 'admin' && $book->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $comment = Comment::create([
            'content' => $request->content,
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);

        // Load user relationship for response
        $comment->load('user:id,name');

        return response()->json([
            'message' => 'Comment added successfully.',
            'comment' => $comment
        ], 201);
    }

    // Delete comment
    public function destroy(Comment $comment)
    {
        $user = Auth::user();
        
        // Admin can delete any comment, users can only delete their own
        if ($user->role !== 'admin' && $comment->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully.'], 200);
    }
}