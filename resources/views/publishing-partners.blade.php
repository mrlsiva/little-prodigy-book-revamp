@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4" style="color: #e43750;">Our Publishing Partners</h1>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-12 mb-4">
                                    <p class="lead text-justify">
                                        We are pleased to be able to provide access to e-books & Physical books from the world-renowned publishing programs of our partner presses via <strong>Aries Books International, India</strong> & <strong>Cherry Lake Publishing, USA</strong>. These titles cover subjects from all disciplines across the fields of science, technology and medicine, as well as humanities and social sciences.
                                    </p>
                                    
                                    <p class="text-justify">
                                        Making a unique contribution to the world of scholarship, our e-book partner publishing program sets new standards for the integration of key schools' academic content. It offers all users a new dimension of access and usability, supporting and enhancing research.
                                    </p>
                                    
                                    <p class="text-justify">
                                        Access to these partner publisher titles through Aries Books & Cherry Lake is available to libraries worldwide under a number of attractive and flexible models, ensuring instant access to the best research available.
                                    </p>
                                </div>
                                <div class="col-md-12 text-center">
                                    <img src="{{ asset('images/dist.png') }}" alt="Publishing Partners" class="img-fluid rounded shadow-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Partner Highlights Section -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0" style="background: linear-gradient(135deg, #e43750 0%, #d32f44 100%); color: white;">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-globe fa-3x mb-3"></i>
                                    <h4>Aries Books International</h4>
                                    <p class="mb-0">India-based publishing partner providing comprehensive academic and educational content across multiple disciplines.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 border-0" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-leaf fa-3x mb-3"></i>
                                    <h4>Cherry Lake Publishing</h4>
                                    <p class="mb-0">USA-based publisher specializing in quality educational materials and innovative learning solutions.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Benefits Section -->
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: #e43750; color: white;">
                            <h5 class="mb-0"><i class="fas fa-star me-2"></i>Partnership Benefits</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-3 fa-2x"></i>
                                        <div>
                                            <h6 class="mb-1">Global Access</h6>
                                            <small class="text-muted">Worldwide library availability</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book-open text-primary me-3 fa-2x"></i>
                                        <div>
                                            <h6 class="mb-1">Multi-Format</h6>
                                            <small class="text-muted">E-books & Physical books</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-graduation-cap text-warning me-3 fa-2x"></i>
                                        <div>
                                            <h6 class="mb-1">Academic Excellence</h6>
                                            <small class="text-muted">Scholarly content standards</small>
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
</div>

<style>
.text-justify {
    text-align: justify;
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}
</style>
@endsection