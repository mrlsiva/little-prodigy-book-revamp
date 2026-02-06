# Little Prodigy Books 📚

A modern Laravel-based e-commerce website for children's books and educational materials.

## 🌟 Features

### Frontend Features

- **Beautiful Home Page**: Eye-catching Bootstrap carousel slider with navigation
- **Category Showcase**: Lazy-loaded categories with beautiful thumbnail images
- **Product Display**: Each category displays products with images, details, and pricing
- **Infinite Scroll**: Categories load progressively as users scroll down (6 categories at a time)
- **Product Detail Pages**: Comprehensive product information including:
    - Age recommendations
    - Series information
    - Page count
    - Publisher details
    - Author information
    - Language and copyright
    - Graphics description
    - Stock availability
    - SKU tracking

### Admin Panel Features

- **Modern Dashboard**: Statistics overview with quick actions
- **Category Management**:
    - Add/Edit/Delete categories
    - Image upload support
    - Age category specification
    - Active/Inactive status
- **Product Management**:
    - Comprehensive product form with all details
    - Image upload support
    - Stock management
    - Pricing controls
    - Category association

## 🚀 Installation & Setup

1. **Clone or download the project files**

2. **Install Dependencies**

    ```bash
    cd little-prodigy-book-revamp
    composer install --no-dev
    ```

3. **Environment Configuration**
    - The `.env` file is already configured with SQLite database
    - App key is already generated

4. **Database Setup**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

5. **Storage Setup**

    ```bash
    php artisan storage:link
    ```

6. **Start the Server**

    ```bash
    php artisan serve
    ```

7. **Access the Application**
    - **Website**: http://localhost:8000
    - **Admin Panel**: http://localhost:8000/admin

## 📱 Usage

### Website Navigation

- Browse categories on the home page
- Click "Load More Categories" to see additional categories
- Click on any product to view detailed information
- Navigate between categories using the "View All" buttons

### Admin Panel

- Access the admin dashboard at `/admin`
- Manage categories and products
- Upload images for categories and products
- View statistics and recent activity

## 🗂️ Database Schema

### Categories Table

- `id`: Primary key
- `name`: Category name
- `description`: Category description
- `age_category`: Target age group
- `image`: Category image filename
- `is_active`: Visibility status

### Products Table

- `id`: Primary key
- `category_id`: Foreign key to categories
- `name`: Product name
- `description`: Product description
- `additional_info`: Extra product information
- `age`: Age recommendation
- `series`: Book series
- `pages`: Number of pages
- `publisher`: Publisher name
- `author`: Author name
- `language`: Book language
- `copyright`: Copyright year
- `graphics`: Graphics description
- `stock`: Available quantity
- `sku`: Stock keeping unit
- `price`: Product price
- `image`: Product image filename
- `is_active`: Visibility status

## 🎨 Design Features

### Frontend (Website)

- **Bootstrap 5**: Modern, responsive design
- **Font Awesome**: Beautiful icons throughout
- **Custom Gradients**: Eye-catching color schemes
- **Smooth Animations**: Hover effects and transitions
- **Mobile Responsive**: Works perfectly on all devices

### Admin Panel

- **Modern Interface**: Clean, professional design
- **Sidebar Navigation**: Easy access to all features
- **Statistical Cards**: Visual representation of data
- **Form Validation**: Client and server-side validation
- **Image Previews**: Real-time image upload previews

## 🛠️ Technical Stack

- **Framework**: Laravel 12.x (Latest)
- **Frontend**: Bootstrap 5, jQuery, Font Awesome
- **Database**: SQLite (pre-configured)
- **Storage**: Local file system with symlinked storage
- **Authentication**: Laravel built-in (ready for expansion)

## 📦 Sample Data

The application comes with sample data including:

- 6 book categories (Early Learning, Picture Books, Beginning Readers, etc.)
- Multiple products in each category with realistic data
- Proper age categorization and detailed product information

## 🔧 Customization

### Adding New Fields

- Modify the migration files in `database/migrations/`
- Update model relationships in `app/Models/`
- Adjust forms in `resources/views/admin/`

### Styling Changes

- CSS customizations in the layout files
- Bootstrap theme variables can be overridden
- Custom styles are included in the layout templates

### Image Management

- Product images: `storage/app/public/products/`
- Category images: `storage/app/public/categories/`
- Placeholder image: `public/images/no-image.svg`

## 📸 Key Features Demonstration

The application includes:

- **Bootstrap Image Carousel Slider**: Featured prominently on the home page with smooth transitions
- **Category Thumbnail Slider**: Each category displays with beautiful product images
- **Progressive Loading**: Categories load one by one as users scroll
- **Product Showcase**: Each category shows products with detailed specifications
- **Mobile-First Design**: Responsive across all device sizes

## 🎯 Quick Start Guide

1. **First Time Setup**:

    ```bash
    composer install --no-dev
    php artisan migrate
    php artisan db:seed
    php artisan storage:link
    php artisan serve
    ```

2. **Visit the Website**: Open http://localhost:8000 to see:
    - Bootstrap carousel with featured content
    - Category thumbnails with product previews
    - Infinite scroll functionality
    - Detailed product pages

3. **Access Admin Panel**: Go to http://localhost:8000/admin to:
    - Manage categories and products
    - Upload new images
    - Update product specifications
    - View website statistics

## 🤝 Contributing

This is a complete, production-ready e-commerce solution for children's books. Feel free to:

- Customize the design to match your brand
- Add new features like user accounts and shopping cart
- Extend the admin panel with more analytics
- Integrate payment systems
- Add customer reviews and ratings

## 📄 License

This project is ready for commercial use and can be customized according to your needs.

---

**Little Prodigy Books** - Nurturing Young Minds Through Quality Literature 🌟

### Development Notes

- Built with Laravel 12.x for modern PHP development
- Uses SQLite database for easy deployment
- Includes comprehensive admin panel
- Features responsive design with Bootstrap 5
- Implements lazy loading for optimal performance
- Ready for production deployment
