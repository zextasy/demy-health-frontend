<?php

namespace App\View\Components\Mobirise\Blocks;

use App\Models\Blog\Post;
use Illuminate\View\Component;

class BlogPost extends Component
{
    private Post $blogPost;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Post $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.mobirise.blocks.blog-post', ['blogPost' => $this->blogPost]);
    }
}
