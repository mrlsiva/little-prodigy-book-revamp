@extends('layouts.admin')

@section('title', 'Bulk Upload')

@section('styles')
<style>
    .upload-section {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 0.5rem;
        padding: 2rem;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }
    .upload-section:hover {
        border-color: #007bff;
        background: #f0f8ff;
    }
    .upload-icon {
        font-size: 4rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }
    .progress-container {
        display: none;
        margin-top: 1rem;
    }
    .file-info {
        background: #e9ecef;
        padding: 0.75rem;
        border-radius: 0.375rem;
        margin-top: 1rem;
        display: none;
    }
    .template-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }
    .template-link:hover {
        text-decoration: underline;
    }
    .alert-scrollable {
        max-height: 300px;
        overflow-y: auto;
        white-space: pre-wrap;
    }
    .export-section {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-top: 1rem;
    }
    .export-section h6 {
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .stats-card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Bulk Upload</h1>
</div>

<!-- Database Summary -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-light stats-card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-folder text-primary me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h4 class="mb-0 text-primary">{{ $totalCategories }}</h4>
                                <small class="text-muted">Total Categories</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-book text-success me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h4 class="mb-0 text-success">{{ $totalProducts }}</h4>
                                <small class="text-muted">Total Products</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show alert-scrollable" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show alert-scrollable" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Validation Error:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <!-- Category Bulk Upload -->
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-folder-plus me-2"></i>Bulk Category Upload</h5>
            </div>
            <div class="card-body">
                <div class="upload-section text-center">
                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                    <h6>Upload Categories</h6>
                    <p class="text-muted mb-3">Upload multiple categories at once using CSV/Excel file</p>
                    
                    <form action="{{ route('admin.bulk.categories.upload') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
                        @csrf
                        <div class="mb-3">
                            <input type="file" class="form-control" id="category_file" name="category_file" accept=".xlsx,.xls,.csv" required>
                            <div class="file-info" id="categoryFileInfo">
                                <small class="text-muted"><strong>File selected:</strong> <span class="filename"></span></small>
                            </div>
                        </div>
                        
                        <div class="progress-container" id="categoryProgress">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-2"></i>Upload Categories
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="mt-3">
                    <h6><i class="fas fa-info-circle me-2"></i>Template & Instructions</h6>
                    <p class="small text-muted mb-2">
                        Download the template and fill in your category data. <strong>Required:</strong> Name. <strong>Optional:</strong> Age Category, Description, Image URL, Is Active (Yes/No)
                    </p>
                    <a href="{{ route('admin.bulk.template.download', 'categories') }}" class="template-link">
                        <i class="fas fa-download me-1"></i>Download Category Template
                    </a>
                    
                    <div class="export-section">
                        <h6><i class="fas fa-file-export me-2"></i>Export Existing</h6>
                        <p class="small text-muted mb-2">Download all existing categories</p>
                        <a href="{{ route('admin.bulk.export.categories') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-file-export me-1"></i>Export All Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Bulk Upload -->
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-book-plus me-2"></i>Bulk Product Upload</h5>
            </div>
            <div class="card-body">
                <div class="upload-section text-center">
                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                    <h6>Upload Products</h6>
                    <p class="text-muted mb-3">Upload multiple products for a specific category using CSV/Excel file</p>
                    
                    <form action="{{ route('admin.bulk.products.upload') }}" method="POST" enctype="multipart/form-data" id="productForm">
                        @csrf
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Select Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Choose category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <input type="file" class="form-control" id="product_file" name="product_file" accept=".xlsx,.xls,.csv" required>
                            <div class="file-info" id="productFileInfo">
                                <small class="text-muted"><strong>File selected:</strong> <span class="filename"></span></small>
                            </div>
                        </div>
                        
                        <div class="progress-container" id="productProgress">
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload me-2"></i>Upload Products
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="mt-3">
                    <h6><i class="fas fa-info-circle me-2"></i>Template & Instructions</h6>
                    <p class="small text-muted mb-2">
                        Download the template and fill in your product data. All products will be assigned to the selected category above. <strong>Required:</strong> Name. <strong>Optional:</strong> All other fields including description, pricing, publisher details, etc.
                    </p>
                    <a href="{{ route('admin.bulk.template.download', 'products') }}" class="template-link">
                        <i class="fas fa-download me-1"></i>Download Product Template
                    </a>
                    
                    <div class="export-section">
                        <h6><i class="fas fa-file-export me-2"></i>Export Existing</h6>
                        <p class="small text-muted mb-2">Download existing products</p>
                        
                        <form action="{{ route('admin.bulk.export.products') }}" method="GET" class="d-inline">
                            <div class="input-group input-group-sm mb-2">
                                <select class="form-select" name="category_id">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fas fa-file-export me-1"></i>Export
                                </button>
                            </div>
                        </form>
                        
                        <a href="{{ route('admin.bulk.export.products') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-file-export me-1"></i>Export All Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Bulk Operations Guide</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6><strong><i class="fas fa-upload text-primary me-2"></i>Upload Guidelines:</strong></h6>
                        <ul class="small">
                            <li>Supported formats: CSV, XLS, XLSX</li>
                            <li>Maximum file size: 2MB</li>
                            <li>First row should contain column headers</li>
                            <li>Download templates for proper format</li>
                            <li>Categories: Name (required), Age Category, Description, Image URL, Is Active</li>
                            <li>Products: Name (required), all product details optional</li>
                            <li>Use "Yes/No" or "1/0" for Active status</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6><strong><i class="fas fa-download text-success me-2"></i>Export Features:</strong></h6>
                        <ul class="small">
                            <li>Export all existing categories</li>
                            <li>Export all products or by category</li>
                            <li>Exported files match upload template format</li>
                            <li>Can be used for backup or re-import</li>
                            <li>Generated with timestamp in filename</li>
                            <li>Ready-to-use CSV format for editing</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6><strong><i class="fas fa-info-circle text-info me-2"></i>Field Details:</strong></h6>
                        <ul class="small">
                            <li><strong>Categories:</strong> Name*, Age Category, Description, Image URL, Active Status</li>
                            <li><strong>Products:</strong> Name*, Description, Additional Info, Price, Age, Series, Pages, Publisher, Author, Language, Copyright, Graphics, Stock, SKU, ISBN, Publication Year, Image URL, Active Status</li>
                            <li>* Required fields</li>
                            <li>Image URLs: Use full URLs or leave empty</li>
                            <li>Active Status: Use "Yes/No" or "1/0"</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle file input changes
    document.getElementById('category_file').addEventListener('change', function(e) {
        handleFileSelect(e, 'categoryFileInfo');
    });
    
    document.getElementById('product_file').addEventListener('change', function(e) {
        handleFileSelect(e, 'productFileInfo');
    });
    
    // Handle form submissions with progress
    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        handleFormSubmit(e, 'categoryProgress');
    });
    
    document.getElementById('productForm').addEventListener('submit', function(e) {
        handleFormSubmit(e, 'productProgress');
    });
    
    function handleFileSelect(event, infoElementId) {
        const file = event.target.files[0];
        const infoElement = document.getElementById(infoElementId);
        
        if (file) {
            infoElement.querySelector('.filename').textContent = file.name;
            infoElement.style.display = 'block';
        } else {
            infoElement.style.display = 'none';
        }
    }
    
    function handleFormSubmit(event, progressElementId) {
        const progressContainer = document.getElementById(progressElementId);
        const progressBar = progressContainer.querySelector('.progress-bar');
        const submitButton = event.target.querySelector('button[type="submit"]');
        
        // Show progress bar
        progressContainer.style.display = 'block';
        
        // Disable submit button
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Uploading...';
        
        // Simulate upload progress (since we can't track real progress with regular form submission)
        let progress = 0;
        const interval = setInterval(function() {
            progress += Math.random() * 15;
            if (progress > 90) progress = 90;
            progressBar.style.width = progress + '%';
        }, 200);
        
        // Clean up on page unload (form submission)
        window.addEventListener('beforeunload', function() {
            clearInterval(interval);
        });
    }
});
</script>
@endsection