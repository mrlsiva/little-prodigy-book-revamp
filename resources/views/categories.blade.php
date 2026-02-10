@extends('layouts.app')

@section('title', 'Categories - Little Prodigy Books')

@section('content')
<!-- Page Header -->
<div class="theme-bg-primary py-5 mb-5">
    <div class="container">
        <div class="row justify-content-center text-center text-white">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold">Book Categories</h1>
                <p class="lead">Explore our diverse collection of educational books organized by categories</p>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="container mb-5">
    <!-- View Toggle Controls -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">All Categories</h2>
            <p class="text-muted mb-0">{{ count($categories) }} categories available</p>
        </div>
        <div class="btn-group" role="group" aria-label="View toggle">
            <button type="button" class="btn theme-btn-outline active" id="cardViewBtn">
                <i class="fas fa-th-large me-2"></i>Card View
            </button>
            <button type="button" class="btn theme-btn-outline" id="listViewBtn">
                <i class="fas fa-list me-2"></i>List View
            </button>
        </div>
    </div>

    @if($categories->count() > 0)
        <!-- Card View -->
        <div id="cardView" class="category-view">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card category-card h-100 shadow-sm">
                            <img src="{{ $category->image_url }}" 
                                 class="card-img-top" 
                                 alt="{{ $category->name }}" 
                                 style="height: 220px; object-fit: cover;"
                                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZjhmOWZhIiBzdHJva2U9IiNlMmU4ZjAiIHN0cm9rZS13aWR0aD0iMiIvPjx0ZXh0IHg9IjUwJSIgeT0iNDAlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTYiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj7wn4OFPC90ZXh0Pjx0ZXh0IHg9IjUwJSIgeT0iNjUlIiBmb250LWZhbWlseT0iQXJpYWwsIHNhbnMtc2VyaWYiIGZvbnQtc2l6ZT0iMTIiIGZpbGw9IiM5Y2ExYjIiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5DYXRlZ29yeTwvdGV4dD48L3N2Zz4='; this.onerror=null;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                @if($category->age_category)
                                    <p class="text-primary small mb-2">
                                        <i class="fas fa-baby me-1"></i>{{ $category->age_category }}
                                    </p>
                                @endif
                                @if($category->description)
                                    <p class="card-text text-muted flex-grow-1">{{ Str::limit($category->description, 100) }}</p>
                                @endif
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge theme-badge">{{ $category->products_count }} {{ Str::plural('Book', $category->products_count) }}</span>
                                    </div>
                                    <a href="{{ route('category.products', $category->id) }}" class="btn theme-btn-outline w-100">
                                        <i class="fas fa-book-open me-2"></i>Browse Books
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- List View -->
        <div id="listView" class="category-view" style="display: none;">
            <div class="list-group">
                @foreach($categories as $category)
                    <div class="list-group-item list-group-item-action">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="{{ $category->image_url }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $category->name }}" 
                                     style="height: 80px; width: 80px; object-fit: cover;"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iI2Y4ZjlmYSIgc3Ryb2tlPSIjZTJlOGYwIiBzdHJva2Utd2lkdGg9IjIiLz48dGV4dCB4PSI1MCUiIHk9IjUwJSIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE0IiBmaWxsPSIjOWNhMWIyIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBkeT0iLjNlbSI+8J+DhTwvdGV4dD48L3N2Zz4='; this.onerror=null;">
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $category->name }}</h5>
                                    <small class="text-muted">{{ $category->products_count }} {{ Str::plural('book', $category->products_count) }}</small>
                                </div>
                                @if($category->age_category)
                                    <p class="text-primary small mb-1">
                                        <i class="fas fa-baby me-1"></i>{{ $category->age_category }}
                                    </p>
                                @endif
                                @if($category->description)
                                    <p class="mb-1 text-muted">{{ Str::limit($category->description, 150) }}</p>
                                @endif
                            </div>
                            <div class="col-md-2 text-end">
                                <a href="{{ route('category.products', $category->id) }}" class="btn theme-btn-outline">
                                    Browse <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <i class="fas fa-folder-open fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">No Categories Available</h3>
            <p class="text-muted">Categories with books will appear here once they are added.</p>
            <a href="{{ route('home') }}" class="btn theme-btn-primary">
                <i class="fas fa-home me-2"></i>Back to Home
            </a>
        </div>
    @endif
</div>

<!-- Featured Categories Section (if there are many) -->
@if(count($categories) > 6)
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="fw-bold">Popular Categories</h3>
                <p class="text-muted">Our most loved book categories</p>
            </div>
            <div class="row">
                @foreach($categories->take(3) as $category)
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 bg-white h-100 shadow-sm">
                            <div class="card-body text-center">
                                <img src="{{ $category->image_url }}" 
                                     class="rounded-circle mb-3" 
                                     alt="{{ $category->name }}" 
                                     style="height: 100px; width: 100px; object-fit: cover;">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="text-muted">{{ $category->products_count }} books</p>
                                <a href="{{ route('category.products', $category->id) }}" class="btn btn-sm theme-btn-outline">
                                    Explore
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // View toggle functionality
    $('#cardViewBtn, #listViewBtn').click(function() {
        const isCardView = $(this).attr('id') === 'cardViewBtn';
        
        // Update active states
        $('#cardViewBtn, #listViewBtn').removeClass('active');
        $(this).addClass('active');
        
        // Toggle views
        if (isCardView) {
            $('#listView').hide();
            $('#cardView').fadeIn();
        } else {
            $('#cardView').hide();
            $('#listView').fadeIn();
        }
        
        // Store preference in localStorage
        localStorage.setItem('categoryViewPreference', isCardView ? 'card' : 'list');
    });
    
    // Load user preference
    const savedView = localStorage.getItem('categoryViewPreference') || 'card';
    if (savedView === 'list') {
        $('#listViewBtn').click();
    }
    
    // Smooth hover effects for cards
    $('.category-card').hover(
        function() {
            $(this).css('transform', 'translateY(-5px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
});
</script>
@endsection

@section('styles')
<style>
/* Custom Red Theme */
.theme-bg-primary {
    background-color: #e43750;
}

.theme-btn-primary {
    background-color: #e43750;
    border-color: #e43750;
    color: white;
}

.theme-btn-primary:hover {
    background-color: #d32f44;
    border-color: #d32f44;
    color: white;
}

.theme-btn-outline {
    color: #e43750;
    border-color: #e43750;
    background-color: transparent;
}

.theme-btn-outline:hover {
    background-color: #e43750;
    border-color: #e43750;
    color: white;
}

.theme-btn-outline.active {
    background-color: #e43750;
    border-color: #e43750;
    color: white;
}

.theme-badge {
    background-color: #e43750;
    color: white;
}

.category-view {
    transition: all 0.3s ease;
}

.category-card {
    transition: all 0.3s ease;
    border: none;
}

.category-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.list-group-item {
    border: 1px solid #e9ecef;
    margin-bottom: 10px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    border-color: #e43750;
}

.btn-group .btn {
    border-radius: 25px;
}

.btn-group .btn:first-child {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.btn-group .btn:last-child {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}
</style>
@endsection