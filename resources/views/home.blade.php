@extends('layouts.app')

@section('title', 'Little Prodigy Books - Nurturing Young Minds')

@section('content')
<!-- Hero Carousel -->
@if($banners->count() > 0)
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    @if($banners->count() > 1)
        <div class="carousel-indicators">
            @foreach($banners as $index => $banner)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" 
                        @if($index === 0) class="active" aria-current="true" @endif 
                        aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif
    
    <div class="carousel-inner">
        @foreach($banners as $index => $banner)
            <div class="carousel-item @if($index === 0) active @endif">
                <img src="{{ $banner->image_url }}" class="d-block w-100" alt="{{ $banner->title }}" style="height: 500px; object-fit: cover;">
                <div class="banner-background-overlay"></div>
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 d-none d-md-flex banner-overlay">
                    <div class="text-center mx-auto" style="max-width: 800px;">
                        <p class="fw-bold text-white mb-3" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">{{ $banner->title }}</p>
                        @if($banner->subtitle)
                            <p class="text-white mb-4" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); font-weight: 400;">{{ $banner->subtitle }}</p>
                        @endif
                        @if($banner->button_text && $banner->button_url)
                            <a href="{{ $banner->button_url }}" class="btn btn-primary btn-lg px-4 py-2">{{ $banner->button_text }}</a>
                        @endif
                    </div>
                </div>
                <!-- Mobile version -->
                <div class="carousel-caption d-block d-md-none" style="background: rgba(0,0,0,0.6); padding: 20px; border-radius: 10px;">
                    <p class="fw-bold text-white mb-2" style="font-size: 1.5rem;">{{ $banner->title }}</p>
                    @if($banner->subtitle)
                        <p class="text-white mb-3" style="font-size: 1.5rem; font-weight: 400;">{{ $banner->subtitle }}</p>
                    @endif
                    @if($banner->button_text && $banner->button_url)
                        <a href="{{ $banner->button_url }}" class="btn btn-primary">{{ $banner->button_text }}</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    
    @if($banners->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>
@else
<!-- Default fallback when no banners exist -->
<div class="bg-primary position-relative d-flex align-items-center justify-content-center" style="height: 500px;">
    <div class="container text-center text-white">
        <div style="max-width: 800px; margin: 0 auto; padding: 40px;">
            <p class="fw-bold mb-3" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Welcome to Little Prodigy Books</p>
            <p class="mb-4" style="font-size: 2rem; font-weight: 400; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Discover amazing books that spark imagination and learning</p>
            <a href="#categories" class="btn btn-light btn-lg px-4 py-2">Explore Books</a>
        </div>
    </div>
</div>
@endif

<!-- Categories Section -->
<section id="categories" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary">Book Categories</h2>
            <p class="lead text-muted">Explore our diverse collection of educational books</p>
        </div>

        <div id="categoriesContainer">
            @foreach($categories as $category)
                @if($category->products->count() > 0)
                    <div class="category-section mb-5" data-category-id="{{ $category->id }}">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-primary">
                                {{ $category->name }}
                                @if($category->age_category)
                                    <small class="text-muted">({{ $category->age_category }})</small>
                                @endif
                            </h3>
                            <a href="{{ route('category.products', $category->id) }}" class="btn btn-outline-primary">
                                View All <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div id="productCarousel{{ $category->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $chunks = $category->products->chunk(4);
                                @endphp
                                @foreach($chunks as $chunkIndex => $chunk)
                                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                        <div class="row">
                                            @foreach($chunk as $product)
                                                <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                                                    <!-- Skeleton Loader -->
                                                    <div class="card skeleton-card h-100 shadow-sm skeleton-loader" style="display: none;">
                                                        <div class="skeleton-image"></div>
                                                        <div class="card-body p-3">
                                                            <div class="skeleton-text skeleton-text-lg"></div>
                                                            <div class="skeleton-text skeleton-text-sm" style="width: 70%;"></div>
                                                            <div class="skeleton-text skeleton-text-sm" style="width: 40%;"></div>
                                                            <div class="skeleton-button mt-2"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Actual Card -->
                                                    <div class="card product-card h-100 shadow-sm product-card-content">
                                                        <img src="{{ $product->image_url }}" class="card-img-top product-image" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;" data-product-id="{{ $product->id }}" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn5SCPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjUlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Cb29rIEltYWdlPC90ZXh0Pjwvc3ZnPg=='; this.onerror=null;">
                                                        <div class="card-body p-3">
                                                            <h6 class="card-title">{{ Str::limit($product->name, 35) }}</h6>
                                                            @if($product->author)
                                                                <small class="text-muted d-block mb-2">by {{ $product->author }}</small>
                                                            @endif
                                                            @if($product->price)
                                                                <div class="text-primary fw-bold mb-2">Rs {{ $product->price }}</div>
                                                            @endif
                                                            <a href="{{ route('product.detail', $product->id) }}" class="btn btn-sm btn-outline-primary w-100">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($chunks->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel{{ $category->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel{{ $category->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-5">
            <button id="loadMoreBtn" class="btn btn-primary btn-lg" data-skip="{{ count($categories) }}">
                <span class="loading-spinner spinner-border spinner-border-sm me-2" role="status"></span>
                Load More Categories
            </button>
        </div>
    </div>
</section>

@if($categories->isEmpty())
    <section class="py-5">
        <div class="container text-center">
            <div class="py-5">
                <i class="fas fa-book fa-4x text-muted mb-4"></i>
                <h3 class="text-muted">No Categories Available</h3>
                <p class="text-muted">Check back soon for amazing book collections!</p>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Panel</a>
            </div>
        </div>
    </section>
@endif
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let loading = false;

    // Initialize skeleton loaders
    initializeSkeletonLoaders();

    function initializeSkeletonLoaders() {
        // Show skeleton loaders initially
        $('.skeleton-loader').show();
        $('.product-card-content, .stats-content').hide();
        
        // Handle image loading
        $('.product-image').each(function() {
            const img = this;
            const $cardContainer = $(img).closest('.col-lg-3, .col-md-6, .col-sm-6');
            const $skeletonLoader = $cardContainer.find('.skeleton-loader');
            const $productContent = $cardContainer.find('.product-card-content');
            
            if (img.complete) {
                // Image already loaded
                $skeletonLoader.fadeOut(300, function() {
                    $productContent.fadeIn(300);
                });
            } else {
                // Listen for image load
                $(img).on('load', function() {
                    setTimeout(() => {
                        $skeletonLoader.fadeOut(300, function() {
                            $productContent.fadeIn(300);
                        });
                    }, 500); // Minimum skeleton display time
                });
                
                // Handle image error
                $(img).on('error', function() {
                    setTimeout(() => {
                        $skeletonLoader.fadeOut(300, function() {
                            $productContent.fadeIn(300);
                        });
                    }, 500);
                });
            }
        });
        
        // Show stats content after a brief delay to simulate loading
        setTimeout(() => {
            $('.stats-skeleton').fadeOut(300, function() {
                $('.stats-content').fadeIn(300);
            });
        }, 800);
    }

    $('#loadMoreBtn').click(function() {
        if (loading) return;

        loading = true;
        const btn = $(this);
        const skip = btn.data('skip');

        // Show loading spinner
        btn.find('.loading-spinner').show();
        btn.prop('disabled', true);

        $.ajax({
            url: '{{ route("load.more.categories") }}',
            method: 'GET',
            data: { skip: skip },
            success: function(response) {
                if (response.categories.length > 0) {
                    response.categories.forEach(function(category) {
                        const categoryHtml = createCategoryHtml(category);
                        $('#categoriesContainer').append(categoryHtml);
                        
                        // Initialize skeleton loaders for new content
                        initializeSkeletonLoadersForNew(category.id);
                    });

                    // Update skip count
                    btn.data('skip', skip + response.categories.length);

                    // Hide button if no more categories
                    if (!response.hasMore) {
                        btn.hide();
                    }
                } else {
                    btn.hide();
                }
            },
            error: function() {
                alert('Error loading more categories. Please try again.');
            },
            complete: function() {
                btn.find('.loading-spinner').hide();
                btn.prop('disabled', false);
                loading = false;
            }
        });
    });

    function initializeSkeletonLoadersForNew(categoryId) {
        $(`[data-category-id="${categoryId}"] .product-image`).each(function() {
            const img = this;
            const $cardContainer = $(img).closest('.col-lg-3, .col-md-6, .col-sm-6');
            const $skeletonLoader = $cardContainer.find('.skeleton-loader');
            const $productContent = $cardContainer.find('.product-card-content');
            
            // Set default placeholder for error cases
            const defaultPlaceholder = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhfOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj48aSBjbGFzcz0iZmFzIGZhLWJvb2siPjwvaT48L3RleHQ+PHRleHQgeD0iNTAlIiB5PSI2NSUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxMiIgZmlsbD0iIzljYTFiMiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPkJvb2sgSW1hZ2U8L3RleHQ+PC9zdmc+';
            
            $skeletonLoader.show();
            $productContent.hide();
            
            $(img).on('load', function() {
                setTimeout(() => {
                    $skeletonLoader.fadeOut(300, function() {
                        $productContent.fadeIn(300);
                    });
                }, 300);
            });
            
            $(img).on('error', function() {
                // Set placeholder image for error state
                img.src = defaultPlaceholder;
                
                // Keep skeleton visible longer for error state
                setTimeout(() => {
                    $skeletonLoader.fadeOut(300, function() {
                        $productContent.fadeIn(300);
                    });
                }, 600);
            });
        });
    }

    function createCategoryHtml(category) {
        let productsHtml = '';
        
        if (category.products && category.products.length > 0) {
            // Create product chunks for carousel
            const productChunks = [];
            for (let i = 0; i < category.products.length; i += 4) {
                productChunks.push(category.products.slice(i, i + 4));
            }

            productChunks.forEach(function(chunk, chunkIndex) {
                const activeClass = chunkIndex === 0 ? 'active' : '';
                let chunkHtml = `<div class="carousel-item ${activeClass}"><div class="row">`;
                
                chunk.forEach(function(product) {
                    const productName = product.name.length > 35 ? product.name.substring(0, 35) + '...' : product.name;
                    const authorInfo = product.author ? `<small class="text-muted d-block mb-2">by ${product.author}</small>` : '';
                    const priceInfo = product.price ? `<div class="text-primary fw-bold mb-2">Rs ${product.price}</div>` : '';
                    
                    chunkHtml += `
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <!-- Skeleton Loader -->
                            <div class="card skeleton-card h-100 shadow-sm skeleton-loader">
                                <div class="skeleton-image"></div>
                                <div class="card-body p-3">
                                    <div class="skeleton-text skeleton-text-lg"></div>
                                    <div class="skeleton-text skeleton-text-sm" style="width: 70%;"></div>
                                    <div class="skeleton-text skeleton-text-sm" style="width: 40%;"></div>
                                    <div class="skeleton-button mt-2"></div>
                                </div>
                            </div>
                            
                            <!-- Actual Card -->
                            <div class="card product-card h-100 shadow-sm product-card-content" style="display: none;">
                                <img src="${product.image_url || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn5OCPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjUlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Cb29rIEltYWdlPC90ZXh0Pjwvc3ZnPg=='}" class="card-img-top product-image" alt="${product.name}" style="height: 220px; object-fit: cover;" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn5OCPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjUlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Cb29rIEltYWdlPC90ZXh0Pjwvc3ZnPg=='; this.onerror=null;">
                                <div class="card-body p-3">
                                    <h6 class="card-title">${productName}</h6>
                                    ${authorInfo}
                                    ${priceInfo}
                                    <a href="/product/${product.id}" class="btn btn-sm btn-outline-primary w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                chunkHtml += '</div></div>';
                productsHtml += chunkHtml;
            });

            // Create carousel controls if more than one slide
            let carouselControls = '';
            if (productChunks.length > 1) {
                carouselControls = `
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel${category.id}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel${category.id}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                `;
            }

            productsHtml = `
                <div id="productCarousel${category.id}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        ${productsHtml}
                    </div>
                    ${carouselControls}
                </div>
            `;
        } else {
            productsHtml = `
                <div class="text-center text-muted py-5">
                    <i class="fas fa-book fa-3x mb-3"></i>
                    <p>No books available in this category yet.</p>
                </div>
            `;
        }

        const ageCategory = category.age_category ? `<small class="text-muted">(${category.age_category})</small>` : '';

        return `
            <div class="category-section mb-5" data-category-id="${category.id}">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary">
                        ${category.name}
                        ${ageCategory}
                    </h3>
                    <a href="/category/${category.id}" class="btn btn-outline-primary">
                        View All <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                ${productsHtml}
            </div>
        `;
    }
});

// Initialize carousel
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap carousel
    const carouselElement = document.querySelector('#heroCarousel');
    if (carouselElement) {
        const carousel = new bootstrap.Carousel(carouselElement, {
            interval: 5000,
            ride: 'carousel'
        });
        
        // Optional: Pause carousel on hover
        carouselElement.addEventListener('mouseenter', function() {
            carousel.pause();
        });
        
        carouselElement.addEventListener('mouseleave', function() {
            carousel.cycle();
        });
    }
});
</script>
@endsection

@section('styles')
<style>
/* Banner Styling */
.carousel-item {
    position: relative;
    min-height: 500px;
}

/* Background overlay for better text readability */
.banner-background-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.4);
    z-index: 1;
}

/* Ensure carousel caption is above overlay but below controls */
.carousel-caption.banner-overlay {
    z-index: 2;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 15px;
    right: 15px;
    padding: 40px 20px;
}

/* Ensure carousel controls are above everything */
.carousel-control-prev,
.carousel-control-next {
    z-index: 15;
}

.carousel-indicators {
    z-index: 15;
}

/* Equal font size for title and subtitle */
.carousel-caption p {
    margin-bottom: 1rem;
    line-height: 1.3;
    font-size: 2rem !important;
}

/* Mobile responsive */
@media (max-width: 767px) {
    .carousel-caption p {
        font-size: 1.5rem !important;
    }
}

/* Button styling */
.carousel-caption .btn {
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    border: 2px solid transparent;
    z-index: 3;
    position: relative;
}

.carousel-caption .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.4);
}
</style>
@endsection