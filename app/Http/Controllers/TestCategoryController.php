<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestCategoryRequest;
use App\Http\Requests\UpdateTestCategoryRequest;
use App\Models\TestCategory;

class TestCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreTestCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestCategory  $testCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TestCategory $testCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestCategory  $testCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TestCategory $testCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestCategoryRequest  $request
     * @param  \App\Models\TestCategory  $testCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestCategoryRequest $request, TestCategory $testCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestCategory  $testCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestCategory $testCategory)
    {
        //
    }
}
