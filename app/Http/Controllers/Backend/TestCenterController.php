<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\StoreTestCenterRequest;
use App\Http\Requests\UpdateTestCenterRequest;
use App\Models\TestCenter;

class TestCenterController extends Controller
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
     * @param  \App\Http\Requests\StoreTestCenterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestCenterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestCenter  $testCenter
     * @return \Illuminate\Http\Response
     */
    public function show(TestCenter $testCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestCenter  $testCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(TestCenter $testCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestCenterRequest  $request
     * @param  \App\Models\TestCenter  $testCenter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestCenterRequest $request, TestCenter $testCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestCenter  $testCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestCenter $testCenter)
    {
        //
    }
}
