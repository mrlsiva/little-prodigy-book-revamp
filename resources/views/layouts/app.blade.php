<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Little Prodigy Books - Your premier source for educational books, children\'s literature, and academic resources. Discover quality publications for young minds.')">
    <meta name="keywords" content="@yield('keywords', 'books, education, children books, academic resources, Little Prodigy, literature, learning, publishing')">
    <meta name="author" content="Little Prodigy Books">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <meta name="distribution" content="global">
    <meta name="rating" content="general">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'Little Prodigy Books')">
    <meta property="og:description" content="@yield('og_description', 'Your premier source for educational books, children\'s literature, and academic resources. Discover quality publications for young minds.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:site_name" content="Little Prodigy Books">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Little Prodigy Books')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Your premier source for educational books, children\'s literature, and academic resources.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/logo.png'))">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <title>@yield('title', 'Little Prodigy Books')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">
    
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    
    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('styles')
</head>
<body>
    <!-- Top Navigation Bar -->
    <div class="top-nav">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-2">
                <div class="top-nav-left">
                    <i class="fas fa-shopping-cart text-white me-2"></i>
                    <span class="text-white">0 items - ( Rs. 0 in total )</span>
                </div>
                <div class="top-nav-right">
                    <a href="#" class="text-white text-decoration-none me-3">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm main-nav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Little Prodigy Books" style="max-height: 60px;">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="littleProdigyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Little Prodigy
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="littleProdigyDropdown">
                            <li><a class="dropdown-item" href="{{ route('categories') }}">Categories</a></li>
                            <li><a class="dropdown-item" href="{{ route('about') }}">About</a></li>
                            <li><a class="dropdown-item" href="{{ route('publishing.partners') }}">Publishing Partners</a></li>
                            <li><a class="dropdown-item" href="{{ route('distributorship') }}">Distributorship</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">Ebooks – Home Education</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="myAccountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="myAccountDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Orders</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="mb-3">Little Prodigy Books</h5>
                    <p class="text-muted">A division of Aries Books International Group. Your trusted partner in children's education through quality literature since 2019.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-decoration-none text-light">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-decoration-none text-light">About Us</a></li>
                        <li><a href="{{ route('publishing.partners') }}" class="text-decoration-none text-light">Our Publishing Partners</a></li>
                        <li><a href="{{ route('distributorship') }}" class="text-decoration-none text-light">Our Distributorship</a></li>
                        <li><a href="{{ asset('catalouge/Our-Library-Catalogue.pdf') }}" class="text-decoration-none text-light" target="_blank">Library Catalogue</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p class="text-muted"><i class="fas fa-envelope me-2"></i> info@littleprodigybooks.com</p>
                    <p class="text-muted"><i class="fas fa-map-marker-alt me-2"></i> Chennai, Tamil Nadu</p>
                    <p class="text-muted"><i class="fas fa-phone me-2"></i> +91 44 2345 6789</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2026 Little Prodigy Books. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Action Buttons -->
    <div class="floating-buttons">
        <!-- Catalogue Button -->
        <a href="{{ asset('catalouge/Catalogue-2020.pdf') }}" target="_blank" class="floating-btn catalogue-btn">
            <i class="fas fa-book me-2"></i>
            <span>Catalogue</span>
        </a>
        
        <!-- WhatsApp Button -->
        <a href="https://wa.me/919011524939?text=Hi,%20I%20would%20like%20to%20know%20more%20about%20Little%20Prodigy%20Books" target="_blank" class="floating-btn whatsapp-btn">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <style>
        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .floating-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .floating-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            text-decoration: none;
        }

        .catalogue-btn {
            background: #495057;
            color: white;
            padding: 12px 16px;
            min-width: 120px;
        }

        .catalogue-btn:hover {
            background: #343a40;
            color: white;
        }

        .whatsapp-btn {
            background: #25d366;
            color: white;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            font-size: 24px;
        }

        .whatsapp-btn:hover {
            background: #128c7e;
            color: white;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .floating-buttons {
                bottom: 15px;
                right: 15px;
            }
            
            .floating-btn {
                font-size: 13px;
            }
            
            .catalogue-btn {
                padding: 10px 14px;
                min-width: 110px;
            }
            
            .whatsapp-btn {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>