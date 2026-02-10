<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Little Prodigy Books')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
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
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('categories') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('publishing.partners') }}">Publishing Partners</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('distributorship') }}">Distributorship</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ asset('catalouge/Our-Library-Catalogue.pdf') }}" target="_blank">Library Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('admin.dashboard') }}">Admin Panel</a>
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
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="mb-3">Little Prodigy Books</h5>
                    <p class="text-muted">A division of Aries Books International Group. Your trusted partner in children's education through quality literature since 2019.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('publishing.partners') }}" class="text-decoration-none">Our Publishing Partners</a></li>
                        <li><a href="{{ route('distributorship') }}" class="text-decoration-none">Our Distributorship</a></li>
                        <li><a href="{{ asset('catalouge/Our-Library-Catalogue.pdf') }}" class="text-decoration-none" target="_blank">Library Catalogue</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p class="text-muted"><i class="fas fa-envelope me-2"></i> info@littleprodigybooks.com</p>
                    <p class="text-muted"><i class="fas fa-map-marker-alt me-2"></i> Chennai, Tamil Nadu</p>
                    <p class="text-muted"><i class="fas fa-phone me-2"></i> +91 44 2345 6789</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2026 Little Prodigy Books. All rights reserved.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @yield('scripts')
</body>
</html>