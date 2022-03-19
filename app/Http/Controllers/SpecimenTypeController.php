<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecimenTypeRequest;
use App\Http\Requests\UpdateSpecimenTypeRequest;
use App\Models\SpecimenType;

class SpecimenTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreSpecimenTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecimenTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function show(SpecimenType $specimenType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecimenType $specimenType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpecimenTypeRequest  $request
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecimenTypeRequest $request, SpecimenType $specimenType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecimenType  $specimenType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecimenType $specimenType)
    {
        //
    }
}
