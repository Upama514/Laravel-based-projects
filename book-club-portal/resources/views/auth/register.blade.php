@extends('layouts.app')

@section('content')
<h2>Register</h2>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </div>
    <div>
        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Register</button>
</form>
@endsection
