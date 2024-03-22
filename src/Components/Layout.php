<?php

namespace Firefly\FilamentBlog\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    public function render()
    {
        return view('filament-blog::layouts.app');
    }
}
