<?php

namespace Firefly\FilamentBlog\Tests;

use Firefly\FilamentBlog\FilamentBlogServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            FilamentBlogServiceProvider::class,
        ];
    }
}
