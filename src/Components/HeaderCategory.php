<?php

namespace Firefly\FilamentBlog\Components;

use Firefly\FilamentBlog\Models\Category;
use Illuminate\View\Component;

class HeaderCategory extends Component
{
    public function render()
    {
        return view('filament-blog::components.header-category', [
            'categories' => Category::all(),
        ]);
    }
}
