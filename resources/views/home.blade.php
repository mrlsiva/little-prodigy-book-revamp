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

                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <div class="card category-card h-100 shadow">
                                <img src="{{ $category->image_url }}" class="card-img-top" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($category->description, 80) }}</p>
                                    <a href="{{ route('category.products', $category->id) }}" class="btn btn-primary">Browse Books</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                @foreach($category->products->take(8) as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                        <div class="card product-card h-100 shadow-sm">
                                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                                            <div class="card-body p-3">
                                                <h6 class="card-title">{{ Str::limit($product->name, 30) }}</h6>
                                                @if($product->author)
                                                    <small class="text-muted">by {{ $product->author }}</small>
                                                @endif
                                                @if($product->price)
                                                    <div class="text-primary fw-bold">${{ $product->price }}</div>
                                                @endif
                                                <a href="{{ route('product.detail', $product->id) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if($category->products->count() == 0)
                                    <div class="col-12">
                                        <div class="text-center text-muted py-4">
                                            <i class="fas fa-book fa-3x mb-3"></i>
                                            <p>No books available in this category yet.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
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
            category.products.forEach(function(product) {
                const productName = product.name.length > 30 ? product.name.substring(0, 30) + '...' : product.name;
                const authorInfo = product.author ? `<small class="text-muted">by ${product.author}</small>` : '';
                const priceInfo = product.price ? `<div class="text-primary fw-bold">$${product.price}</div>` : '';
                
                productsHtml += `
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card product-card h-100 shadow-sm">
                            <img src="${product.image_url || '/images/no-image.jpg'}" class="card-img-top" alt="${product.name}" style="height: 180px; object-fit: cover;">
                            <div class="card-body p-3">
                                <h6 class="card-title">${productName}</h6>
                                ${authorInfo}
                                ${priceInfo}
                                <a href="/product/${product.id}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                `;
            });
        } else {
            productsHtml = `
                <div class="col-12">
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-book fa-3x mb-3"></i>
                        <p>No books available in this category yet.</p>
                    </div>
                </div>
            `;
        }

        const ageCategory = category.age_category ? `<small class="text-muted">(${category.age_category})</small>` : '';
        const description = category.description ? (category.description.length > 80 ? category.description.substring(0, 80) + '...' : category.description) : '';

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
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card category-card h-100 shadow">
                            <img src="${category.image_url || '/images/no-image.jpg'}" class="card-img-top" alt="${category.name}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">${category.name}</h5>
                                <p class="card-text text-muted">${description}</p>
                                <a href="/category/${category.id}" class="btn btn-primary">Browse Books</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            ${productsHtml}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
});
</script>
@endsection