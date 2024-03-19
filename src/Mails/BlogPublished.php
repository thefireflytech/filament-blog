<?php

namespace FireFly\FilamentBlog\Mails;

use FireFly\FilamentBlog\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class BlogPublished extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Post $post)
    {
    }

    public function content(): Content
    {
        return new Content(
            view: 'filament-blog::mails.blog-published',
            with: ['post' => $this->post],
        );
    }
}
