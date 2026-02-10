<!-- Skeleton Card Component -->
<!-- Usage: @include('components.skeleton-card', ['type' => 'product', 'height' => '220px']) -->
<!-- 
     Features:
     - Animated skeleton placeholder during image loading
     - Error handling with fallback placeholder images
     - Configurable for different card types and dimensions
     - Theme-consistent design with smooth transitions
-->

@php
    $type = $type ?? 'product';
    $height = $height ?? '220px';
    $showPrice = $showPrice ?? true;
    $showAuthor = $showAuthor ?? true;
    $showButtons = $showButtons ?? true;
@endphp

<div class="card skeleton-card h-100 shadow-sm skeleton-loader" style="display: none;">
    <!-- Image Skeleton -->
    <div class="skeleton-image" style="height: {{ $height }};"></div>
    
    <!-- Body Skeleton -->
    <div class="card-body p-3">
        @if($type == 'product')
            <!-- Product Card Skeleton -->
            <div class="skeleton-text skeleton-text-lg"></div>
            
            @if($showAuthor)
                <div class="skeleton-text skeleton-text-sm" style="width: 70%;"></div>
            @endif
            
            @if($showPrice)
                <div class="skeleton-text skeleton-text-sm" style="width: 40%;"></div>
            @endif
            
            @if($showButtons)
                <div class="skeleton-button mt-2"></div>
            @endif
            
        @elseif($type == 'category')
            <!-- Category Card Skeleton -->
            <div class="skeleton-text skeleton-text-lg"></div>
            <div class="skeleton-text" style="width: 90%;"></div>
            <div class="skeleton-text" style="width: 60%;"></div>
            <div class="skeleton-button mt-3"></div>
            
        @elseif($type == 'detailed-product')
            <!-- Detailed Product Card Skeleton -->
            <div class="skeleton-text skeleton-text-lg"></div>
            <div class="skeleton-text skeleton-text-sm" style="width: 70%;"></div>
            <div class="skeleton-text" style="width: 90%;"></div>
            <div class="skeleton-text" style="width: 60%;"></div>
            <div class="skeleton-text skeleton-text-sm" style="width: 40%;"></div>
            <div class="d-flex gap-2 mt-3">
                <div class="skeleton-button" style="width: 50%;"></div>
                <div class="skeleton-button" style="width: 50%;"></div>
            </div>
            
        @else
            <!-- Default Card Skeleton -->
            <div class="skeleton-text skeleton-text-lg"></div>
            <div class="skeleton-text" style="width: 80%;"></div>
            <div class="skeleton-text" style="width: 60%;"></div>
            <div class="skeleton-button mt-2"></div>
        @endif
    </div>
</div>