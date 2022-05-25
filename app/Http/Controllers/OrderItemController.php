<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\OrderItem;

class OrderItemController extends Controller
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
     * @param  \App\Http\Requests\StoreOrderItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderItemRequest  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
