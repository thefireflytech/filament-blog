<?php

namespace Firefly\FilamentBlog\Facades;

use Illuminate\Support\Facades\Facade;

class SEOMeta extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seometa';
    }
}
