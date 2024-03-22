<?php

namespace Firefly\FilamentBlog\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BlogPublished
{
    use Dispatchable, SerializesModels;

    public mixed $post;

    public function __construct($post)
    {
        $this->post = $post;
    }
}
