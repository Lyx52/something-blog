<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Laravel',
            'Programming',
            'Software engineering',
            'Artificial intelligence'
        ];

        foreach ($categories as $category) {
            if (Category::where('title', $category)->exists()) {
                continue;
            }

            Category::create([
                'title' => $category
            ]);
        }
    }
}
