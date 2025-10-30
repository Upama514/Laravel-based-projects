<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Auth::user()->books; // শুধু current user এর books দেখাবে
        return view('pages.books', compact('books'));
    }

    public function create()
    {
        return view('pages.book_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
        ]);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function edit(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
        return view('pages.book_edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book->update($request->only('title','author','description'));

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}
