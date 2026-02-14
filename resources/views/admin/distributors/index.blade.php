@extends('layouts.admin')

@section('title', 'Manage Distributors - Admin Panel')
@section('page-title', 'Manage Distributors')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1">Manage Distributors</h4>
                <p class="text-muted mb-0">Total: {{ $distributors->total() }} distributors</p>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('admin.bulk.index') }}" class="btn btn-outline-secondary me-2" title="Go to Bulk Upload">
                    <i class="fas fa-upload me-1"></i>Bulk Upload
                </a>
                <a href="{{ route('admin.bulk.export.distributors') }}" class="btn btn-outline-success me-2">
                    <i class="fas fa-file-export me-1"></i>Export All
                </a>
                <a href="{{ route('admin.distributors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add New Distributor
                </a>
            </div>
        </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Filters and Search -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form method="GET" class="row align-items-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by company, contact person, email, or city...">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select name="per_page" class="form-select" onchange="this.form.submit()">
                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 per page</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            @if(request('search') || request('per_page') != 15)
                                <a href="{{ route('admin.distributors.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-1"></i>Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    @if($distributors->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead style="background-color: #e43750; color: white;">
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Contact Person</th>
                                        <th class="d-none d-md-table-cell">Contact Info</th>
                                        <th>Email</th>
                                        <th class="d-none d-lg-table-cell">City</th>
                                        <th class="d-none d-xl-table-cell">State Distribution</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($distributors as $distributor)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ ($distributors->currentPage() - 1) * $distributors->perPage() + $loop->iteration }}</td>
                                        <td class="fw-semibold">{{ $distributor->company }}</td>
                                        <td>{{ $distributor->contact_person }}</td>
                                        <td class="d-none d-md-table-cell">{{ Str::limit($distributor->contact_information, 20) }}</td>
                                        <td>
                                            <a href="mailto:{{ $distributor->email_id }}" class="text-decoration-none">
                                                {{ $distributor->email_id }}
                                            </a>
                                        </td>
                                        <td class="d-none d-lg-table-cell">{{ $distributor->city }}</td>
                                        <td class="d-none d-xl-table-cell">{{ Str::limit($distributor->state_wise_distribution, 30) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.distributors.show', $distributor) }}" class="btn btn-outline-info btn-sm" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.distributors.edit', $distributor) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.distributors.destroy', $distributor) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete {{ $distributor->company }}?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    
                    @if($distributors->count() == 0)
                        <div class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-truck fa-3x mb-3"></i>
                                <h5>No distributors found</h5>
                                @if(request('search'))
                                    <p>No distributors match your search criteria.</p>
                                    <a href="{{ route('admin.distributors.index') }}" class="btn btn-outline-secondary">Clear Search</a>
                                @else
                                    <p>Get started by adding your first distributor.</p>
                                    <a href="{{ route('admin.distributors.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>Add New Distributor
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <!-- Pagination -->
                    @if($distributors->count() > 0 && $distributors->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $distributors->firstItem() ?? 0 }} to {{ $distributors->lastItem() ?? 0 }} of {{ $distributors->total() }} entries
                        </div>
                        <div>
                            {{ $distributors->withQueryString()->links() }}
                        </div>
                    </div>
                    @elseif($distributors->count() > 0)
                    <div class="text-center mt-3">
                        <div class="text-muted small">
                            Showing {{ $distributors->total() }} {{ Str::plural('entry', $distributors->total()) }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection