<?php

namespace FireFly\FilamentBlog\Components;

use FireFly\FilamentBlog\Models\Post;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('filament-blog::components.header');
    }
}
