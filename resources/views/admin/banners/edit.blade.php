@extends('layouts.admin')

@section('title', 'Edit Banner - Admin Panel')
@section('page-title', 'Edit Banner')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Banner: {{ $banner->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Banner Content</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $banner->title) }}" 
                                       placeholder="Welcome to Little Prodigy Books"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" 
                                       name="sort_order" 
                                       value="{{ old('sort_order', $banner->sort_order) }}" 
                                       min="0"
                                       placeholder="0"
                                       required>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Lower numbers appear first in the slider</div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Banner Subtitle</label>
                            <textarea class="form-control @error('subtitle') is-invalid @enderror" 
                                      id="subtitle" 
                                      name="subtitle" 
                                      rows="3" 
                                      placeholder="Discover amazing books that spark imagination and learning">{{ old('subtitle', $banner->subtitle) }}</textarea>
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Button Information -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Call to Action Button</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="button_text" class="form-label">Button Text</label>
                                <input type="text" 
                                       class="form-control @error('button_text') is-invalid @enderror" 
                                       id="button_text" 
                                       name="button_text" 
                                       value="{{ old('button_text', $banner->button_text) }}" 
                                       placeholder="Explore Books">
                                @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="button_url" class="form-label">Button URL</label>
                                <input type="text" 
                                       class="form-control @error('button_url') is-invalid @enderror" 
                                       id="button_url" 
                                       name="button_url" 
                                       value="{{ old('button_url', $banner->button_url) }}" 
                                       placeholder="#categories">
                                @error('button_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Use # for page anchors, / for internal pages, or full URLs</div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Image & Upload -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Banner Image</h6>
                        
                        <!-- Current Image -->
                        <div class="mb-3">
                            <label class="form-label">Current Image:</label><br>
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" 
                                 class="img-thumbnail" style="max-width: 400px; height: 150px; object-fit: cover;">
                        </div>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">Replace Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Upload a new banner image to replace the current one (JPEG, PNG, JPG, GIF - Max 2MB)</div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label class="form-label">New Image Preview:</label><br>
                                <img id="previewImg" src="#" alt="Preview" class="img-thumbnail" style="max-width: 400px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Status</h6>
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible on home page)
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Banners
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
@endsection