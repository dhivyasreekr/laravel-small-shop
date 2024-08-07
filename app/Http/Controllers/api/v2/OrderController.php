<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('customer_id','asc')->get();

        $transforamedOrders =$orders->map(function($order){

            return[
                'id'=>$order->id,
                'customer_name' => $order->customer->name,
                'order_number' =>$order->order_number,
                'order_date'=>$order->order_date,
                'total_amount'=>$order->total_amount,
                'order_status'=> $order->order_status,
                'payment_method'=> $order->payment_method,                            
            ];
        });

        return response()->json(['data' => $transforamedOrders],200);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
