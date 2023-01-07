<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVirtualFieldRequest;
use App\Http\Requests\UpdateVirtualFieldRequest;
use App\Models\VirtualField;

class VirtualFieldController extends Controller
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
     * @param  \App\Http\Requests\StoreVirtualFieldRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVirtualFieldRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Http\Response
     */
    public function show(VirtualField $virtualField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Http\Response
     */
    public function edit(VirtualField $virtualField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVirtualFieldRequest  $request
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVirtualFieldRequest $request, VirtualField $virtualField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VirtualField  $virtualField
     * @return \Illuminate\Http\Response
     */
    public function destroy(VirtualField $virtualField)
    {
        //
    }
}
