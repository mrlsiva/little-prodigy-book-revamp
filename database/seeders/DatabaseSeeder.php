<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample categories
        $categories = [
            [
                'name' => 'Early Learning',
                'description' => 'Books designed for early childhood development and basic learning concepts.',
                'age_category' => '2-4 years',
                'is_active' => true
            ],
            [
                'name' => 'Picture Books',
                'description' => 'Beautifully illustrated picture books that captivate young readers.',
                'age_category' => '3-6 years',
                'is_active' => true
            ],
            [
                'name' => 'Beginning Readers',
                'description' => 'Simple stories perfect for children just starting to read independently.',
                'age_category' => '4-7 years',
                'is_active' => true
            ],
            [
                'name' => 'Chapter Books',
                'description' => 'Engaging chapter books for developing readers.',
                'age_category' => '6-9 years',
                'is_active' => true
            ],
            [
                'name' => 'Educational & Science',
                'description' => 'Learning books covering science, nature, and educational topics.',
                'age_category' => '5-10 years',
                'is_active' => true
            ],
            [
                'name' => 'Activity Books',
                'description' => 'Interactive books with puzzles, games, and activities.',
                'age_category' => '3-8 years',
                'is_active' => true
            ]
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);
            
            // Create sample products for each category
            $products = $this->getProductsForCategory($category->name);
            
            foreach ($products as $productData) {
                $productData['category_id'] = $category->id;
                Product::create($productData);
            }
        }
    }

    private function getProductsForCategory($categoryName)
    {
        $products = [
            'Early Learning' => [
                [
                    'name' => 'My First Colors',
                    'description' => 'A colorful introduction to basic colors for toddlers.',
                    'age' => '2-3 years',
                    'pages' => 16,
                    'publisher' => 'Little Prodigy Publishing',
                    'author' => 'Sarah Johnson',
                    'language' => 'English',
                    'copyright' => '2024',
                    'graphics' => 'Full Color Illustrations',
                    'stock' => 25,
                    'sku' => 'LP-EL-001',
                    'price' => 9.99,
                    'is_active' => true
                ],
                [
                    'name' => 'Counting with Animals',
                    'description' => 'Learn numbers 1-10 with adorable animal friends.',
                    'age' => '2-4 years',
                    'pages' => 20,
                    'publisher' => 'Little Prodigy Publishing',
                    'author' => 'Michael Chen',
                    'language' => 'English',
                    'copyright' => '2024',
                    'graphics' => 'Full Color Illustrations',
                    'stock' => 30,
                    'sku' => 'LP-EL-002',
                    'price' => 11.99,
                    'is_active' => true
                ]
            ],
            'Picture Books' => [
                [
                    'name' => 'The Magic Garden',
                    'description' => 'A beautiful story about friendship and growing things.',
                    'age' => '3-6 years',
                    'pages' => 32,
                    'publisher' => 'Wonder Books',
                    'author' => 'Emily Rodriguez',
                    'language' => 'English',
                    'copyright' => '2024',
                    'graphics' => 'Full Color Illustrations',
                    'stock' => 20,
                    'sku' => 'LP-PB-001',
                    'price' => 14.99,
                    'is_active' => true
                ],
                [
                    'name' => 'Luna the Little Owl',
                    'description' => 'Follow Luna on her nighttime adventures.',
                    'age' => '4-7 years',
                    'pages' => 28,
                    'publisher' => 'Night Sky Books',
                    'author' => 'David Thompson',
                    'language' => 'English',
                    'copyright' => '2023',
                    'graphics' => 'Full Color Illustrations',
                    'stock' => 15,
                    'sku' => 'LP-PB-002',
                    'price' => 13.99,
                    'is_active' => true
                ]
            ],
            'Beginning Readers' => [
                [
                    'name' => 'Sam and the Big Adventure',
                    'description' => 'An easy-to-read story about courage and friendship.',
                    'age' => '4-7 years',
                    'series' => 'Sam\'s Adventures',
                    'pages' => 48,
                    'publisher' => 'First Read Publishing',
                    'author' => 'Lisa Martinez',
                    'language' => 'English',
                    'copyright' => '2024',
                    'graphics' => 'Color Illustrations',
                    'stock' => 18,
                    'sku' => 'LP-BR-001',
                    'price' => 8.99,
                    'is_active' => true
                ]
            ],
            'Chapter Books' => [
                [
                    'name' => 'The Secret Treehouse Club',
                    'description' => 'Four friends discover a magical treehouse with amazing secrets.',
                    'age' => '6-9 years',
                    'series' => 'Treehouse Adventures',
                    'pages' => 96,
                    'publisher' => 'Adventure Books Inc.',
                    'author' => 'Robert Kim',
                    'language' => 'English',
                    'copyright' => '2024',
                    'graphics' => 'Black & White Illustrations',
                    'stock' => 12,
                    'sku' => 'LP-CB-001',
                    'price' => 12.99,
                    'is_active' => true
                ]
            ],
            'Educational & Science' => [
                [
                    'name' => 'Amazing Dinosaurs',
                    'description' => 'Discover the fascinating world of dinosaurs with fun facts and pictures.',
                    'age' => '5-8 years',
                    'pages' => 64,
                    'publisher' => 'Science Fun Books',
                    'author' => 'Dr. Amanda Wilson',
                    'language' => 'English',
                    'copyright' => '2024',
                    'graphics' => 'Full Color Photos & Illustrations',
                    'stock' => 22,
                    'sku' => 'LP-ES-001',
                    'price' => 16.99,
                    'is_active' => true
                ]
            ],
            'Activity Books' => [
                [
                    'name' => 'Fun Puzzles for Little Minds',
                    'description' => 'Engaging puzzles and activities to develop problem-solving skills.',
                    'age' => '4-7 years',
                    'pages' => 80,
                    'publisher' => 'Activity Central',
                    'author' => 'Games Team',
                    'language' => 'English',
                    'copyright' => '2024',
                    'graphics' => 'Black & White with Color Sections',
                    'stock' => 35,
                    'sku' => 'LP-AB-001',
                    'price' => 10.99,
                    'is_active' => true
                ]
            ]
        ];

        return $products[$categoryName] ?? [];
    }
}
