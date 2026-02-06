@extends('layouts.admin')

@section('title', 'Admin Dashboard - Little Prodigy Books')
@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="text-primary">{{ $totalCategories }}</h3>
                    <p class="text-muted mb-0">Total Categories</p>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-folder fa-2x text-primary"></i>
                </div>
            </div>
            <small class="text-success">
                <i class="fas fa-check"></i> {{ $activeCategories }} Active
            </small>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="text-success">{{ $totalProducts }}</h3>
                    <p class="text-muted mb-0">Total Products</p>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-book fa-2x text-success"></i>
                </div>
            </div>
            <small class="text-success">
                <i class="fas fa-check"></i> {{ $activeProducts }} Active
            </small>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="text-warning">{{ $outOfStockProducts }}</h3>
                    <p class="text-muted mb-0">Out of Stock</p>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                </div>
            </div>
            <small class="text-warning">
                <i class="fas fa-exclamation"></i> Need Restocking
            </small>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="text-info">{{ $totalProducts - $outOfStockProducts }}</h3>
                    <p class="text-muted mb-0">In Stock</p>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-boxes fa-2x text-info"></i>
                </div>
            </div>
            <small class="text-success">
                <i class="fas fa-check"></i> Available
            </small>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>Add Category
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success w-100">
                            <i class="fas fa-plus me-2"></i>Add Product
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-info w-100">
                            <i class="fas fa-list me-2"></i>Manage Categories
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-warning w-100">
                            <i class="fas fa-list me-2"></i>Manage Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Recent Products</h5>
            </div>
            <div class="card-body">
                @if($recentProducts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentProducts as $product)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ Str::limit($product->name, 30) }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $product->category->name }}</small>
                                </div>
                                <div class="text-end">
                                    @if($product->price)
                                        <div class="fw-bold text-primary">${{ $product->price }}</div>
                                    @endif
                                    <small class="text-muted">{{ $product->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-book fa-3x mb-3"></i>
                        <p>No products added yet.</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add First Product</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-folder me-2"></i>Recent Categories</h5>
            </div>
            <div class="card-body">
                @if($recentCategories->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentCategories as $category)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $category->name }}</strong>
                                    @if($category->age_category)
                                        <br>
                                        <small class="text-muted">{{ $category->age_category }}</small>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold text-info">{{ $category->products_count ?? 0 }} Books</div>
                                    <small class="text-muted">{{ $category->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-folder fa-3x mb-3"></i>
                        <p>No categories added yet.</p>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add First Category</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Welcome Message -->
@if($totalCategories == 0 && $totalProducts == 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-primary">
            <div class="card-body text-center py-5">
                <i class="fas fa-star fa-4x text-primary mb-4"></i>
                <h3 class="text-primary">Welcome to Little Prodigy Books Admin!</h3>
                <p class="lead text-muted">Get started by creating your first category and adding some books.</p>
                <div class="mt-4">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-plus me-2"></i>Create Category
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>View Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection