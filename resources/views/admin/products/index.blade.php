@extends('layouts.admin')

@section('title', 'Products - Admin Panel')
@section('page-title', 'Products')

@section('content')
<!-- Header Section -->
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
    <div>
        <h2 class="mb-1">Manage Products</h2>
        <p class="text-muted mb-0">Total: {{ $products->total() }} products</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.bulk.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-upload me-1"></i> Bulk Upload
        </a>
        <a href="{{ route('admin.bulk.export.products') }}" class="btn btn-outline-success">
            <i class="fas fa-download me-1"></i> Export All
        </a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add New Product
        </a>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search by name, author, publisher, SKU, ISBN, category..."
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
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Products Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-book me-2"></i>All Products</h5>
        @if(request('search'))
            <small class="text-muted">
                {{ $products->total() }} results for "{{ request('search') }}"
            </small>
        @endif
    </div>
    <div class="card-body p-0">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th style="width: 100px;">Price</th>
                            <th style="width: 80px;">Stock</th>
                            <th style="width: 90px;">Status</th>
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                         class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ Str::limit($product->name, 40) }}</strong>
                                        @if($product->sku)
                                            <br><small class="text-muted">SKU: {{ $product->sku }}</small>
                                        @endif
                                        @if($product->isbn)
                                            <br><small class="text-muted">ISBN: {{ $product->isbn }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $product->category->name }}</span>
                                </td>
                                <td>
                                    @if($product->author)
                                        {{ Str::limit($product->author, 20) }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->price)
                                        <strong class="text-success">Rs {{ number_format($product->price, 2) }}</strong>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->stock > 0)
                                        <span class="badge bg-success">{{ $product->stock }}</span>
                                    @else
                                        <span class="badge bg-danger">Out</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete"
                                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Form (hidden) -->
                                    <form id="delete-form-{{ $product->id }}" 
                                          action="{{ route('admin.products.destroy', $product) }}" 
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
                    <p class="text-muted">No products found matching your search criteria.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-times me-1"></i> Clear Search
                    </a>
                @else
                    <i class="fas fa-book fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">No Products Found</h4>
                    <p class="text-muted">Start by creating your first product.</p>
                @endif
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Create {{ request('search') ? 'First' : '' }} Product
                </a>
            </div>
        @endif
    </div>
    
    <!-- Pagination -->
    @if($products->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div class="small text-muted">
                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
            </div>
            <div>
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function confirmDelete(productId, productName) {
    if (confirm(`Are you sure you want to delete "${productName}"? This action cannot be undone.`)) {
        document.getElementById('delete-form-' + productId).submit();
    }
}
</script>
@endsection