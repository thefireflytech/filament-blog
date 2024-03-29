<?php

namespace Firefly\FilamentBlog\Exceptions;

use Exception;

class CannotSendEmail extends Exception
{
    public static function postNotPublished()
    {
        return new self('The post is not published.');
    }
}
