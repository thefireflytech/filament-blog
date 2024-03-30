<?php

use function Pest\Laravel\get;

beforeEach(function () {
    $setting = \Firefly\FilamentBlog\Models\Setting::factory()->create();
//    dd($setting);
});
it('return success for all post page', function () {
    \Pest\Laravel\withoutExceptionHandling();
    get(route('filamentblog.post.all'))
        ->assertOk();
});
