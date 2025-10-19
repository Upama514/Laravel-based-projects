@extends('layouts.app')

@section('title', 'About')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">About Todo App</h4>
            </div>
            <div class="card-body">
                <p>This is a simple Todo application built with Laravel.</p>
                <p>Features:</p>
                <ul>
                    <li>Create, read, update, and delete tasks</li>
                    <li>Mark tasks as complete/incomplete</li>
                    <li>Responsive design</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection