@extends('layouts.app')

@section('title', 'Little Prodigy Books - Nurturing Young Minds')

@section('content')
<!-- Hero Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="d-block w-100" alt="Children's Books">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-4 fw-bold">Welcome to Little Prodigy Books</h1>
                <p class="lead">Discover amazing books that spark imagination and learning</p>
                <a href="#categories" class="btn btn-primary btn-lg">Explore Books</a>
            </div>
        </div>
        
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="d-block w-100" alt="Reading Children">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-4 fw-bold">Educational Excellence</h1>
                <p class="lead">Books designed to enhance learning and development</p>
                <a href="#categories" class="btn btn-primary btn-lg">Browse Categories</a>
            </div>
        </div>
        
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1519452575417-564c1401ecc0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="d-block w-100" alt="Library">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="display-4 fw-bold">Quality Content</h1>
                <p class="lead">Carefully curated books for every age and interest</p>
                <a href="#categories" class="btn btn-primary btn-lg">Get Started</a>
            </div>
        </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Categories Section -->
<section id="categories" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary">Book Categories</h2>
            <p class="lead text-muted">Explore our diverse collection of educational books</p>
        </div>

        <div id="categoriesContainer">
            @foreach($categories as $category)
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

                    @if($category->products->count() > 0)
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
                                                    <div class="card product-card h-100 shadow-sm">
                                                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}" style="height: 220px; object-fit: cover;">
                                                        <div class="card-body p-3">
                                                            <h6 class="card-title">{{ Str::limit($product->name, 35) }}</h6>
                                                            @if($product->author)
                                                                <small class="text-muted d-block mb-2">by {{ $product->author }}</small>
                                                            @endif
                                                            @if($product->price)
                                                                <div class="text-primary fw-bold mb-2">${{ $product->price }}</div>
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
                    @else
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-book fa-3x mb-3"></i>
                            <p>No books available in this category yet.</p>
                        </div>
                    @endif
                </div>
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
                    const priceInfo = product.price ? `<div class="text-primary fw-bold mb-2">$${product.price}</div>` : '';
                    
                    chunkHtml += `
                        <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                            <div class="card product-card h-100 shadow-sm">
                                <img src="${product.image_url || 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCwgc2Fucy1zZXJpZiIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPk5vIEltYWdlPC90ZXh0Pjwvc3ZnPg=='}" class="card-img-top" alt="${product.name}" style="height: 220px; object-fit: cover;">
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
</script>
@endsection