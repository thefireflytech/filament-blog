<?php

use FireFly\FilamentBlog\Http\Controllers\PostController;
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
    });
