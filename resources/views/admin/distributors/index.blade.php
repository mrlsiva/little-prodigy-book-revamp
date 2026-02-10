@extends('layouts.admin')

@section('title', 'Manage Distributors - Admin Panel')
@section('page-title', 'Manage Distributors')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('admin.distributors.create') }}" class="btn btn-primary">Add New Distributor</a>
        </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead style="background-color: #e43750; color: white;">
                                <tr>
                                    <th>ID</th>
                                    <th>Company</th>
                                    <th>Contact Person</th>
                                    <th>Contact Info</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>State Distribution</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($distributors as $distributor)
                                <tr>
                                    <td>{{ $distributor->id }}</td>
                                    <td>{{ $distributor->company }}</td>
                                    <td>{{ $distributor->contact_person }}</td>
                                    <td>{{ $distributor->contact_information }}</td>
                                    <td>{{ $distributor->email_id }}</td>
                                    <td>{{ $distributor->city }}</td>
                                    <td>{{ $distributor->state_wise_distribution }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.distributors.show', $distributor) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('admin.distributors.edit', $distributor) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form method="POST" action="{{ route('admin.distributors.destroy', $distributor) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this distributor?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No distributors found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection