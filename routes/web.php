<?php

use Firefly\FilamentBlog\Http\Controllers\CategoryController;
use Firefly\FilamentBlog\Http\Controllers\CommentController;
use Firefly\FilamentBlog\Http\Controllers\PostController;
use Firefly\FilamentBlog\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(config('filamentblog.route.middleware'))
    ->prefix(config('filamentblog.route.prefix'))
    ->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('filamentblog.post.index');
        Route::get('/all', [PostController::class, 'allPosts'])->name('filamentblog.post.all');
        Route::get('/search', [PostController::class, 'search'])->name('filamentblog.post.search');
        Route::get('/{post:slug}', [PostController::class, 'show'])->name('filamentblog.post.show');
        Route::post('/subscribe', [PostController::class, 'subscribe'])
            ->middleware('throttle:5,1')
            ->name('filamentblog.post.subscribe');

        Route::get('/categories/{category:slug}', [CategoryController::class, 'posts'])->name('filamentblog.category.post');
        Route::get('/tags/{tag:slug}', [TagController::class, 'posts'])->name('filamentblog.tag.post');

        Route::post('/posts/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth')->name('filamentblog.comment.store');

        Route::get('/login', function () {
            redirect(\route(config('filamentblog.route.login.name')));
        })->name('filamentblog.post.login');

    });
