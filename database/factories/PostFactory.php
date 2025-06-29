<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Stevebauman\Purify\Facades\Purify;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realTextBetween(64, 128);
        return [
            'title' => $title,
            'created_at' => now(),
            'updated_at' => now(),
            'body' => Purify::config('posts')->clean(fake()->randomHtml()),
            'user_id' => self::factoryForModel(User::class)->create()->id,
            'slug' => Str::slug($title),
        ];
    }
}
