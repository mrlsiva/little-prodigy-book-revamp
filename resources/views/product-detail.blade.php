@extends('layouts.app')

@section('title', $product->name . ' - Little Prodigy Books')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.products', $product->category->id) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-5">
            <!-- Product Image -->
            <div class="card shadow">
                <!-- Skeleton Loader for Product Detail Image -->
                <div class="skeleton-loader" style="display: none;">
                    <div class="skeleton-image" style="height: 500px;"></div>
                </div>
                
                <!-- Actual Image -->
                <img src="{{ $product->image_url }}" class="card-img-top product-detail-image" alt="{{ $product->name }}" style="height: 500px; object-fit: cover;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjUwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMyIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMjQiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn5OCPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Qcm9kdWN0IEltYWdlPC90ZXh0Pjwvc3ZnPg=='; this.onerror=null;">
            </div>
        </div>

        <div class="col-lg-7">
            <!-- Product Details -->
            <div class="ps-lg-4">
                <h1 class="mb-3">{{ $product->name }}</h1>
                
                @if($product->author)
                    <p class="lead text-muted">by {{ $product->author }}</p>
                @endif

                @if($product->price)
                    <h3 class="text-primary mb-3">${{ $product->price }}</h3>
                @endif

                @if($product->description)
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>
                @endif

                <!-- Product Specifications -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Product Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($product->age)
                                <div class="col-md-6 mb-2">
                                    <strong>Age:</strong> {{ $product->age }}
                                </div>
                            @endif
                            
                            @if($product->series)
                                <div class="col-md-6 mb-2">
                                    <strong>Series:</strong> {{ $product->series }}
                                </div>
                            @endif
                            
                            @if($product->pages)
                                <div class="col-md-6 mb-2">
                                    <strong>No. of Pages:</strong> {{ $product->pages }}
                                </div>
                            @endif
                            
                            @if($product->publisher)
                                <div class="col-md-6 mb-2">
                                    <strong>Publisher:</strong> {{ $product->publisher }}
                                </div>
                            @endif
                            
                            @if($product->language)
                                <div class="col-md-6 mb-2">
                                    <strong>Language:</strong> {{ $product->language }}
                                </div>
                            @endif
                            
                            @if($product->copyright)
                                <div class="col-md-6 mb-2">
                                    <strong>Copyright:</strong> {{ $product->copyright }}
                                </div>
                            @endif
                            
                            @if($product->graphics)
                                <div class="col-md-6 mb-2">
                                    <strong>Graphics:</strong> {{ $product->graphics }}
                                </div>
                            @endif
                            
                            @if($product->sku)
                                <div class="col-md-6 mb-2">
                                    <strong>SKU:</strong> {{ $product->sku }}
                                </div>
                            @endif
                            
                            <div class="col-md-6 mb-2">
                                <strong>Stock:</strong> 
                                @if($product->stock > 0)
                                    <span class="text-success">{{ $product->stock }} available</span>
                                @else
                                    <span class="text-danger">Out of Stock</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($product->additional_info)
                    <div class="mb-4">
                        <h5>Additional Information</h5>
                        <p class="text-muted">{{ $product->additional_info }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h3 class="mb-4">Related Books</h3>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card product-card h-100 shadow-sm">
                            <img src="{{ $relatedProduct->image_url }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h6 class="card-title">{{ Str::limit($relatedProduct->name, 40) }}</h6>
                                @if($relatedProduct->author)
                                    <small class="text-muted">by {{ $relatedProduct->author }}</small>
                                @endif
                                @if($relatedProduct->price)
                                    <div class="text-primary fw-bold mt-2">${{ $relatedProduct->price }}</div>
                                @endif
                                <a href="{{ route('product.detail', $relatedProduct->id) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize skeleton loader for product detail image
    initializeProductDetailSkeleton();
    
    function initializeProductDetailSkeleton() {
        const $productImage = $('.product-detail-image');
        const $skeletonLoader = $('.skeleton-loader');
        
        // Show skeleton initially
        $skeletonLoader.show();
        $productImage.hide();
        
        // Set default placeholder for error cases
        const defaultPlaceholder = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjUwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMyIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMjQiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn5SCPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Qcm9kdWN0IEltYWdlPC90ZXh0Pjwvc3ZnPg==';
        
        if ($productImage[0].complete) {
            // Image already loaded successfully
            if ($productImage[0].naturalWidth > 0) {
                setTimeout(() => {
                    $skeletonLoader.fadeOut(300, function() {
                        $productImage.fadeIn(300);
                    });
                }, 300);
            } else {
                // Image failed to load initially
                $productImage[0].src = defaultPlaceholder;
                setTimeout(() => {
                    $skeletonLoader.fadeOut(300, function() {
                        $productImage.fadeIn(300);
                    });
                }, 600);
            }
        } else {
            // Listen for image load
            $productImage.on('load', function() {
                setTimeout(() => {
                    $skeletonLoader.fadeOut(300, function() {
                        $productImage.fadeIn(300);
                    });
                }, 500); // Minimum skeleton display time
            });
            
            // Handle image error with placeholder
            $productImage.on('error', function() {
                // Set placeholder image
                this.src = defaultPlaceholder;
                
                // Keep skeleton visible longer for error state
                setTimeout(() => {
                    $skeletonLoader.fadeOut(300, function() {
                        $productImage.fadeIn(300);
                    });
                }, 800); // Longer delay for error state
            });
        }
    }
});
</script>
@endsection