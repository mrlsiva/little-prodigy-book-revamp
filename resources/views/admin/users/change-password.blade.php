@extends('layouts.admin')

@section('title', 'Change User Password')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Change Password</h2>
                    <p class="text-muted mb-0">Update password for <strong>{{ $user->name }}</strong></p>
                </div>
                <div>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-info me-2">
                        <i class="fas fa-eye me-2"></i>View Profile
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Users
                    </a>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- User Information -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $user->name }}</h4>
                                    <p class="text-muted mb-1">{{ $user->email }} • {{ '@' . $user->username }}</p>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'secondary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Form -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-key me-2"></i>Update Password
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('admin.users.update-password', $user) }}">
                                @csrf
                                @method('PATCH')

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
                                               placeholder="Confirm the new password"
                                               required>
                                    </div>
                                </div>

                                <!-- Security Note -->
                                <div class="alert alert-warning" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Important:</strong> The user will need to use this new password for their next login. Consider notifying them of the password change.
                                </div>

                                <!-- Submit Buttons -->
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-secondary me-3">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-save me-2"></i>Update Password
                                    </button>
                                </div>
                            </form>

                            <!-- Password Security Tips -->
                            <div class="mt-4">
                                <h6 class="fw-bold text-muted mb-3">Password Security Tips:</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check text-success me-2"></i>
                                                Use at least 8 characters
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check text-success me-2"></i>
                                                Include uppercase letters
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check text-success me-2"></i>
                                                Include lowercase letters
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-check text-success me-2"></i>
                                                Include numbers
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check text-success me-2"></i>
                                                Include special characters
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-check text-success me-2"></i>
                                                Avoid common words
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
    }
    
    .avatar {
        user-select: none;
    }
    
    .list-unstyled li {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endsection