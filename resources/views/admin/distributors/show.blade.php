@extends('layouts.admin')

@section('title', 'Distributor Details - Admin Panel')
@section('page-title', 'Distributor Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Company Name</h6>
                            <p class="h5">{{ $distributor->company }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Contact Person</h6>
                            <p class="h5">{{ $distributor->contact_person }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Contact Information</h6>
                            <p class="h5">{{ $distributor->contact_information }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">Email ID</h6>
                            <p class="h5">
                                <a href="mailto:{{ $distributor->email_id }}" style="color: #e43750;">
                                    {{ $distributor->email_id }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">City</h6>
                            <p class="h5">{{ $distributor->city }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted">State Wise Distribution</h6>
                            <p class="h5">{{ $distributor->state_wise_distribution }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-2">
                            <h6 class="text-muted">Created</h6>
                            <p>{{ $distributor->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <h6 class="text-muted">Last Updated</h6>
                            <p>{{ $distributor->updated_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('admin.distributors.index') }}" class="btn btn-secondary">Back to List</a>
                        <div>
                            <a href="{{ route('admin.distributors.edit', $distributor) }}" class="btn btn-warning">Edit</a>
                            <form method="POST" action="{{ route('admin.distributors.destroy', $distributor) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this distributor?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection