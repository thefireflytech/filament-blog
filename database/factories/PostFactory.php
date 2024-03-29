<?php

namespace Firefly\FilamentBlog\Database\Factories;

use Carbon\Carbon;
use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\User;
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
            'status' => PostStatus::PENDING,
            'published_at' => $this->faker->dateTime(),
            'scheduled_for' => $this->faker->dateTime(),
            'cover_photo_path' => $this->faker->imageUrl(),
            'photo_alt_text' => $this->faker->word,
            'user_id' => User::factory(),
        ];
    }

    public function published(?Carbon $date = null): PostFactory
    {
        return $this->state(fn ($attribute) => [
            'status' => PostStatus::PUBLISHED,
            'published_at' => $date ?? Carbon::now(),
        ]);
    }

    public function pending(): PostFactory
    {
        return $this->state(fn ($attribute) => [
            'status' => PostStatus::PENDING,
        ]);
    }

    public function scheduled(?Carbon $date = null): PostFactory
    {
        return $this->state(fn ($attribute) => [
            'status' => PostStatus::SCHEDULED,
            'scheduled_for' => $date ?? Carbon::now(),
        ]);
    }
}
