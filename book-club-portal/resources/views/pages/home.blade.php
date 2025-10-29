@extends('layouts.app')

@section('content')
<h2>Welcome to Book Club Portal 📚</h2>
<p>This is a place for book lovers to share their reading experiences and favorite books.</p>

@if(Auth::check())
    <p>You are logged in as <strong>{{ Auth::user()->name }}</strong>.</p>
@else
    <p><a href="{{ route('register') }}">Join now</a> to explore our community!</p>
@endif
@endsection
