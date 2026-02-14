<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;

class BulkController extends Controller
{
    /**
     * Display the bulk upload page
     */
    public function index()
    {
        $categories = Category::all();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        
        return view('admin.bulk.index', compact('categories', 'totalProducts', 'totalCategories'));
    }

    /**
     * Handle bulk category upload
     */
    public function uploadCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_file' => 'required|file|mimes:xlsx,xls,csv,txt|mimetypes:text/csv,text/plain,application/csv,text/comma-separated-values,application/excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel.sheet.macroEnabled.12|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('category_file');
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            
            // Skip header row
            array_shift($data);
            
            $successCount = 0;
            $errorCount = 0;
            $errors = [];

            DB::beginTransaction();

            foreach ($data as $index => $row) {
                if (empty($row[0])) continue; // Skip empty rows
                
                try {
                    Category::create([
                        'name' => $row[0],
                        'age_category' => $row[1] ?? null,
                        'description' => $row[2] ?? null,
                        'image' => $row[3] ?? null,
                        'is_active' => isset($row[4]) ? (strtolower($row[4]) === 'yes' || $row[4] === '1' || strtolower($row[4]) === 'true') : true,
                    ]);
                    $successCount++;
                } catch (Exception $e) {
                    $errorCount++;
                    $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                }
            }

            DB::commit();

            $message = "Categories uploaded successfully. Success: {$successCount}, Errors: {$errorCount}";
            
            if (!empty($errors)) {
                $message .= "\nErrors:\n" . implode("\n", array_slice($errors, 0, 10));
            }

            return back()->with('success', $message);

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error uploading categories: ' . $e->getMessage());
        }
    }

    /**
     * Handle bulk product upload
     */
    public function uploadProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_file' => 'required|file|mimes:xlsx,xls,csv,txt|mimetypes:text/csv,text/plain,application/csv,text/comma-separated-values,application/excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel.sheet.macroEnabled.12|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('product_file');
            $categoryId = $request->category_id;
            
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            
            // Skip header row
            array_shift($data);
            
            $successCount = 0;
            $errorCount = 0;
            $errors = [];

            DB::beginTransaction();

            foreach ($data as $index => $row) {
                if (empty($row[0])) continue; // Skip empty rows
                
                try {
                    Product::create([
                        'name' => $row[0],
                        'description' => $row[1] ?? null,
                        'additional_info' => $row[2] ?? null,
                        'price' => $row[3] ?? 0,
                        'category_id' => $categoryId,
                        'age' => $row[4] ?? null,
                        'series' => $row[5] ?? null,
                        'pages' => $row[6] ?? null,
                        'publisher' => $row[7] ?? null,
                        'author' => $row[8] ?? null,
                        'language' => $row[9] ?? null,
                        'copyright' => $row[10] ?? null,
                        'graphics' => $row[11] ?? null,
                        'stock' => $row[12] ?? 0,
                        'sku' => $row[13] ?? null,
                        'isbn' => $row[14] ?? null,
                        'publication_year' => $row[15] ?? null,
                        'image' => $row[16] ?? null,
                        'is_active' => isset($row[17]) ? (strtolower($row[17]) === 'yes' || $row[17] === '1' || strtolower($row[17]) === 'true') : true,
                    ]);
                    $successCount++;
                } catch (Exception $e) {
                    $errorCount++;
                    $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                }
            }

            DB::commit();

            $message = "Products uploaded successfully. Success: {$successCount}, Errors: {$errorCount}";
            
            if (!empty($errors)) {
                $message .= "\nErrors:\n" . implode("\n", array_slice($errors, 0, 10));
            }

            return back()->with('success', $message);

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error uploading products: ' . $e->getMessage());
        }
    }

    /**
     * Download sample template files
     */
    public function downloadTemplate($type)
    {
        $templates = [
            'categories' => [
                'filename' => 'categories_template.csv',
                'headers' => ['Name', 'Age Category', 'Description', 'Image URL', 'Is Active'],
                'sample_data' => [
                    ['Fiction', '6-10 years', 'Fiction books and novels for children', '', 'Yes'],
                    ['Non-Fiction', '8-12 years', 'Educational and informative books', '', 'Yes'],
                ]
            ],
            'products' => [
                'filename' => 'products_template.csv',
                'headers' => ['Name', 'Description', 'Additional Info', 'Price', 'Age', 'Series', 'Pages', 'Publisher', 'Author', 'Language', 'Copyright', 'Graphics', 'Stock', 'SKU', 'ISBN', 'Publication Year', 'Image URL', 'Is Active'],
                'sample_data' => [
                    ['Sample Book 1', 'This is a sample book description', 'Additional information about the book', '29.99', '3-5 years', 'Learn to Read', '32', 'Little Prodigy', 'John Doe', 'English', '2024', 'Full Color', '10', 'LP001', '978-1234567890', '2024', '', 'Yes'],
                    ['Sample Book 2', 'Another sample book description', 'More additional information', '35.50', '6-8 years', 'Adventure Series', '48', 'Little Prodigy', 'Jane Smith', 'English', '2024', 'Black & White', '15', 'LP002', '978-0987654321', '2024', '', 'Yes'],
                ]
            ]
        ];

        if (!isset($templates[$type])) {
            abort(404);
        }

        $template = $templates[$type];
        $filename = $template['filename'];
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($template) {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, $template['headers']);
            
            // Write sample data
            foreach ($template['sample_data'] as $row) {
                fputcsv($file, $row);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export existing categories to CSV
     */
    public function exportCategories()
    {
        $categories = Category::all();
        
        $filename = 'categories_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($categories) {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, ['Name', 'Age Category', 'Description', 'Image URL', 'Is Active']);
            
            // Write data
            foreach ($categories as $category) {
                fputcsv($file, [
                    $category->name,
                    $category->age_category,
                    $category->description,
                    $category->image,
                    $category->is_active ? 'Yes' : 'No'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export existing products to CSV
     */
    public function exportProducts(Request $request)
    {
        $query = Product::with('category');
        
        // Filter by category if specified
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
            $categoryName = Category::find($request->category_id)->name ?? 'Unknown';
            $filename = 'products_' . str_replace(' ', '_', strtolower($categoryName)) . '_export_' . date('Y-m-d_H-i-s') . '.csv';
        } else {
            $filename = 'products_export_' . date('Y-m-d_H-i-s') . '.csv';
        }
        
        $products = $query->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, [
                'Name', 'Description', 'Additional Info', 'Price', 'Age', 'Series', 
                'Pages', 'Publisher', 'Author', 'Language', 'Copyright', 'Graphics', 
                'Stock', 'SKU', 'ISBN', 'Publication Year', 'Image URL', 'Is Active'
            ]);
            
            // Write data
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->description,
                    $product->additional_info,
                    $product->price,
                    $product->age,
                    $product->series,
                    $product->pages,
                    $product->publisher,
                    $product->author,
                    $product->language,
                    $product->copyright,
                    $product->graphics,
                    $product->stock,
                    $product->sku,
                    $product->isbn,
                    $product->publication_year,
                    $product->image,
                    $product->is_active ? 'Yes' : 'No'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}