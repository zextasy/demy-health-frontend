<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReferralChannelRequest;
use App\Http\Requests\UpdateReferralChannelRequest;
use App\Models\ReferralChannel;

class ReferralChannelController extends Controller
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
     * @param  \App\Http\Requests\StoreReferralChannelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReferralChannelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReferralChannel  $referralChannel
     * @return \Illuminate\Http\Response
     */
    public function show(ReferralChannel $referralChannel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReferralChannel  $referralChannel
     * @return \Illuminate\Http\Response
     */
    public function edit(ReferralChannel $referralChannel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReferralChannelRequest  $request
     * @param  \App\Models\ReferralChannel  $referralChannel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReferralChannelRequest $request, ReferralChannel $referralChannel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReferralChannel  $referralChannel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferralChannel $referralChannel)
    {
        //
    }
}
