<?php

namespace FireFly\FilamentBlog\Database\Factories;

use App\Models\User;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\SeoDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeoDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SeoDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $keywords = $this->faker->randomElements(SeoDetail::KEYWORDS, 3);

        return [
            'post_id' => Post::factory(),
            'title' => $this->faker->sentence(4),
            'keywords' => $keywords,
            'description' => $this->faker->paragraph,
            'user_id' => User::factory(),
        ];
    }
}
