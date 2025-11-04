<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
    {
        $user = Auth::user();

        // Check admin role
        if (!$user || $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }

        // Get all users with their books
        $users = User::with(['books' => function($query) {
            $query->latest();
        }])->get();

        // Get stats
        $stats = [
            'total_users' => User::count(),
            'total_books' => Book::count(),
            'total_comments' => Comment::count(),
        ];

        return response()->json([
            'message' => 'Admin dashboard data retrieved successfully.',
            'stats' => $stats,
            'users' => $users
        ], 200);
    }

    // Get all users
    public function getUsers()
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }

        $users = User::with('books')->get();
        return response()->json($users, 200);
    }

    // Get all books
    public function getAllBooks()
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }

        $books = Book::with('user:id,name,email')->latest()->get();
        return response()->json($books, 200);
    }

    // Admin can delete any book
    public function deleteBook(Book $book)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully.'], 200);
    }
}