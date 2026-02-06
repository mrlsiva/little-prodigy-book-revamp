@extends('layouts.admin')

@section('title', $product->name . ' - Admin Panel')
@section('page-title', 'Product Details')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-book me-2"></i>{{ $product->name }}</h5>
                <div>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                 class="img-fluid rounded shadow">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="height: 300px;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h6 class="text-primary border-bottom pb-2">Basic Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Category:</strong></td>
                                    <td>
                                        <a href="{{ route('admin.categories.show', $product->category) }}" class="text-decoration-none">
                                            <span class="badge bg-info">{{ $product->category->name }}</span>
                                        </a>
                                    </td>
                                </tr>
                                @if($product->author)
                                    <tr>
                                        <td><strong>Author:</strong></td>
                                        <td>{{ $product->author }}</td>
                                    </tr>
                                @endif
                                @if($product->price)
                                    <tr>
                                        <td><strong>Price:</strong></td>
                                        <td><span class="h5 text-success">${{ $product->price }}</span></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Stock:</strong></td>
                                    <td>
                                        @if($product->stock > 0)
                                            <span class="badge bg-success">{{ $product->stock }} available</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @if($product->description)
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Description</h6>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>
                @endif

                <!-- Product Details -->
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2">Product Details</h6>
                    <div class="row">
                        @if($product->age)
                            <div class="col-md-4 mb-2">
                                <strong>Age:</strong> {{ $product->age }}
                            </div>
                        @endif
                        
                        @if($product->series)
                            <div class="col-md-4 mb-2">
                                <strong>Series:</strong> {{ $product->series }}
                            </div>
                        @endif
                        
                        @if($product->pages)
                            <div class="col-md-4 mb-2">
                                <strong>No. of Pages:</strong> {{ $product->pages }}
                            </div>
                        @endif
                        
                        @if($product->publisher)
                            <div class="col-md-4 mb-2">
                                <strong>Publisher:</strong> {{ $product->publisher }}
                            </div>
                        @endif
                        
                        @if($product->language)
                            <div class="col-md-4 mb-2">
                                <strong>Language:</strong> {{ $product->language }}
                            </div>
                        @endif
                        
                        @if($product->copyright)
                            <div class="col-md-4 mb-2">
                                <strong>Copyright:</strong> {{ $product->copyright }}
                            </div>
                        @endif
                        
                        @if($product->graphics)
                            <div class="col-md-4 mb-2">
                                <strong>Graphics:</strong> {{ $product->graphics }}
                            </div>
                        @endif
                        
                        @if($product->sku)
                            <div class="col-md-4 mb-2">
                                <strong>SKU:</strong> {{ $product->sku }}
                            </div>
                        @endif
                    </div>
                </div>

                @if($product->additional_info)
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Additional Information</h6>
                        <p class="text-muted">{{ $product->additional_info }}</p>
                    </div>
                @endif

                <!-- Metadata -->
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2">Record Information</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Created:</strong> {{ $product->created_at->format('F d, Y \a\t g:i A') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Last Updated:</strong> {{ $product->updated_at->format('F d, Y \a\t g:i A') }}
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top d-flex justify-content-between">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                    </a>
                    <div>
                        @if($product->is_active)
                            <a href="{{ route('product.detail', $product->id) }}" class="btn btn-info me-2" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>View on Website
                            </a>
                        @endif
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection