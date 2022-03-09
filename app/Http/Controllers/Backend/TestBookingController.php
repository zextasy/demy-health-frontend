<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\StoreTestBookingRequest;
use App\Http\Requests\UpdateTestBookingRequest;
use App\Models\TestBooking;

class TestBookingController extends Controller
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
     * @param  \App\Http\Requests\StoreTestBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestBookingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Http\Response
     */
    public function show(TestBooking $testBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(TestBooking $testBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestBookingRequest  $request
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestBookingRequest $request, TestBooking $testBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestBooking  $testBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestBooking $testBooking)
    {
        //
    }
}
