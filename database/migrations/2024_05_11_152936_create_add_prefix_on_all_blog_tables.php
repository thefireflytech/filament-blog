<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up()
    {
        Schema::rename('posts', config('filamentblog.tables.prefix').'posts');
        Schema::rename('categories', config('filamentblog.tables.prefix').'categories');
        Schema::rename('category_post', config('filamentblog.tables.prefix').'category_'.config('filamentblog.tables.prefix').'post');
        Schema::rename('seo_details', config('filamentblog.tables.prefix').'seo_details');
        Schema::rename('comments', config('filamentblog.tables.prefix').'comments');
        Schema::rename('news_letters', config('filamentblog.tables.prefix').'news_letters');
        Schema::rename('tags', config('filamentblog.tables.prefix').'tags');
        Schema::rename('post_tag', config('filamentblog.tables.prefix').'post_'.config('filamentblog.tables.prefix').'tag');
        Schema::rename('share_snippets', config('filamentblog.tables.prefix').'share_snippets');
        Schema::rename('settings', config('filamentblog.tables.prefix').'settings');

        Schema::table(config('filamentblog.tables.prefix').'posts', function (Blueprint $table) {
            $table->foreignIdFor(config('filamentblog.user.model'), config('filamentblog.user.foreign_key'))
                ->change()
                ->constrained()
                ->cascadeOnDelete();
        });

        Schema::table(config('filamentblog.tables.prefix').'category_'.config('filamentblog.tables.prefix').'post', function (Blueprint $table) {
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class)
                ->change()
                ->constrained(config('filamentblog.tables.prefix').'posts')
                ->cascadeOnDelete();
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Category::class)
                ->change()
                ->constrained(config('filamentblog.tables.prefix').'categories')
                ->cascadeOnDelete();
        });

        Schema::table(config('filamentblog.tables.prefix').'seo_details', function (Blueprint $table) {
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class)
                ->change()
                ->constrained(config('filamentblog.tables.prefix').'posts')
                ->cascadeOnDelete();
        });

        Schema::table(config('filamentblog.tables.prefix').'comments', function (Blueprint $table) {
            $table->foreignIdFor(config('filamentblog.user.model'), config('filamentblog.user.foreign_key'))
                ->change()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class)
                ->change()
                ->constrained(config('filamentblog.tables.prefix').'posts')
                ->cascadeOnDelete();
        });

        Schema::table(config('filamentblog.tables.prefix').'post_'.config('filamentblog.tables.prefix').'tag', function (Blueprint $table) {
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Post::class)
                ->change()
                ->constrained(config('filamentblog.tables.prefix').'posts')
                ->cascadeOnDelete();
            $table->foreignIdFor(Firefly\FilamentBlog\Models\Tag::class)
                ->change()
                ->constrained(config('filamentblog.tables.prefix').'tags')
                ->cascadeOnDelete();
        });
    }
};
