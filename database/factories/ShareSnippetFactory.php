<?php

namespace Firefly\FilamentBlog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShareSnippet>
 */
class ShareSnippetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'script_code' => 'Please paste your script here.',
            'html_code' => 'Please paste your html here.',
            'active' => false,
        ];
    }
}
