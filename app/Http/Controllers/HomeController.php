<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get active banners for slider
        $banners = Banner::active()->ordered()->get();
        
        // Get first 6 categories that have active products for initial load
        $categories = Category::where('is_active', true)
                             ->whereHas('products', function($query) {
                                 $query->where('is_active', true);
                             })
                             ->with(['products' => function($query) {
                                 $query->where('is_active', true)->limit(8);
                             }])
                             ->take(6)
                             ->get();

        return view('home', compact('categories', 'banners'));
    }

    public function loadMoreCategories(Request $request)
    {
        $skip = $request->get('skip', 0);
        $take = 6;

        $categories = Category::where('is_active', true)
                             ->whereHas('products', function($query) {
                                 $query->where('is_active', true);
                             })
                             ->with(['products' => function($query) {
                                 $query->where('is_active', true)->limit(8);
                             }])
                             ->skip($skip)
                             ->take($take)
                             ->get();

        return response()->json([
            'categories' => $categories,
            'hasMore' => Category::where('is_active', true)
                                ->whereHas('products', function($query) {
                                    $query->where('is_active', true);
                                })
                                ->count() > ($skip + $take)
        ]);
    }

    public function categories()
    {
        // Get all active categories that have active products
        $categories = Category::where('is_active', true)
                             ->whereHas('products', function($query) {
                                 $query->where('is_active', true);
                             })
                             ->withCount(['products' => function($query) {
                                 $query->where('is_active', true);
                             }])
                             ->orderBy('name', 'asc')
                             ->get();

        return view('categories', compact('categories'));
    }

    public function categoryProducts($id)
    {
        $category = Category::with(['products' => function($query) {
                        $query->where('is_active', true);
                    }])
                    ->findOrFail($id);

        return view('category-products', compact('category'));
    }

    public function productDetail($id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        // Get related products from same category
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->where('is_active', true)
                                 ->limit(4)
                                 ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }

    public function publishingPartners()
    {
        return view('publishing-partners');
    }
}