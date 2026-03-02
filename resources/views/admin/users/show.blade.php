@extends('layouts.admin')

@section('title', 'User Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">User Profile</h2>
                    <p class="text-muted mb-0">View detailed information for {{ $user->name }}</p>
                </div>
                <div>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit me-2"></i>Edit User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Users
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- User Information -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user me-2"></i>User Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-muted">Full Name</label>
                                        <p class="fs-5">{{ $user->name }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-muted">Username</label>
                                        <p class="fs-5">{{ '@' . $user->username }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-muted">Role</label>
                                        <p>
                                            @if($user->role === 'admin')
                                                <span class="badge bg-danger fs-6">
                                                    <i class="fas fa-shield-alt me-1"></i>Administrator
                                                </span>
                                            @else
                                                <span class="badge bg-secondary fs-6">
                                                    <i class="fas fa-user me-1"></i>Regular User
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-muted">Email Address</label>
                                        <p class="fs-5">{{ $user->email }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-muted">Status</label>
                                        <p>
                                            @if($user->is_active)
                                                <span class="badge bg-success fs-6">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            @else
                                                <span class="badge bg-warning fs-6">
                                                    <i class="fas fa-pause-circle me-1"></i>Inactive
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-muted">Last Login</label>
                                        <p class="fs-5">
                                            @if($user->last_login_at)
                                                {{ $user->last_login_at->format('M d, Y \a\t g:i A') }}<br>
                                                <small class="text-muted">({{ $user->last_login_at->diffForHumans() }})</small>
                                            @else
                                                <span class="text-muted">Never logged in</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Timeline -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-history me-2"></i>Account Timeline
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Account Created</h6>
                                        <p class="timeline-text">
                                            Created on {{ $user->created_at->format('M d, Y \a\t g:i A') }}
                                            @if($user->createdByUser)
                                                by <strong>{{ $user->createdByUser->name }}</strong>
                                            @endif
                                        </p>
                                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                @if($user->updated_at->ne($user->created_at))
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <h6 class="timeline-title">Last Updated</h6>
                                            <p class="timeline-text">
                                                Updated on {{ $user->updated_at->format('M d, Y \a\t g:i A') }}
                                                @if($user->updatedByUser)
                                                    by <strong>{{ $user->updatedByUser->name }}</strong>
                                                @endif
                                            </p>
                                            <small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                @endif
                                @if($user->last_login_at)
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info"></div>
                                        <div class="timeline-content">
                                            <h6 class="timeline-title">Last Login</h6>
                                            <p class="timeline-text">
                                                Logged in on {{ $user->last_login_at->format('M d, Y \a\t g:i A') }}
                                            </p>
                                            <small class="text-muted">{{ $user->last_login_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-tools me-2"></i>Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </a>
                                <a href="{{ route('admin.users.change-password', $user) }}" class="btn btn-warning">
                                    <i class="fas fa-key me-2"></i>Change Password
                                </a>
                                @if($user->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn w-100 {{ $user->is_active ? 'btn-warning' : 'btn-success' }}"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-{{ $user->is_active ? 'pause' : 'play' }} me-2"></i>
                                            {{ $user->is_active ? 'Deactivate' : 'Activate' }} User
                                        </button>
                                    </form>
                                    <hr>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger w-100"
                                                onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                            <i class="fas fa-trash me-2"></i>Delete User
                                        </button>
                                    </form>
                                @endif
                            </div>

                            @if($user->id === Auth::id())
                                <div class="alert alert-info mt-3" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <small><strong>Note:</strong> You cannot deactivate or delete your own account.</small>
                                </div>
                            @endif
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
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
    }
    
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 30px;
    }
    
    .timeline-item:not(:last-child):before {
        content: '';
        position: absolute;
        left: -21px;
        top: 20px;
        height: calc(100% + 10px);
        width: 2px;
        background: #dee2e6;
    }
    
    .timeline-marker {
        position: absolute;
        left: -25px;
        top: 5px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 0 3px #dee2e6;
    }
    
    .timeline-title {
        margin-bottom: 5px;
        color: #495057;
        font-weight: 600;
    }
    
    .timeline-text {
        margin-bottom: 5px;
        color: #6c757d;
    }
    
    .badge {
        font-size: 0.85rem;
    }
</style>
@endsection