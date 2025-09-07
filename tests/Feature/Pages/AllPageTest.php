<?php

use Firefly\FilamentBlog\Models\Setting;
use function Pest\Laravel\withoutExceptionHandling;
use function Pest\Laravel\get;

beforeEach(function () {
    $setting = Setting::factory()->create();
//    dd($setting);
});
it('return success for all post page', function () {
    withoutExceptionHandling();
    get(route('filamentblog.post.all'))
        ->assertOk();
});
