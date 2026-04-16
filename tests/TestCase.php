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

        /**
            * Basic User Model for testing (should be in tests/Models/TestUser.php)
            *
            *   use Firefly\FilamentBlog\Traits\HasBlog, HasFactory;
            *   protected $table = 'users';    
            *   protected $fillable = ['name', 'email', 'password', 'profile_photo_path'];

            *   protected static function newFactory()
            *    {
            *       return Firefly\FilamentBlog\Database\Factories\UserFactory::new();
            *   }
         */

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

        /**
         * Execute package migrations.
         *
         * Ensure the following migration files exist in `tests/database/migrations/`:
         * - `2024_05_11_152920_create_users_tables.php` – creates `users`, `password_reset_tokens`, and `sessions` tables.
         * - `2024_05_11_152930_create_blog_tables.php` – converted from the stub file `database/migrations/create_blog_tables.php.stub`
         *   (rename the stub to a timestamped `.php` file and place it in the test migrations directory).
         */
        
        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--path' => realpath(__DIR__ . '/database/migrations'),
            '--realpath' => true
        ]);
    }
}