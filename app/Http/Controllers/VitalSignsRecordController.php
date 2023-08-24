<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVitalSignsRecordRequest;
use App\Http\Requests\UpdateVitalSignsRecordRequest;
use App\Models\VitalSignsRecord;

class VitalSignsRecordController extends Controller
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
     * @param  \App\Http\Requests\StoreVitalSignsRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVitalSignsRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VitalSignsRecord  $vitalSignsRecord
     * @return \Illuminate\Http\Response
     */
    public function show(VitalSignsRecord $vitalSignsRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VitalSignsRecord  $vitalSignsRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(VitalSignsRecord $vitalSignsRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVitalSignsRecordRequest  $request
     * @param  \App\Models\VitalSignsRecord  $vitalSignsRecord
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVitalSignsRecordRequest $request, VitalSignsRecord $vitalSignsRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VitalSignsRecord  $vitalSignsRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(VitalSignsRecord $vitalSignsRecord)
    {
        //
    }
}
