<?php

namespace FireFly\FilamentBlog;

use FireFly\FilamentBlog\Events\BlogPublished;
use FireFly\FilamentBlog\Listeners\SendBlogPublishedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BlogPublished::class => [
            SendBlogPublishedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
