<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts = Post::published()->with(['author','tags','category'])->latest()->get();
        $data['blogPosts'] = $blogPosts;
        return view('frontend.blog-posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO fix route and controller to exclude invalid actions
        return redirect(route('home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactDetail  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(Post $blogPost)
    {

        return view('frontend.blog-posts.show', ['blogPost' => $blogPost]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactDetail  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $blogPost)
    {
        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactDetailRequest  $request
     * @param  \App\Models\ContactDetail  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $blogPost)
    {
        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactDetail  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $blogPost)
    {
        return redirect(route('home'));
    }
}
