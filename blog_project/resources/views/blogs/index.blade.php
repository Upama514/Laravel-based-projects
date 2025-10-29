@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">All Blog Posts</h1>
                <p class="page-subtitle">Manage your blog posts efficiently</p>
            </div>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary-custom btn-custom">
                <i class="fas fa-plus-circle me-2"></i>
                Create New Blog
            </a>
        </div>
    </div>
</div>

@if($blogs->count() > 0)
<div class="row">
    @foreach($blogs as $blog)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="blog-item h-100">
            <div class="blog-title">{{ $blog->title }}</div>
            <div class="blog-content">
                {{ Str::limit($blog->content, 150) }}
            </div>
            <div class="blog-actions d-flex gap-2 flex-wrap">
                <a href="{{ route('blogs.show', $blog->id) }}" 
                   class="btn btn-view btn-sm"
                   data-bs-toggle="tooltip" 
                   title="View Blog">
                    <i class="fas fa-eye me-1"></i>View
                </a>
                <a href="{{ route('blogs.edit', $blog->id) }}" 
                   class="btn btn-edit btn-sm"
                   data-bs-toggle="tooltip" 
                   title="Edit Blog">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn btn-delete btn-sm"
                            onclick="return confirm('Are you sure you want to delete this blog post?')"
                            data-bs-toggle="tooltip" 
                            title="Delete Blog">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                </form>
            </div>
            <div class="blog-meta mt-2 text-muted small">
                <i class="fas fa-calendar me-1"></i>
                {{ $blog->created_at->format('M j, Y') }}
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-5">
    <div class="py-4">
        <i class="fas fa-file-alt fa-4x text-muted mb-4" style="color: #6a89cc !important;"></i>
        <h3 class="text-muted mb-3" style="color: #4a69bd !important;">No Blog Posts Yet</h3>
        <p class="text-muted mb-4">Start sharing your thoughts with the world</p>
        <a href="{{ route('blogs.create') }}" class="btn btn-primary-custom btn-custom">
            <i class="fas fa-plus-circle me-2"></i>
            Create Your First Blog
        </a>
    </div>
</div>
@endif

{{-- Only show pagination if using paginate() in controller --}}
{{-- 
@if(method_exists($blogs, 'hasPages') && $blogs->hasPages())
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    </div>
</div>
@endif
--}}

<style>
    .blog-item {
        background: #f8fbff;
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 4px solid #6a89cc;
        transition: all 0.3s ease;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .blog-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        background: #f0f7ff;
    }
    .blog-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        line-height: 1.4;
    }
    .blog-content {
        color: #555;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
        font-size: 1rem;
    }
    .blog-actions {
        margin-top: auto;
    }
    .blog-actions .btn {
        margin: 0 2px;
        padding: 0.5rem 0.8rem;
        font-size: 0.85rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-view {
        background: #3498db;
        color: white;
    }
    .btn-edit {
        background: #2ecc71;
        color: white;
    }
    .btn-delete {
        background: #e74c3c;
        color: white;
    }
    .btn-view:hover, .btn-edit:hover, .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        opacity: 0.9;
    }
    .blog-meta {
        border-top: 1px solid #e6f2ff;
        padding-top: 0.5rem;
        margin-top: 0.5rem;
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endsection