<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get the table name and column name from configuration
        $tableName = resolve(config('filamentblog.user.model'))->getTable();
        $columnName = config('filamentblog.user.columns.avatar');

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 155)->unique();
            $table->string('slug', 155)->unique();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('sub_title')->nullable();
            $table->longText('body');
            $table->enum('status', ['published', 'scheduled', 'pending'])->default('pending');
            $table->dateTime('published_at')->nullable();
            $table->dateTime('scheduled_for')->nullable();
            $table->string('cover_photo_path');
            $table->string('photo_alt_text');
            $table->foreignId(config('filamentblog.user.foreign_key'));
            $table->timestamps();
        });

        Schema::create('category_post', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class);
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Category::class);
            $table->timestamps();
        });

        Schema::create('seo_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class);
            $table->string('title');
            $table->json('keywords')->nullable();
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId(config('filamentblog.user.foreign_key'));
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class);
            $table->text('comment');
            $table->boolean('approved')->default(false);
            $table->dateTime('approved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('news_letters', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->unique();
            $table->boolean('subscribed')->default(true);
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug', 155)->unique();
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class);
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Tag::class);
            $table->timestamps();
        });


// Check if the column exists
        if (!Schema::hasColumn($tableName, $columnName)) {
            // Column doesn't exist, so add it to the table
            Schema::table($tableName, function (Blueprint $table) use ($columnName) {
                $table->string($columnName)->nullable();
            });
        }

        Schema::create('share_snippets', function (Blueprint $table) {
            $table->id();
            $table->longText('script_code');
            $table->text('html_code');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 155)->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('organization_name')->nullable();
            $table->tinyText('google_console_code')->nullable();
            $table->text('google_analytic_code')->nullable();
            $table->tinyText('google_adsense_code')->nullable();
            $table->json('quick_links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists(config('filamentblog.user.model'));
        Schema::dropIfExists('posts');
        Schema::dropIfExists('category_post');
        Schema::dropIfExists('seo_details');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('news_letters');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('share_snippets');
        Schema::dropIfExists('settings');
    }
};
