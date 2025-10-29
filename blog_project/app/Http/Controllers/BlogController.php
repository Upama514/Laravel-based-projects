<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * ✅ Constructor: Ensure only logged-in users can access Blog pages
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * ✅ 1️⃣ Show all blogs of the logged-in user
     */
    public function index()
    {
        // Only the authenticated user's blogs show korbo
        // latest() = order by created_at DESC
        $blogs = Auth::user()->blogs()->latest()->get();

        // 'blogs.index' view ke blogs data pathacchi
        return view('blogs.index', compact('blogs'));
    }

    /**
     * ✅ 2️⃣ Show form to create a new blog post
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * ✅ 3️⃣ Store a new blog in the database
     */
    public function store(Request $request)
    {
        // Validation: title & content must be provided
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        // Authenticated user er sathe relationship diye create korchi
        Auth::user()->blogs()->create([
            'title'   => $request->title,
            'content' => $request->content
        ]);

        // Redirect kore success message show korbo
        return redirect()
            ->route('blogs.index')
            ->with('success', '✅ Blog created successfully!');
    }

    /**
     * ✅ 4️⃣ Show edit form for a specific blog
     */
    public function edit(Blog $blog)
    {
        // Check: ei blog ta current user er kina
        if (Auth::id() != $blog->user_id) {
            abort(403, 'Unauthorized action.'); // unauthorized hole 403 error
        }

        // Blog edit view e data pathacchi
        return view('blogs.edit', compact('blog'));
    }

    /**
     * ✅ 5️⃣ Update a specific blog
     */
    public function update(Request $request, Blog $blog)
    {
        // Unauthorized access check
        if (Auth::id() != $blog->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Validation
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        // Update the blog record
        $blog->update([
            'title'   => $request->title,
            'content' => $request->content
        ]);

        // Redirect with success message
        return redirect()
            ->route('blogs.index')
            ->with('success', '✅ Blog updated successfully!');
    }

    /**
     * ✅ 6️⃣ Delete a specific blog
     */
    public function destroy(Blog $blog)
    {
        // Unauthorized access check
        if (Auth::id() != $blog->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete blog
        $blog->delete();

        // Redirect with success message
        return redirect()
            ->route('blogs.index')
            ->with('success', '🗑️ Blog deleted successfully!');
    }
}
