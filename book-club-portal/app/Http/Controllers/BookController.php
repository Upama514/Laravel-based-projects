<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Get user's books
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->with('user:id,name')->get();
        return response()->json($books, 200);
    }

    // Create new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book = Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Book created successfully.', 
            'book' => $book
        ], 201);
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        // Check ownership
        if ($book->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book->update($request->only('title', 'author', 'description'));

        return response()->json([
            'message' => 'Book updated successfully.', 
            'book' => $book
        ], 200);
    }

    // Delete book
    public function destroy(Book $book)
    {
        // Check ownership
        if ($book->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully.'], 200);
    }

    // Get single book
    public function show(Book $book)
    {
        // Check ownership
        if ($book->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }
        
        return response()->json($book, 200);
    }
}