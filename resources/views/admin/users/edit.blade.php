@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Edit User</h2>
                    <p class="text-muted mb-0">Update user information for {{ $user->name }}</p>
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

            <!-- Edit User Form -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user-edit me-2"></i>Update User Information
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label fw-bold">
                                            <i class="fas fa-user me-1"></i>Full Name
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               placeholder="Enter full name"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-bold">
                                            <i class="fas fa-envelope me-1"></i>Email Address
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}" 
                                               placeholder="Enter email address"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Username -->
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label fw-bold">
                                            <i class="fas fa-at me-1"></i>Username
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('username') is-invalid @enderror" 
                                               id="username" 
                                               name="username" 
                                               value="{{ old('username', $user->username) }}" 
                                               placeholder="Enter username"
                                               required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Role -->
                                    <div class="col-md-6 mb-3">
                                        <label for="role" class="form-label fw-bold">
                                            <i class="fas fa-shield-alt me-1"></i>User Role
                                        </label>
                                        <select class="form-select @error('role') is-invalid @enderror" 
                                                id="role" 
                                                name="role" 
                                                required
                                                @if($user->id === Auth::id()) disabled @endif>
                                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                                            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Regular User</option>
                                        </select>
                                        @if($user->id === Auth::id())
                                            <input type="hidden" name="role" value="{{ $user->role }}">
                                            <small class="form-text text-muted">You cannot change your own role</small>
                                        @endif
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Active Status -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               value="1" 
                                               id="is_active" 
                                               name="is_active" 
                                               {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                               @if($user->id === Auth::id()) disabled @endif>
                                        <label class="form-check-label fw-bold" for="is_active">
                                            <i class="fas fa-check-circle me-1"></i>Active User
                                        </label>
                                        @if($user->id === Auth::id())
                                            <input type="hidden" name="is_active" value="1">
                                            <small class="form-text text-muted d-block">You cannot deactivate your own account</small>
                                        @else
                                            <small class="form-text text-muted d-block">Inactive users cannot login to the system</small>
                                        @endif
                                    </div>
                                </div>

                                <!-- Last Login Info -->
                                @if($user->last_login_at)
                                    <div class="alert alert-info mb-4">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Last Login:</strong> {{ $user->last_login_at->format('M d, Y \a\t g:i A') }} 
                                        ({{ $user->last_login_at->diffForHumans() }})
                                    </div>
                                @endif

                                <!-- Submit Buttons -->
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('admin.users.change-password', $user) }}" class="btn btn-warning">
                                            <i class="fas fa-key me-2"></i>Change Password
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-3">
                                            <i class="fas fa-times me-2"></i>Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Update User
                                        </button>
                                    </div>
                                </div>
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
    .form-control, .form-select {
        border-radius: 8px;
        border-color: #dee2e6;
    }
    
    .form-control:focus, .form-select:focus {
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
    
    .form-label {
        color: #495057;
    }
</style>
@endsection