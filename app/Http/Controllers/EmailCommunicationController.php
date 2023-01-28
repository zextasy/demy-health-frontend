<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailCommunicationRequest;
use App\Http\Requests\UpdateEmailCommunicationRequest;
use App\Models\EmailCommunication;

class EmailCommunicationController extends Controller
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
     * @param  \App\Http\Requests\StoreEmailCommunicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmailCommunicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailCommunication  $emailCommunication
     * @return \Illuminate\Http\Response
     */
    public function show(EmailCommunication $emailCommunication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailCommunication  $emailCommunication
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailCommunication $emailCommunication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmailCommunicationRequest  $request
     * @param  \App\Models\EmailCommunication  $emailCommunication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmailCommunicationRequest $request, EmailCommunication $emailCommunication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailCommunication  $emailCommunication
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailCommunication $emailCommunication)
    {
        //
    }
}
