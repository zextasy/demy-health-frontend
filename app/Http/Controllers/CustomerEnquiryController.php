<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEnquiryRequest;
use App\Http\Requests\UpdateCustomerEnquiryRequest;
use App\Models\CRM\CustomerEnquiry;

class CustomerEnquiryController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerEnquiryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEnquiryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CRM\CustomerEnquiry  $customerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEnquiry $customerEnquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CRM\CustomerEnquiry  $customerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerEnquiry $customerEnquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEnquiryRequest  $request
     * @param  \App\Models\CRM\CustomerEnquiry  $customerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEnquiryRequest $request, CustomerEnquiry $customerEnquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CRM\CustomerEnquiry  $customerEnquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEnquiry $customerEnquiry)
    {
        //
    }
}
