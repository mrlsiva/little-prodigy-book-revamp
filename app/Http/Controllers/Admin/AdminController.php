<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalCategories = Category::count();
        $activeCategories = Category::where('is_active', true)->count();
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $outOfStockProducts = Product::where('stock', 0)->count();
        
        $recentProducts = Product::with('category')
                                ->latest()
                                ->limit(5)
                                ->get();

        $recentCategories = Category::latest()
                                  ->limit(5)
                                  ->get();

        return view('admin.dashboard', compact(
            'totalCategories',
            'activeCategories', 
            'totalProducts',
            'activeProducts',
            'outOfStockProducts',
            'recentProducts',
            'recentCategories'
        ));
    }
}