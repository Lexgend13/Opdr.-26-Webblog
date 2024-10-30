<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = Storage::files('public');
        $imagePath = null;
        if (rand(0,1)) {
            $imagePath = $images[array_rand($images)];
        }
        return [
            'title' => $this->faker->sentence,
            'text' => implode("\n", $this->faker->sentences(40)),
            'author_id' => User::where('id', '!=', 1)->inRandomOrder()->first()->id,
            'isPremium' => $this->faker->boolean,
            'image_path' => $imagePath
        ];
    }
}
