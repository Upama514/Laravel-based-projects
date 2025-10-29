@extends('layouts.app')

@section('title', 'Add New Task')

@section('content')
<!-- Form Header -->
<div class="form-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="form-title">Add New Task</h1>
                <p class="lead mb-0 opacity-90">Create a new task to stay organized and productive</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('tasks.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Back to Tasks
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Form Body -->
<div class="form-body">
    <div class="container-fluid">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf 
            
            <!-- Task Title -->
            <div class="mb-4">
                <label for="title" class="form-label">
                    <i class="fas fa-heading me-2"></i>Task Title *
                </label>
                <input type="text" 
                       class="form-control form-control-lg @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}" 
                       placeholder="What needs to be done?" 
                       required
                       autofocus>
                @error('title')
                    <div class="invalid-feedback fs-6">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <div class="form-text text-muted mt-2">
                    Give your task a clear and descriptive title
                </div>
            </div>
            
            <!-- Task Description -->
            <div class="mb-4">
                <label for="description" class="form-label">
                    <i class="fas fa-align-left me-2"></i>Description
                </label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          name="description" 
                          rows="5" 
                          placeholder="Add more details about your task (optional)">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback fs-6">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <div class="form-text text-muted mt-2">
                    Add any additional details, notes, or context for this task
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-save me-2"></i>Save Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection