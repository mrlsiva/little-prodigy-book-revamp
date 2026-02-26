@extends('layouts.app')

@section('title', 'Little Prodigy Books')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

@section('content')
<!-- Hero Section / Banner Slider -->
@if($banners->count() > 0)
<section class="hero-section position-relative">
    @if($banners->count() > 1)
    <!-- Multiple banners - show as carousel -->
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach($banners as $index => $banner)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" 
                    class="{{ $index === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <!-- Carousel Inner -->
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $banner->image_url }}" class="hero-image w-100" alt="{{ $banner->title }}">
                <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                    <div class="hero-content text-center text-white">
                        <p class="hero-subtitle h4 mb-4">{{ $banner->title }}</p>
                        @if($banner->subtitle)
                        <p class="hero-subtitle h4 mb-4">{{ $banner->subtitle }}</p>
                        @endif
                        @if($banner->button_text && $banner->button_url)
                        <a href="{{ $banner->button_url }}" class="btn btn-primary btn-lg px-5 py-3">{{ $banner->button_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @else
    <!-- Single banner -->
    @php $banner = $banners->first(); @endphp
    <img src="{{ $banner->image_url }}" class="hero-image w-100" alt="{{ $banner->title }}">
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
        <div class="hero-content text-center text-white">
            <p class="hero-subtitle h4 mb-4">{{ $banner->title }}</p>
            @if($banner->subtitle)
            <p class="hero-subtitle h4 mb-4">{{ $banner->subtitle }}</p>
            @endif
            @if($banner->button_text && $banner->button_url)
            <a href="{{ $banner->button_url }}" class="btn btn-primary btn-lg px-5 py-3">{{ $banner->button_text }}</a>
            @endif
        </div>
    </div>
    @endif

</section>
@else
<!-- Fallback hero section when no banners exist -->
<section class="hero-section position-relative">
    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1200&h=600&fit=crop&crop=center" class="hero-image w-100" alt="Children reading books">
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
        <!-- <div class="hero-content text-center text-white">
            <p class="hero-subtitle h4 mb-0">A Place Set Aside For Books And Their Friends</p>
            <p class="hero-subtitle h4 mb-0">Enchanting Selections Of Wonderful Books</p>
        </div> -->
    </div>
    <!-- Floating Action Buttons -->
    <div class="floating-buttons position-absolute">
        <a href="{{ asset('catalouge/Our-Library-Catalogue.pdf') }}" target="_blank" class="floating-btn catalogue-btn d-flex align-items-center">
            <i class="fas fa-book me-2"></i>
            <span>Catalogue</span>
        </a>
        <a href="https://wa.me/919876543210" target="_blank" class="floating-btn whatsapp-btn">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
</section>
@endif

<!-- Book Series Sections -->
<section id="book-series" class="py-5 bg-light">
    <div class="container-fluid px-lg-5">
        
        @if($categories->count() > 0)
            @foreach($categories as $index => $category)
            <!-- {{ $category->name }} Series -->
            <div class="series-section mb-5 pt-3">
                <div class="d-flex justify-content-between align-items-center mb-2 px-3">
                    <h3 class="series-title">
                        {{ $category->name }}
                    </h3>
                    <a href="{{ route('category.products', $category->id) }}" class="view-more-link text-dark fw-bold text-decoration-none">
                        View More <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                @if($category->products->count() > 0)
                <div class="position-relative">
                    @if($category->products->count() > 5)
                    <!-- Slick Slider for categories with more than 5 products -->
                    <div class="product-slider slick-slider" id="slider{{ $index }}">
                        @foreach($category->products as $product)
                        <div class="book-card-wrapper">
                            <div class="book-card text-center mx-1">
                                <div class="book-cover-container position-relative">
                                    @if($product->image)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="book-cover img-fluid rounded">
                                    @else
                                        <div class="book-cover fallback-image d-flex align-items-center justify-content-center">
                                            {{ $product->name }}
                                        </div>
                                    @endif
                                </div>
                                <h6 class="book-title mt-3 mb-3 fw-bold">{{ Str::limit($product->name, 30) }}</h6>
                                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-danger btn-sm px-4 view-details-btn">View Details</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <!-- Simple row for categories with 5 or fewer products -->
                    <div class="row px-3">
                        @foreach($category->products as $product)
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                            <div class="book-card text-center">
                                <div class="book-cover-container position-relative">
                                    @if($product->image)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="book-cover img-fluid rounded">
                                    @else
                                        <div class="book-cover fallback-image d-flex align-items-center justify-content-center">
                                            {{ $product->name }}
                                        </div>
                                    @endif
                                </div>
                                <h6 class="book-title mt-3 mb-3 fw-bold">{{ Str::limit($product->name, 30) }}</h6>
                                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-danger btn-sm px-4 view-details-btn">View Details</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @else
                <div class="text-center py-5">
                    <p class="text-muted">No products available in this category yet.</p>
                </div>
                @endif
            </div>
            @endforeach
        @else
        <!-- No categories message -->
        <div class="text-center py-5">
            <div class="series-section">
                <h3 class="text-muted">No book categories available yet.</h3>
                <p class="text-muted">Please check back later for our amazing collection of books!</p>
            </div>
        </div>
        @endif
        
        <!-- Load More Button - Only show if there are more categories to load -->
        @php
            $totalCategories = \App\Models\Category::where('is_active', true)
                ->whereHas('products', function($query) {
                    $query->where('is_active', true);
                })->count();
        @endphp
        
        @if($totalCategories > $categories->count())
        <div class="text-center mt-5" id="loadMoreContainer">
            <button type="button" class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
                <i class="fas fa-plus-circle me-2"></i>
                <span id="loadMoreText">Load More Categories</span>
                <span id="loadMoreSpinner" class="spinner-border spinner-border-sm ms-2" role="status" style="display: none;">
                    <span class="visually-hidden">Loading...</span>
                </span>
            </button>
        </div>
        @endif
    </div>
</section>
@endsection

@section('styles')
<style>
/* Custom Slick Slider Theme Override */
.slick-slider .slick-track {
    display: flex;
    align-items: stretch;
}

.slick-slider .slick-slide {
    height: auto;
}

.slick-slider .slick-slide > div {
    height: 100%;
}

/* Override default slick theme colors */
.slick-dots li button:before {
    color: var(--primary-color);
}

.slick-dots li.slick-active button:before {
    color: var(--primary-color);
}

/* Ensure proper spacing */
.product-slider {
    padding: 10px 0;
}

/* Slick Slider Arrow Styling */
.slick-prev, .slick-next {
    width: 40px;
    height: 40px;
    z-index: 1;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    border: none;
    color: white;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.slick-prev:hover, .slick-next:hover {
    background: rgba(0, 0, 0, 0.8);
    color: white;
}

.slick-prev {
    left: -20px;
}

.slick-next {
    right: -20px;
}

.slick-prev:before, .slick-next:before {
    display: none;
}

/* Book card hover effects for slick slider */
.slick-slide .book-card {
    transition: transform 0.3s ease;
}

.slick-slide .book-card:hover {
    transform: translateY(-5px);
}

/* Load More Button Styling */
#loadMoreBtn {
    background: linear-gradient(135deg, var(--primary-color) 0%, #c02d42 100%);
    border: none;
    border-radius: 50px;
    padding: 15px 30px;
    font-weight: 600;
    font-size: 16px;
    color: white;
    box-shadow: 0 4px 15px rgba(228, 55, 80, 0.3);
    transition: all 0.3s ease;
}

#loadMoreBtn:hover:not(:disabled) {
    background: linear-gradient(135deg, #c02d42 0%, var(--primary-color) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(228, 55, 80, 0.4);
    color: white;
}

#loadMoreBtn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

#loadMoreContainer {
    margin-top: 3rem;
    margin-bottom: 2rem;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize Slick Slider for product categories
    $('.slick-slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 2,
        prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></button>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // Initialize Bootstrap carousel for hero section (if exists)
    const heroCarousel = document.querySelector('#heroCarousel');
    if (heroCarousel) {
        const carousel = new bootstrap.Carousel(heroCarousel, {
            interval: 5000,
            ride: 'carousel'
        });
        
        // Pause carousel on hover
        heroCarousel.addEventListener('mouseenter', function() {
            carousel.pause();
        });
        
        heroCarousel.addEventListener('mouseleave', function() {
            carousel.cycle();
        });
    }

    // Load More Categories functionality
    let loadedCategories = {{ $categories->count() }}; // Track how many categories are currently loaded
    
    $('#loadMoreBtn').click(function() {
        const $btn = $(this);
        const $spinner = $('#loadMoreSpinner');
        const $text = $('#loadMoreText');
        
        // Show loading state
        $btn.prop('disabled', true);
        $spinner.show();
        $text.text('Loading...');
        
        $.ajax({
            url: '{{ route("load.more.categories") }}',
            method: 'GET',
            data: {
                skip: loadedCategories
            },
            success: function(response) {
                if (response.categories && response.categories.length > 0) {
                    // Append new categories to the existing content
                    let html = '';
                    
                    response.categories.forEach(function(category, index) {
                        if (category.products && category.products.length > 0) {
                            html += generateCategoryHTML(category, loadedCategories + index);
                        }
                    });
                    
                    if (html) {
                        $('#loadMoreContainer').before(html);
                        
                        // Initialize slick slider for new categories with more than 5 products
                        response.categories.forEach(function(category, index) {
                            if (category.products && category.products.length > 5) {
                                const sliderId = '#slider' + (loadedCategories + index);
                                if ($(sliderId).length && !$(sliderId).hasClass('slick-initialized')) {
                                    $(sliderId).slick({
                                        dots: false,
                                        infinite: true,
                                        speed: 300,
                                        slidesToShow: 5,
                                        slidesToScroll: 2,
                                        prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fas fa-chevron-left"></i></button>',
                                        nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fas fa-chevron-right"></i></button>',
                                        responsive: [
                                            {
                                                breakpoint: 1024,
                                                settings: {
                                                    slidesToShow: 4,
                                                    slidesToScroll: 2
                                                }
                                            },
                                            {
                                                breakpoint: 768,
                                                settings: {
                                                    slidesToShow: 3,
                                                    slidesToScroll: 2
                                                }
                                            },
                                            {
                                                breakpoint: 576,
                                                settings: {
                                                    slidesToShow: 2,
                                                    slidesToScroll: 1
                                                }
                                            }
                                        ]
                                    });
                                }
                            }
                        });
                        
                        loadedCategories += response.categories.length;
                    }
                    
                    // Hide load more button if no more categories
                    if (!response.hasMore) {
                        $('#loadMoreContainer').fadeOut();
                    }
                } else {
                    $('#loadMoreContainer').fadeOut();
                }
            },
            error: function() {
                alert('Failed to load more categories. Please try again.');
            },
            complete: function() {
                // Reset button state
                $btn.prop('disabled', false);
                $spinner.hide();
                $text.text('Load More Categories');
            }
        });
    });
    
    // Function to generate HTML for a category section
    function generateCategoryHTML(category, index) {
        let html = '<div class="series-section mb-5 pt-3">';
        html += '<div class="d-flex justify-content-between align-items-center mb-2 px-3">';
        html += '<h3 class="series-title">' + category.name + '</h3>';
        html += '<a href="/category/' + category.id + '/products" class="view-more-link text-dark fw-bold text-decoration-none">';
        html += 'View More <i class="fas fa-chevron-right"></i></a></div>';
        
        if (category.products && category.products.length > 0) {
            html += '<div class="position-relative">';
            
            if (category.products.length > 5) {
                // Slick slider for categories with more than 5 products
                html += '<div class="product-slider slick-slider" id="slider' + index + '">';
                category.products.forEach(function(product) {
                    html += generateProductHTML(product);
                });
                html += '</div>';
            } else {
                // Regular grid for categories with 5 or fewer products
                html += '<div class="row">';
                category.products.forEach(function(product) {
                    html += '<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">';
                    html += generateProductHTML(product, false);
                    html += '</div>';
                });
                html += '</div>';
            }
            html += '</div>';
        } else {
            html += '<div class="text-center py-5"><p class="text-muted">No products available in this category yet.</p></div>';
        }
        
        html += '</div>';
        return html;
    }
    
    // Function to generate HTML for a product
    function generateProductHTML(product, isSlider = true) {
        let html = '';
        
        if (isSlider) {
            html += '<div class="book-card-wrapper">';
        }
        
        html += '<div class="book-card text-center' + (isSlider ? ' mx-1' : '') + '">';
        html += '<div class="book-cover-container position-relative">';
        
        if (product.image) {
            // Use the image_url field from API response which includes proper domain and path
            html += '<img src="' + product.image_url + '" alt="' + product.name + '" class="book-cover img-fluid rounded">';
        } else {
            html += '<div class="book-cover fallback-image d-flex align-items-center justify-content-center">' + product.name + '</div>';
        }
        
        html += '</div>';
        html += '<h6 class="book-title mt-3 mb-3 fw-bold">' + (product.name.length > 30 ? product.name.substring(0, 30) + '...' : product.name) + '</h6>';
        html += '<a href="/product/' + product.id + '" class="btn btn-danger btn-sm px-4 view-details-btn">View Details</a>';
        html += '</div>';
        
        if (isSlider) {
            html += '</div>';
        }
        
        return html;
    }
});
</script>
@endsection