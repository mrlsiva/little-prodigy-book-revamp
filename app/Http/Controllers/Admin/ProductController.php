<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'age' => 'nullable|string|max:255',
            'series' => 'nullable|string|max:255',
            'pages' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'copyright' => 'nullable|string|max:255',
            'graphics' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:products',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = basename($imagePath);
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'age' => 'nullable|string|max:255',
            'series' => 'nullable|string|max:255',
            'pages' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'copyright' => 'nullable|string|max:255',
            'graphics' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $product->id,
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = basename($imagePath);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                        ->with('success', 'Product deleted successfully.');
    }
}