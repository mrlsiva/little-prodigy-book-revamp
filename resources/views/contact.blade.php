@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary-theme text-white text-center py-4">
                    <h1 class="mb-0">
                        <i class="fas fa-envelope me-2"></i>
                        Contact Us
                    </h1>
                </div>
                <div class="card-body p-5">
                    <div class="row g-4">
                        <!-- Email Section -->
                        <div class="col-md-12">
                            <div class="contact-item border rounded-3 p-4 h-100 border-primary-theme">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon bg-primary-theme text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <h4 class="text-primary-theme mb-0">Email</h4>
                                </div>
                                <a href="mailto:books.littleprodigy@gmail.com" class="text-dark text-decoration-none fs-5">
                                    books.littleprodigy@gmail.com
                                </a>
                            </div>
                        </div>

                        <!-- Phone Section -->
                        <div class="col-md-12">
                            <div class="contact-item border rounded-3 p-4 h-100 border-primary-theme">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon bg-primary-theme text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <h4 class="text-primary-theme mb-0">Phone</h4>
                                </div>
                                <div class="phone-numbers">
                                    <a href="tel:+918856914939" class="text-dark text-decoration-none fs-5 d-block mb-2">
                                        +91 8856914939
                                    </a>
                                    <a href="tel:+919011524939" class="text-dark text-decoration-none fs-5">
                                        +91 9011524939
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        <div class="col-md-12">
                            <div class="contact-item border rounded-3 p-4 h-100 border-primary-theme">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="contact-icon bg-primary-theme text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <h4 class="text-primary-theme mb-0">Address</h4>
                                </div>
                                <address class="mb-0 fs-5 text-dark">
                                    No 10 Venkataraman street<br>
                                    Srinivasa avenue<br>
                                    Chennai 600028
                                </address>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Home Button -->
                    <div class="text-center mt-5">
                        <a href="{{ route('home') }}" class="btn btn-theme-primary btn-lg px-4 py-2">
                            <i class="fas fa-home me-2"></i>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.contact-item {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(var(--primary-rgb), 0.15);
}

.contact-icon {
    transition: all 0.3s ease;
}

.contact-item:hover .contact-icon {
    transform: scale(1.1);
}

.phone-numbers a:hover,
.contact-item a:hover {
    color: var(--primary-color) !important;
    transition: color 0.3s ease;
}

address {
    font-style: normal;
    line-height: 1.6;
}
</style>
@endpush