<?php

namespace FireFly\FilamentBlog\Database\Seeders;

use FireFly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Database\Seeder;

class ShareSnippetSeeder extends Seeder
{
    public function run(): void
    {
        ShareSnippet::factory()->create();
    }
}
