<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderitems = OrderItem::orderBy('customer_id','asc')->get();

        $transforamedOrderItems =$orderitems->map(function($orderitem){

            return[
                'id'=>$orderitem->id,
                'order_id'=>$orderitem->name,
                'product_id' =>$orderitem->product_id,
                'qty'=>$orderitem->qty,
                'unit_price'=>$orderitem->unit_price,
                'amount'=> $orderitem->amount,
                'discount'=> $orderitem->discount,                            
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
    public function show(OrderItems $orderItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItems $orderItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItems $orderItems)
    {
        //
    }
}
