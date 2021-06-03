<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = ['Bilim', 'Genel kültür', 'Spor', 'Teknoloji', 'Matematik'];
        $category = $categories[$this->faker->unique()->numberBetween(0, 4)];
        $slug = Str::slug($category);
        return [
            'name' => $category,
            'slug' => $slug
        ];
    }
}
