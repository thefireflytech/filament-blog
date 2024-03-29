<?php

use Firefly\FilamentBlog\Models\Post;
use Illuminate\Database\Eloquent\Factories\Sequence;

use function Pest\Laravel\get;

beforeEach(function () {
    setSettingData();
});
it('show only published search post', function () {
    Post::factory()->published()->count(2)->state(new Sequence([
        'title' => 'First Post',
        'slug' => 'first-post',
    ], [
        'title' => 'Second Post',
        'slug' => 'second-post',
    ]))->create();
    get(route('filamentblog.post.search', ['query' => 'First Post']))
        ->assertSeeText('First Post')
        ->assertDontSee('Second Post');

});
