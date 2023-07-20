<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSmsCommunicationRequest;
use App\Http\Requests\UpdateSmsCommunicationRequest;
use App\Models\SmsCommunication;

class SmsCommunicationController extends Controller
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
     * @param  \App\Http\Requests\StoreSmsCommunicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSmsCommunicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmsCommunication  $smsCommunication
     * @return \Illuminate\Http\Response
     */
    public function show(SmsCommunication $smsCommunication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmsCommunication  $smsCommunication
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsCommunication $smsCommunication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSmsCommunicationRequest  $request
     * @param  \App\Models\SmsCommunication  $smsCommunication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSmsCommunicationRequest $request, SmsCommunication $smsCommunication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmsCommunication  $smsCommunication
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsCommunication $smsCommunication)
    {
        //
    }
}
