<?php

namespace FireFly\FilamentBlog\Database\Factories;

use App\Models\User;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->sentence(4),
            'slug' => Str::slug($title),
            'sub_title' => $this->faker->word(),
            'body' => $this->faker->text(),
            'status' => $this->faker->randomElement(['pending', 'published', 'scheduled']),
            'published_at' => $this->faker->dateTime(),
            'scheduled_for' => $this->faker->dateTime(),
            'cover_photo_path' => $this->faker->imageUrl(),
            'photo_alt_text' => $this->faker->word,
            'user_id' => User::factory(),
        ];
    }
}
