<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocalGovernmentAreaRequest;
use App\Http\Requests\UpdateLocalGovernmentAreaRequest;
use App\Models\LocalGovernmentArea;

class LocalGovernmentAreaController extends Controller
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
     * @param  \App\Http\Requests\StoreLocalGovernmentAreaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocalGovernmentAreaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LocalGovernmentArea  $localGovernmentArea
     * @return \Illuminate\Http\Response
     */
    public function show(LocalGovernmentArea $localGovernmentArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocalGovernmentArea  $localGovernmentArea
     * @return \Illuminate\Http\Response
     */
    public function edit(LocalGovernmentArea $localGovernmentArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocalGovernmentAreaRequest  $request
     * @param  \App\Models\LocalGovernmentArea  $localGovernmentArea
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocalGovernmentAreaRequest $request, LocalGovernmentArea $localGovernmentArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocalGovernmentArea  $localGovernmentArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocalGovernmentArea $localGovernmentArea)
    {
        //
    }
}
