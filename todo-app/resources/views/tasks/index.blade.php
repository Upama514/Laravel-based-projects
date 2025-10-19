@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<!-- Header Section -->
<div class="header-card">
    <div class="p-4 p-md-5">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3">My Tasks</h1>
                <p class="lead mb-0 opacity-90">Stay organized and boost your productivity</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('tasks.create') }}" class="btn btn-light btn-lg px-4">
                    <i class="fas fa-plus-circle me-2"></i>Add New Task
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Tasks Section -->
<div class="p-4 p-md-5">
    @if($tasks->count() > 0)
        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-purple mb-0">
                        <i class="fas fa-list-check me-2"></i>
                        Total Tasks: <strong>{{ $tasks->count() }}</strong>
                    </h5>
                    <div class="d-flex gap-3">
                        <span class="stats-badge">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ $tasks->where('is_completed', true)->count() }} Completed
                        </span>
                        <span class="stats-badge">
                            <i class="fas fa-clock me-1"></i>
                            {{ $tasks->where('is_completed', false)->count() }} Pending
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks List -->
        <div class="row">
            <div class="col-12">
                @foreach($tasks as $task)
                    <div class="task-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center flex-grow-1">
                            <!-- Complete Button -->
                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="me-4">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="complete-btn {{ $task->is_completed ? 'completed' : '' }}"
                                        title="{{ $task->is_completed ? 'Mark as incomplete' : 'Mark as complete' }}">
                                    @if($task->is_completed)
                                        <i class="fas fa-check text-white" style="font-size: 12px;"></i>
                                    @endif
                                </button>
                            </form>
                            
                            <!-- Task Details -->
                            <div class="flex-grow-1">
                                <div class="task-title {{ $task->is_completed ? 'task-completed' : '' }}">
                                    {{ $task->title }}
                                </div>
                                @if($task->description)
                                    <div class="task-meta mb-2">
                                        <i class="fas fa-align-left me-1 text-purple"></i>
                                        {{ Str::limit($task->description, 100) }}
                                    </div>
                                @endif
                                <div class="task-meta">
                                    <i class="far fa-calendar me-1 text-purple"></i>
                                    Created: {{ $task->created_at->format('M j, Y • g:i A') }}
                                    @if($task->is_completed)
                                        • <i class="fas fa-check-circle text-purple ms-2"></i> Completed
                                    @else
                                        • <i class="fas fa-hourglass-half text-purple ms-2"></i> Pending
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <!-- Edit Button -->
                            <a href="{{ route('tasks.edit', $task->id) }}" 
                               class="btn btn-outline-primary action-btn"
                               title="Edit Task">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <!-- Delete Button -->
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger action-btn"
                                        onclick="return confirm('Are you sure you want to delete this task?')"
                                        title="Delete Task">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center empty-state">
            <i class="fas fa-clipboard-list"></i>
            <h2 class="text-purple mb-3">No tasks yet</h2>
            <p class="text-muted mb-4 lead">Start organizing your life by creating your first task</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-plus me-2"></i>Create Your First Task
            </a>
        </div>
    @endif
</div>
@endsection