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
                <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}" style="height: 500px; object-fit: cover;">
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

                <!-- Action Buttons -->
                <div class="d-flex gap-3">
                    @if($product->stock > 0)
                        <button class="btn btn-primary btn-lg">Add to Cart</button>
                        <button class="btn btn-outline-primary btn-lg">Buy Now</button>
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>Out of Stock</button>
                    @endif
                    <button class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-heart"></i> Wishlist
                    </button>
                </div>
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