@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Change Password</h2>
                    <p class="text-muted mb-0">Update your account security credentials</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>

            <!-- Change Password Form -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-lock me-2"></i>Password Security
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('admin.change-password') }}">
                                @csrf

                                <!-- Current Password -->
                                <div class="mb-3">
                                    <label for="current_password" class="form-label fw-bold">
                                        <i class="fas fa-key me-1"></i>Current Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('current_password') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password" 
                                               placeholder="Enter your current password"
                                               required>
                                    </div>
                                    @error('current_password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">
                                        <i class="fas fa-shield-alt me-1"></i>New Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-shield-alt"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Enter new password (min 8 characters)"
                                               required>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Password must be at least 8 characters long
                                    </small>
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-bold">
                                        <i class="fas fa-check-double me-1"></i>Confirm New Password
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-check-double"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               placeholder="Confirm your new password"
                                               required>
                                    </div>
                                </div>

                                <!-- Security Note -->
                                <div class="alert alert-info" role="alert">
                                    <i class="fas fa-shield-alt me-2"></i>
                                    <strong>Security Tip:</strong> Choose a strong password that includes uppercase and lowercase letters, numbers, and symbols.
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Password
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary ms-2">
                                    Cancel
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .input-group-text {
        background: #f8f9fa;
        border-color: #dee2e6;
    }
    
    .form-control {
        border-color: #dee2e6;
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
    }
</style>
@endsection