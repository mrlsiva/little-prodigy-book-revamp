@extends('layouts.admin')

@section('title', $category->name . ' - Admin Panel')
@section('page-title', 'Category Details')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-folder me-2"></i>{{ $category->name }}</h5>
                <div>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        @if($category->image)
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" 
                                 class="img-fluid rounded shadow">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $category->name }}</td>
                            </tr>
                            @if($category->age_category)
                                <tr>
                                    <td><strong>Age Category:</strong></td>
                                    <td><span class="badge bg-info">{{ $category->age_category }}</span></td>
                                </tr>
                            @endif
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($category->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Total Products:</strong></td>
                                <td><span class="badge bg-primary">{{ $category->products_count ?? 0 }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $category->created_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Last Updated:</strong></td>
                                <td>{{ $category->updated_at->format('F d, Y \a\t g:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($category->description)
                    <div class="mt-4">
                        <h6>Description:</h6>
                        <p class="text-muted">{{ $category->description }}</p>
                    </div>
                @endif

                <div class="mt-4 pt-4 border-top d-flex justify-content-between">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Categories
                    </a>
                    <div>
                        <a href="{{ route('category.products', $category->id) }}" class="btn btn-info me-2" target="_blank">
                            <i class="fas fa-external-link-alt me-2"></i>View on Website
                        </a>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Category
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products in this category -->
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-book me-2"></i>Products in this Category</h5>
                <a href="{{ route('admin.products.create') }}?category={{ $category->id }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus me-2"></i>Add Product
                </a>
            </div>
            <div class="card-body">
                @if($category->products && $category->products->count() > 0)
                    <div class="row">
                        @foreach($category->products->take(6) as $product)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}" 
                                         style="height: 150px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title">{{ Str::limit($product->name, 40) }}</h6>
                                        @if($product->price)
                                            <p class="text-primary fw-bold">Rs {{ $product->price }}</p>
                                        @endif
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-info flex-fill">View</a>
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary flex-fill">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($category->products->count() > 6)
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.products.index') }}?category={{ $category->id }}" class="btn btn-outline-primary">
                                View All {{ $category->products->count() }} Products
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-book fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Products in this Category</h5>
                        <p class="text-muted">Start by adding some products to this category.</p>
                        <a href="{{ route('admin.products.create') }}?category={{ $category->id }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Add First Product
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection