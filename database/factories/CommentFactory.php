<?php

namespace FireFly\FilamentBlog\Database\Factories;

use App\Models\User;
use Firefly\FilamentBlog\Models\Comment;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'comment' => $this->faker->text(),
            'approved' => $this->faker->boolean(),
        ];
    }
}
