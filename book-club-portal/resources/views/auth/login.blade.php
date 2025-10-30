@extends('layouts.app')

@section('content')
<h1>Login</h1>

<!-- Login type selection -->
<form method="GET" action="{{ route('login') }}">
    <label>
        <input type="radio" name="role" value="user" {{ request('role') !== 'admin' ? 'checked' : '' }}>
        User Login
    </label>
    <label>
        <input type="radio" name="role" value="admin" {{ request('role') === 'admin' ? 'checked' : '' }}>
        Admin Login
    </label>
    <button type="submit">Proceed</button>
</form>

<!-- Login form -->
@if(request('role') === 'admin')
    <h3>Admin Login</h3>
@else
    <h3>User Login</h3>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- hidden field to pass role -->
    <input type="hidden" name="role" value="{{ request('role') === 'admin' ? 'admin' : 'user' }}">

    <div>
        <label>Email</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Password</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>
@endsection
