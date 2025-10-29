<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
    {
        // সব users এবং তাদের books load করা
        $users = User::with('books')->get();

        // View return করা
        return view('admin.dashboard', compact('users'));
    }
}
