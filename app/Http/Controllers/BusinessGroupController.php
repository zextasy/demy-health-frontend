<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessGroupRequest;
use App\Http\Requests\UpdateBusinessGroupRequest;
use App\Models\BusinessGroup;

class BusinessGroupController extends Controller
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
     * @param  \App\Http\Requests\StoreBusinessGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessGroup  $businessGroup
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessGroup $businessGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessGroup  $businessGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessGroup $businessGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBusinessGroupRequest  $request
     * @param  \App\Models\BusinessGroup  $businessGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusinessGroupRequest $request, BusinessGroup $businessGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessGroup  $businessGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessGroup $businessGroup)
    {
        //
    }
}
