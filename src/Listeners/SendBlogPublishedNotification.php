<?php

namespace Firefly\FilamentBlog\Listeners;

use Firefly\FilamentBlog\Mails\BlogPublished;
use Firefly\FilamentBlog\Models\NewsLetter;
use Illuminate\Support\Facades\Mail;

class SendBlogPublishedNotification
{
    public function handle($event)
    {
        $subscribers = NewsLetter::subscribed()->get();

        foreach ($subscribers as $subscriber) {
            Mail::queue(new BlogPublished($event->post, $subscriber->email));
        }
    }
}
