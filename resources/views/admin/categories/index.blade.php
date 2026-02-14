@extends('layouts.admin')

@section('title', 'Categories - Admin Panel')
@section('page-title', 'Categories')

@section('content')
<!-- Header Section -->
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
    <div>
        <h2 class="mb-1">Manage Categories</h2>
        <p class="text-muted mb-0">Total: {{ $categories->total() }} categories</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.bulk.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-upload me-1"></i> Bulk Upload
        </a>
        <a href="{{ route('admin.bulk.export.categories') }}" class="btn btn-outline-success">
            <i class="fas fa-download me-1"></i> Export All
        </a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Category
        </a>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search by name, description, or age category..."
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="per_page" class="form-select" onchange="this.form.submit()">
                    <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 per page</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-grid d-md-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Categories Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-folder me-2"></i>All Categories</h5>
        @if(request('search'))
            <small class="text-muted">
                {{ $categories->total() }} results for "{{ request('search') }}"
            </small>
        @endif
    </div>
    <div class="card-body p-0">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th>Age Category</th>
                            <th style="width: 100px;">Products</th>
                            <th style="width: 90px;">Status</th>
                            <th style="width: 110px;">Created</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" 
                                         class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $category->name }}</strong>
                                        @if($category->description)
                                            <br><small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($category->age_category)
                                        <span class="badge bg-info">{{ $category->age_category }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $category->products_count ?? 0 }}</span>
                                </td>
                                <td>
                                    @if($category->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $category->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete"
                                                onclick="confirmDelete({{ $category->id }}, '{{ addslashes($category->name) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Form (hidden) -->
                                    <form id="delete-form-{{ $category->id }}" 
                                          action="{{ route('admin.categories.destroy', $category) }}" 
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                @if(request('search'))
                    <i class="fas fa-search fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">No Results Found</h4>
                    <p class="text-muted">No categories found matching your search criteria.</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-times me-1"></i> Clear Search
                    </a>
                @else
                    <i class="fas fa-folder fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">No Categories Found</h4>
                    <p class="text-muted">Start by creating your first category.</p>
                @endif
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Create {{ request('search') ? 'First' : '' }} Category
                </a>
            </div>
        @endif
    </div>
    
    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div class="small text-muted">
                Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} categories
            </div>
            <div>
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function confirmDelete(categoryId, categoryName) {
    if (confirm(`Are you sure you want to delete "${categoryName}"? This action cannot be undone and will also delete all products in this category.`)) {
        document.getElementById('delete-form-' + categoryId).submit();
    }
}
</script>
@endsection