<?php

use FireFly\FilamentBlog\Http\Controllers\CategoryController;
use FireFly\FilamentBlog\Http\Controllers\CommentController;
use FireFly\FilamentBlog\Http\Controllers\PostController;
use FireFly\FilamentBlog\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('filamentblog.route.middleware'))
    ->prefix(config('filamentblog.route.prefix'))
    ->group(function () {

        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/all', [PostController::class, 'allPosts'])->name('post.all');
        Route::get('/search', [PostController::class, 'search'])->name('post.search');
        Route::get('/{post:slug}', [PostController::class, 'show'])->name('post.show');
        Route::post('/subscribe', [PostController::class, 'subscribe'])
            ->middleware('throttle:5,1')
            ->name('post.subscribe');

        Route::get('/categories/{category:slug}', [CategoryController::class, 'posts'])->name('category.post');
        Route::get('/tags/{tag:slug}', [TagController::class, 'posts'])->name('tag.post');

        Route::post('/posts/{post:slug}/comment', [CommentController::class, 'store'])->name('comment.store');

    });
Route::get('test', function () {
    return 'test';
})->name('test');
