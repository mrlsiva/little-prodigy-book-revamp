<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'age_category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = basename($imagePath);
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'age_category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete('categories/' . $category->image);
            }
            
            $imagePath = $request->file('image')->store('categories', 'public');
            $validated['image'] = basename($imagePath);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete('categories/' . $category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Category deleted successfully.');
    }
}