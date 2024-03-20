<?php

namespace FireFly\FilamentBlog\Tests;

use FireFly\FilamentBlog\FilamentBlogServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            FilamentBlogServiceProvider::class,
        ];
    }
}
