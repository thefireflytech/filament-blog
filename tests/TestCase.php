<?php

namespace Firefly\FilamentBlog\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Firefly\FilamentBlog\FilamentBlogServiceProvider;
use Firefly\FilamentBlog\Tests\Models\TestUser;
use Illuminate\Support\Str;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            FilamentBlogServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('filamentblog.tables.prefix', 'fblog_');
        $app['config']->set('filamentblog.user.model', TestUser::class); 
        $app['config']->set('filamentblog.user.foreign_key', 'user_id');
        $app['config']->set('filamentblog.user.columns.avatar', 'avatar');
    }

    protected function setUp(): void
    {
        parent::setUp();

        if (!method_exists(Str::class, 'sanitizeHtml')) {
            Str::macro('sanitizeHtml', function ($html) {
                return $html;
            });
        }

        $this->artisan('migrate');
        
        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--path' => realpath(__DIR__ . '/database/migrations'),
            '--realpath' => true
        ]);
    }
}