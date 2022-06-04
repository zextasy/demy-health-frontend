<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactDetailRequest;
use App\Http\Requests\UpdateContactDetailRequest;
use App\Models\ContactDetail;

class ContactDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreContactDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ContactDetail $contactDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactDetail $contactDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactDetailRequest  $request
     * @param  \App\Models\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactDetailRequest $request, ContactDetail $contactDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactDetail  $contactDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactDetail $contactDetail)
    {
        //
    }
}
