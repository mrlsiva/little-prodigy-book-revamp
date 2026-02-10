@extends('layouts.admin')

@section('title', 'Banner Details - Admin Panel')
@section('page-title', 'Banner Details')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Banner Details</h5>
                <div>
                    <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit me-2"></i>Edit Banner
                    </a>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Banner Image -->
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2">Banner Image</h6>
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" 
                         class="img-fluid rounded shadow" style="max-height: 300px; width: 100%; object-fit: cover;">
                </div>

                <!-- Banner Details -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <h6 class="text-primary border-bottom pb-2">Banner Information</h6>
                        <div class="mb-2">
                            <strong>Title:</strong> {{ $banner->title }}
                        </div>
                        @if($banner->subtitle)
                            <div class="mb-2">
                                <strong>Subtitle:</strong> {{ $banner->subtitle }}
                            </div>
                        @endif
                        <div class="mb-2">
                            <strong>Sort Order:</strong> {{ $banner->sort_order }}
                        </div>
                        <div class="mb-2">
                            <strong>Status:</strong> 
                            @if($banner->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <h6 class="text-primary border-bottom pb-2">Call to Action</h6>
                        @if($banner->button_text)
                            <div class="mb-2">
                                <strong>Button Text:</strong> {{ $banner->button_text }}
                            </div>
                        @else
                            <div class="mb-2">
                                <strong>Button Text:</strong> <span class="text-muted">Not set</span>
                            </div>
                        @endif

                        @if($banner->button_url)
                            <div class="mb-2">
                                <strong>Button URL:</strong> 
                                <a href="{{ $banner->button_url }}" target="_blank" class="text-decoration-none">
                                    {{ $banner->button_url }} <i class="fas fa-external-link-alt fa-xs"></i>
                                </a>
                            </div>
                        @else
                            <div class="mb-2">
                                <strong>Button URL:</strong> <span class="text-muted">Not set</span>
                            </div>
                        @endif

                        @if($banner->button_text && $banner->button_url)
                            <div class="mb-2">
                                <strong>Preview Button:</strong><br>
                                <a href="{{ $banner->button_url }}" class="btn btn-primary btn-sm" target="_blank">
                                    {{ $banner->button_text }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Metadata -->
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2">Metadata</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Created:</strong> {{ $banner->created_at->format('M d, Y h:i A') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Last Updated:</strong> {{ $banner->updated_at->format('M d, Y h:i A') }}
                        </div>
                    </div>
                </div>

                <!-- Banner Preview -->
                <div class="mb-4">
                    <h6 class="text-primary border-bottom pb-2">Live Preview</h6>
                    <p class="text-muted mb-3">This is how the banner appears on the home page:</p>
                    
                    <div class="position-relative" style="height: 400px; overflow: hidden; border-radius: 10px;">
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" 
                             class="w-100 h-100" style="object-fit: cover;">
                        <div class="position-absolute d-flex flex-column justify-content-center align-items-center h-100 w-100" 
                             style="background: rgba(0,0,0,0.4); padding: 40px;">
                            <div class="text-center" style="max-width: 600px;">
                                <p class="text-white fw-bold mb-3" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">{{ $banner->title }}</p>
                                @if($banner->subtitle)
                                    <p class="text-white mb-4" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); font-weight: 400;">{{ $banner->subtitle }}</p>
                                @endif
                                @if($banner->button_text && $banner->button_url)
                                    <a href="{{ $banner->button_url }}" class="btn btn-primary btn-lg px-4 py-2">{{ $banner->button_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection