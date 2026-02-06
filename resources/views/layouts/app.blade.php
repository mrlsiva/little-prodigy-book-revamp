<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Little Prodigy Books')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #ff6b6b !important;
        }
        
        .category-card {
            transition: transform 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .product-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 10px;
        }
        
        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }
        
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 40px 0;
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(45deg, #ff5252, #26c6da);
        }
        
        .category-slider {
            overflow-x: auto;
            white-space: nowrap;
            padding: 20px 0;
        }
        
        .category-slider::-webkit-scrollbar {
            height: 8px;
        }
        
        .category-slider::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .category-slider::-webkit-scrollbar-thumb {
            background: #ff6b6b;
            border-radius: 4px;
        }
        
        .loading-spinner {
            display: none;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-book-open"></i> Little Prodigy Books
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
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
                    <h5><i class="fas fa-book-open"></i> Little Prodigy Books</h5>
                    <p>Your trusted partner in early childhood education and development through quality books.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-light">Home</a></li>
                        <li><a href="#" class="text-light">About Us</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-envelope"></i> info@littleprodigybooks.com</p>
                    <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2026 Little Prodigy Books. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @yield('scripts')
</body>
</html>