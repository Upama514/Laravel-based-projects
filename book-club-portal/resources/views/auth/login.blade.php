@extends('layouts.app')

@section('content')
<h2>Login</h2>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div>
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Login</button>
</form>
@endsection
