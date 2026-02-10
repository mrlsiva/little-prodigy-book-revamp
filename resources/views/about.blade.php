@extends('layouts.app')

@section('title', 'About Us - Little Prodigy Books')

@section('content')
<!-- Page Header -->
<div class="py-5 mb-5" style="background-color: var(--primary-color);">
    <div class="container">
        <div class="row justify-content-center text-center text-white">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold">About Us</h1>
                <p class="lead">Nurturing young minds through quality children's literature since 2019</p>
            </div>
        </div>
    </div>
</div>

<!-- About Content -->
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- Introduction -->
            <div class="mb-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-4" style="color: var(--primary-color);">Who We Are</h2>
                        <p class="lead text-muted">Little Prodigy Books, founded in 2019, is a division of Aries Books International Group, headquartered in Chennai, Tamil Nadu.</p>
                        <p>With over 500 titles in print, Little Prodigy Books is the largest distributer of English language children's books and periodicals, creating 50-70 new, high quality children's titles each year. We are the leading print publisher of reference products and operator of direct-to-home book clubs for children.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center p-4 bg-light rounded">
                            <i class="fas fa-book-open fa-4x mb-3" style="color: var(--primary-color);"></i>
                            <h3 style="color: var(--primary-color);">500+</h3>
                            <p class="mb-0">Titles in Print</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Services -->
            <div class="mb-5">
                <h2 class="mb-4" style="color: var(--primary-color);">Our Services</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="fas fa-tablet-alt fa-3x" style="color: var(--primary-color);"></i>
                                </div>
                                <h5 class="card-title text-center">Digital Library</h5>
                                <p class="card-text">Little Prodigy Books offers close to 500 eBooks: Carefully curated list of the finest books for young readers for the age group 3-15 years, who can be benefitted by reading endlessly from our website.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <i class="fas fa-shipping-fast fa-3x" style="color: var(--primary-color);"></i>
                                </div>
                                <h5 class="card-title text-center">Distribution Network</h5>
                                <p class="card-text">Little Prodigy Books & Services sells and distributes high-quality children's books & E-books from renowned publishing partners through all major sales channels.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Mission -->
            <div class="bg-light p-4 rounded mb-5">
                <h2 class="mb-4" style="color: var(--primary-color);">Our Mission</h2>
                <blockquote class="blockquote">
                    <p class="mb-3"><i class="fas fa-quote-left me-2" style="color: var(--primary-color);"></i>As you stay safe indoors, now is the time to discover a great book – one that will educate, inform, inspire, comfort or simply help you to escape. At Little Prodigy Books, we offer a wealth of brilliant and bestselling books to meet every need for children.</p>
                </blockquote>
                <p>We believe learning never ends. It's a constant process, a result of interacting with the world around you. You engage in learning and the more you know; the more knowledge will reward you by opening your eyes and your mind. We strive to do just that for our readers and customers.</p>
            </div>

            <!-- Our Impact -->
            <div class="mb-5">
                <h2 class="mb-4" style="color: var(--primary-color);">Our Impact</h2>
                <p>Found in classrooms, libraries, and homes, our inventive and engaging titles meet the diverse needs of Children avid readers, helping them to achieve and succeed.</p>
                
                <div class="row mt-4">
                    <div class="col-md-4 text-center mb-4">
                        <div class="p-3">
                            <i class="fas fa-school fa-3x mb-3" style="color: var(--primary-color);"></i>
                            <h5>Classrooms</h5>
                            <p class="text-muted">Supporting educational institutions with quality children's literature</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="p-3">
                            <i class="fas fa-building fa-3x mb-3" style="color: var(--primary-color);"></i>
                            <h5>Libraries</h5>
                            <p class="text-muted">Partnering with libraries to expand young readers' access to books</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="p-3">
                            <i class="fas fa-home fa-3x mb-3" style="color: var(--primary-color);"></i>
                            <h5>Homes</h5>
                            <p class="text-muted">Bringing quality reading experiences directly to families</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Process -->
            <div class="mb-5">
                <h2 class="mb-4" style="color: var(--primary-color);">Our Creative Process</h2>
                <p>From the building blocks of literacy, to picture books filled with humor, to entertaining graphic skilled library e books, Little Prodigy Books Group imprints both empower and entertain.</p>
                
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-pen-fancy fa-2x" style="color: var(--primary-color);"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Authors & Writers</h6>
                                <p class="text-muted mb-0">Collaborating with talented authors to create engaging stories</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-palette fa-2x" style="color: var(--primary-color);"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Illustrators</h6>
                                <p class="text-muted mb-0">Working with skilled illustrators to bring stories to life</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-camera fa-2x" style="color: var(--primary-color);"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Photographers</h6>
                                <p class="text-muted mb-0">Capturing beautiful imagery for our publications</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-graduation-cap fa-2x" style="color: var(--primary-color);"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>Educators</h6>
                                <p class="text-muted mb-0">Ensuring content meets curriculum standards and learning objectives</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert mt-4" style="background-color: color-mix(in srgb, var(--primary-color) 10%, white); border-color: var(--primary-color); color: color-mix(in srgb, var(--primary-color) 90%, black);" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Quality Assurance:</strong> We bring together authors, illustrators, photographers, and educators to ensure that each book we create is age appropriate and meets curriculum standards.
                </div>
            </div>

            <!-- Statistics -->
            <div class="text-white p-4 rounded text-center" style="background-color: var(--primary-color);">
                <h2 class="mb-4">Little Prodigy Books by Numbers</h2>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <h3 class="display-6">2019</h3>
                        <p class="mb-0">Year Founded</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h3 class="display-6">500+</h3>
                        <p class="mb-0">Titles in Print</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h3 class="display-6">50-70</h3>
                        <p class="mb-0">New Titles Annually</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <h3 class="display-6">3-15</h3>
                        <p class="mb-0">Age Group (Years)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-light py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="mb-3" style="color: var(--primary-color);">Ready to Start Reading?</h3>
                <p class="lead text-muted mb-4">Explore our collection of carefully curated children's books and start your reading journey today.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('categories') }}" class="btn btn-lg theme-btn-primary">
                        <i class="fas fa-book-open me-2"></i>Browse Categories
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-lg theme-btn-outline">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.theme-btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transition: all 0.3s ease;
}

.theme-btn-primary:hover {
    background-color: color-mix(in srgb, var(--primary-color) 90%, black);
    border-color: color-mix(in srgb, var(--primary-color) 90%, black);
    color: white;
    transform: translateY(-2px);
}

.theme-btn-outline {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    background-color: transparent;
    transition: all 0.3s ease;
}

.theme-btn-outline:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}
</style>
@endsection