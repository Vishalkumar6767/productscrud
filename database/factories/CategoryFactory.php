<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'short_name' => $this->faker->unique()->word,
            'parent_id' => null, 
        ];
    }
    public function withParent($parentId)
    {
        return $this->state(function (array $attributes) use ($parentId) {
            return [
                'parent_id' => $parentId,
            ];
        });
    }
}
