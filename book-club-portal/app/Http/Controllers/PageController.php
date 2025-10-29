<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Home page
    public function home()
    {
        return view('pages.home');
    }

    // About page
    public function about()
    {
        return view('pages.about');
    }

    // Dashboard (only for logged-in users)
    public function dashboard()
    {
        if(auth()->user()->role === 'admin') {
              // Admin হলে সব users + তাদের books load করো
              $users = \App\Models\User::with('books')->get();
              return view('pages.dashboard', compact('users'));
        } else {
              // Normal user হলে শুধু নিজের books
               return view('pages.dashboard');
        }
    }
}
