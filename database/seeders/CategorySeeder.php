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
        $parentCategories = Category::factory(10)->create(); 

        // Create subcategories for each parent
        foreach ($parentCategories as $parent) {
            Category::factory(6)->withParent($parent->id)->create(); 
        }
    }
}
