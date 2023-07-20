<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunicationRequest;
use App\Http\Requests\UpdateCommunicationRequest;
use App\Models\Communication\Communication;

class CommunicationController extends Controller
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
     * @param  \App\Http\Requests\StoreCommunicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Communication\Communication  $communication
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Communication $communication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Communication\Communication  $communication
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Communication $communication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommunicationRequest  $request
     * @param \App\Models\Communication\Communication  $communication
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunicationRequest $request, Communication $communication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Communication\Communication  $communication
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Communication $communication)
    {
        //
    }
}
