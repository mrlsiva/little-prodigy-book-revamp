@extends('layouts.admin')

@section('title', 'Add New Distributor - Admin Panel')
@section('page-title', 'Add New Distributor')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                    <form method="POST" action="{{ route('admin.distributors.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="company" class="form-label">Company Name</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" 
                                   id="company" name="company" value="{{ old('company') }}" required>
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                   id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_information" class="form-label">Contact Information</label>
                            <input type="text" class="form-control @error('contact_information') is-invalid @enderror" 
                                   id="contact_information" name="contact_information" value="{{ old('contact_information') }}" required>
                            @error('contact_information')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email_id" class="form-label">Email ID</label>
                            <input type="email" class="form-control @error('email_id') is-invalid @enderror" 
                                   id="email_id" name="email_id" value="{{ old('email_id') }}" required>
                            @error('email_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                   id="city" name="city" value="{{ old('city') }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="state_wise_distribution" class="form-label">State Wise Distribution</label>
                            <input type="text" class="form-control @error('state_wise_distribution') is-invalid @enderror" 
                                   id="state_wise_distribution" name="state_wise_distribution" value="{{ old('state_wise_distribution') }}" required>
                            @error('state_wise_distribution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.distributors.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add Distributor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection