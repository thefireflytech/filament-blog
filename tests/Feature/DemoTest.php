<?php

namespace FireFly\FilamentBlog\Tests\Feature;

use FireFly\FilamentBlog\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DemoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_route()
    {
        $this->withoutExceptionHandling();
        $this->get(route('post.index'))->assertOk();
    }
}
