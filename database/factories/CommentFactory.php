<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Article;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => implode("\n", $this->faker->sentences(3)),
            'user_id' => User::where('id', '!=', 1)->inRandomOrder()->first()->id,
            'article_id' => Article::inRandomOrder()->first()->id
        ];
    }
}
