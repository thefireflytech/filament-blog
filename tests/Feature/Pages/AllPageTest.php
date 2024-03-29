<?php

use function Pest\Laravel\get;

beforeEach(function () {
    \Firefly\FilamentBlog\Models\Setting::factory()->create();
});
it('return success for all post page', function () {
    get(route('filamentblog.post.all'))
        ->assertOk();
});
