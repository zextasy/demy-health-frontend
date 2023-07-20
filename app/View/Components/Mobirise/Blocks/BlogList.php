<?php

namespace App\View\Components\Mobirise\Blocks;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class BlogList extends Component
{
    private Collection $blogPosts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $blogPosts)
    {
        $this->blogPosts = $blogPosts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        ray($this->blogPosts);
        return view('components.mobirise.blocks.blog-list', ['blogPosts' => $this->blogPosts]);
    }
}
