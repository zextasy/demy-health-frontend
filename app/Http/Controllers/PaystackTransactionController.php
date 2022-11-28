<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaystackTransactionRequest;
use App\Http\Requests\UpdatePaystackTransactionRequest;
use App\Models\Finance\PaystackTransaction;

class PaystackTransactionController extends Controller
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
     * @param  \App\Http\Requests\StorePaystackTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaystackTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Finance\PaystackTransaction  $paystackTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(PaystackTransaction $paystackTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Finance\PaystackTransaction  $paystackTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(PaystackTransaction $paystackTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaystackTransactionRequest  $request
     * @param  \App\Models\Finance\PaystackTransaction  $paystackTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaystackTransactionRequest $request, PaystackTransaction $paystackTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Finance\PaystackTransaction  $paystackTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaystackTransaction $paystackTransaction)
    {
        //
    }
}
