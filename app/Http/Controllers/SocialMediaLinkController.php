<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSocialMediaLinkRequest;
use App\Http\Requests\UpdateSocialMediaLinkRequest;
use App\Models\SocialMediaLink;

class SocialMediaLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSocialMediaLinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialMediaLinkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialMediaLink  $socialMediaLink
     * @return \Illuminate\Http\Response
     */
    public function show(SocialMediaLink $socialMediaLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialMediaLink  $socialMediaLink
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialMediaLink $socialMediaLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSocialMediaLinkRequest  $request
     * @param  \App\Models\SocialMediaLink  $socialMediaLink
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialMediaLinkRequest $request, SocialMediaLink $socialMediaLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialMediaLink  $socialMediaLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialMediaLink $socialMediaLink)
    {
        //
    }
}
