@extends('layouts.app')

@section('title', $category->name . ' - Little Prodigy Books')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="row mb-5">
        <div class="col-md-4">
            <img src="{{ $category->image_url }}" class="img-fluid rounded shadow" alt="{{ $category->name }}">
        </div>
        <div class="col-md-8">
            <div class="ps-md-4">
                <h1 class="display-5 text-primary">{{ $category->name }}</h1>
                @if($category->age_category)
                    <p class="lead text-muted">{{ $category->age_category }}</p>
                @endif
                @if($category->description)
                    <p class="text-muted">{{ $category->description }}</p>
                @endif
                <div class="mt-3">
                    <span class="badge bg-primary fs-6">{{ $category->products->count() }} Books Available</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    @if($category->products->count() > 0)
        <div class="row">
            @foreach($category->products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                    <!-- Skeleton Loader -->
                    <div class="card skeleton-card h-100 shadow-sm skeleton-loader" style="display: none;">
                        <div class="skeleton-image" style="height: 250px;"></div>
                        <div class="card-body p-3">
                            <div class="skeleton-text skeleton-text-lg"></div>
                            <div class="skeleton-text skeleton-text-sm" style="width: 70%;"></div>
                            <div class="skeleton-text" style="width: 90%;"></div>
                            <div class="skeleton-text" style="width: 60%;"></div>
                            <div class="skeleton-text skeleton-text-sm" style="width: 40%;"></div>
                            <div class="d-flex gap-2 mt-3">
                                <div class="skeleton-button" style="width: 50%;"></div>
                                <div class="skeleton-button" style="width: 50%;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actual Card -->
                    <div class="card product-card h-100 shadow-sm product-card-content">
                        <div class="position-relative">
                            <img src="{{ $product->image_url }}" class="card-img-top product-image" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;" data-product-id="{{ $product->id }}" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjI1MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn5OCPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjUlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Cb29rIEltYWdlPC90ZXh0Pjwvc3ZnPg=='; this.onerror=null;">
                            @if($product->stock <= 0)
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-danger">Out of Stock</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            
                            @if($product->author)
                                <p class="text-muted mb-2">by {{ $product->author }}</p>
                            @endif
                            
                            @if($product->description)
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                            @endif
                            
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    @if($product->price)
                                        <span class="h5 text-primary mb-0">${{ $product->price }}</span>
                                    @endif
                                    
                                    @if($product->stock > 0)
                                        <small class="text-success">{{ $product->stock }} in stock</small>
                                    @endif
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-outline-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Additional Information Cards -->
        <div class="row mt-5">
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center">
                        <i class="fas fa-graduation-cap text-primary fa-3x mb-3"></i>
                        <h5 class="card-title">Educational Value</h5>
                        <p class="card-text">All books are carefully selected for their educational content and age-appropriate material.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-success">
                    <div class="card-body text-center">
                        <i class="fas fa-award text-success fa-3x mb-3"></i>
                        <h5 class="card-title">Quality Assured</h5>
                        <p class="card-text">High-quality printing and binding ensure these books will last through countless readings.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card h-100 border-info">
                    <div class="card-body text-center">
                        <i class="fas fa-shipping-fast text-info fa-3x mb-3"></i>
                        <h5 class="card-title">Fast Shipping</h5>
                        <p class="card-text">Quick and secure delivery to bring these amazing books to your little prodigy.</p>
                    </div>
                </div>
            </div>
        </div>
        
    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <i class="fas fa-book-open text-muted" style="font-size: 4rem;"></i>
            <h3 class="mt-4 text-muted">No Books Available</h3>
            <p class="text-muted">This category doesn't have any books yet. Check back soon for amazing additions!</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Browse Other Categories</a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize skeleton loaders for category products
    initializeSkeletonLoaders();
    
    function initializeSkeletonLoaders() {
        // Show skeleton loaders initially
        $('.skeleton-loader').show();
        $('.product-card-content').hide();
        
        // Handle image loading for product cards
        $('.product-image').each(function() {
            const img = this;
            const $cardContainer = $(img).closest('.col-xl-3, .col-lg-4, .col-md-6, .col-sm-6');
            const $skeletonLoader = $cardContainer.find('.skeleton-loader');
            const $productContent = $cardContainer.find('.product-card-content');
            
            // Set default placeholder for error cases
            const defaultPlaceholder = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjI1MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTgiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn5OCPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjUlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Cb29rIEltYWdlPC90ZXh0Pjwvc3ZnPg==';
            
            if (img.complete) {
                // Image already loaded successfully
                if (img.naturalWidth > 0) {
                    setTimeout(() => {
                        $skeletonLoader.fadeOut(300, function() {
                            $productContent.fadeIn(300);
                        });
                    }, 300);
                } else {
                    // Image failed to load initially
                    img.src = defaultPlaceholder;
                    setTimeout(() => {
                        $skeletonLoader.fadeOut(300, function() {
                            $productContent.fadeIn(300);
                        });
                    }, 600);
                }
            } else {
                // Listen for image load
                $(img).on('load', function() {
                    setTimeout(() => {
                        $skeletonLoader.fadeOut(300, function() {
                            $productContent.fadeIn(300);
                        });
                    }, 500); // Minimum skeleton display time
                });
                
                // Handle image error with placeholder
                $(img).on('error', function() {
                    // Set placeholder image
                    img.src = defaultPlaceholder;
                    
                    // Keep skeleton visible longer for error state
                    setTimeout(() => {
                        $skeletonLoader.fadeOut(300, function() {
                            $productContent.fadeIn(300);
                        });
                    }, 800); // Longer delay for error state
                });
            }
        });
    }
});
</script>
@endsection