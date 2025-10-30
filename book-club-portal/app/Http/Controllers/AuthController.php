<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Registration form view
    public function showRegister() {
        return view('auth.register');
    }

    // Register user
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Create new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login page
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // Login form view
    public function showLogin() {
        return view('auth.login');
    }

    // Authenticate user
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $role = $request->input('role', 'user'); // default user

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Role check
        if (Auth::user()->role !== $role) {
            Auth::logout();
            return back()->withErrors(['email' => 'Invalid credentials for selected role.']);
        }

        // Redirect based on role
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        } else {
            return redirect()->route('dashboard')->with('success', 'Welcome User!');
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}


    // Logout user
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'You have logged out successfully.');
    }
}
