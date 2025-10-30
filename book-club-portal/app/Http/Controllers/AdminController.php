<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
    {
        // Manual role check - সরাসরি Controller-এ
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Admin access only.');
        }

        $users = User::with('books')->get();
        return view('admin.dashboard', compact('users'));
    }
}