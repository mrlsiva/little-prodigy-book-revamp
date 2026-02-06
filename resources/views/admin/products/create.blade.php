@extends('layouts.admin')

@section('title', 'Add Product - Admin Panel')
@section('page-title', 'Add New Product')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Create New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Basic Information</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" 
                                        name="category_id" 
                                        required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', request('category')) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Product description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="additional_info" class="form-label">Additional Information</label>
                            <textarea class="form-control @error('additional_info') is-invalid @enderror" 
                                      id="additional_info" 
                                      name="additional_info" 
                                      rows="3" 
                                      placeholder="Additional product information...">{{ old('additional_info') }}</textarea>
                            @error('additional_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Product Details</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" 
                                       class="form-control @error('age') is-invalid @enderror" 
                                       id="age" 
                                       name="age" 
                                       value="{{ old('age') }}" 
                                       placeholder="e.g., 3-5 years">
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="series" class="form-label">Series</label>
                                <input type="text" 
                                       class="form-control @error('series') is-invalid @enderror" 
                                       id="series" 
                                       name="series" 
                                       value="{{ old('series') }}" 
                                       placeholder="Book series name">
                                @error('series')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="pages" class="form-label">No. of Pages</label>
                                <input type="number" 
                                       class="form-control @error('pages') is-invalid @enderror" 
                                       id="pages" 
                                       name="pages" 
                                       value="{{ old('pages') }}" 
                                       min="1">
                                @error('pages')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="publisher" class="form-label">Publisher</label>
                                <input type="text" 
                                       class="form-control @error('publisher') is-invalid @enderror" 
                                       id="publisher" 
                                       name="publisher" 
                                       value="{{ old('publisher') }}" 
                                       placeholder="Publisher name">
                                @error('publisher')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" 
                                       class="form-control @error('author') is-invalid @enderror" 
                                       id="author" 
                                       name="author" 
                                       value="{{ old('author') }}" 
                                       placeholder="Author name">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="language" class="form-label">Language</label>
                                <input type="text" 
                                       class="form-control @error('language') is-invalid @enderror" 
                                       id="language" 
                                       name="language" 
                                       value="{{ old('language') }}" 
                                       placeholder="e.g., English">
                                @error('language')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="copyright" class="form-label">Copyright</label>
                                <input type="text" 
                                       class="form-control @error('copyright') is-invalid @enderror" 
                                       id="copyright" 
                                       name="copyright" 
                                       value="{{ old('copyright') }}" 
                                       placeholder="e.g., 2024">
                                @error('copyright')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="graphics" class="form-label">Graphics</label>
                                <input type="text" 
                                       class="form-control @error('graphics') is-invalid @enderror" 
                                       id="graphics" 
                                       name="graphics" 
                                       value="{{ old('graphics') }}" 
                                       placeholder="e.g., Illustrated, Black & White">
                                @error('graphics')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Inventory & Pricing -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Inventory & Pricing</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('stock') is-invalid @enderror" 
                                       id="stock" 
                                       name="stock" 
                                       value="{{ old('stock', 0) }}" 
                                       min="0" 
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" 
                                       class="form-control @error('sku') is-invalid @enderror" 
                                       id="sku" 
                                       name="sku" 
                                       value="{{ old('sku') }}" 
                                       placeholder="Product SKU">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price') }}" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0.00">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Product Image -->
                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2">Product Image</h6>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Upload a product image (JPEG, PNG, JPG, GIF - Max 2MB)</div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <img id="previewImage" src="#" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
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
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible on website)
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Products
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Product
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
document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
@endsection