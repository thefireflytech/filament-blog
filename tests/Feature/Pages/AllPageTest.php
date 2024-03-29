<?php

use function Pest\Laravel\get;

beforeEach(function () {
   setSettingData();
});
it('return success for all post page', function () {
    get(route('filamentblog.post.all'))
        ->assertOk();
});
