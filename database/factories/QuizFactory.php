<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $quizName = $this->faker->unique()->words($nb = 4, $asText = true);
        $slug = Str::slug($quizName);
        return [
            'name' => $quizName,
            'description' => $this->faker->text(400),
            'category_id' => $this->faker->numberBetween(1, 5),
            'slug' => $slug
        ];
    }
}
