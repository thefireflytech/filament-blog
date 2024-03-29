<?php

use function Pest\Laravel\get;

it('return success for all post page', function () {
    get(route('filamentblog.post.all'))
        ->assertOk();
});
