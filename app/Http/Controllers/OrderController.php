<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderHistory;

use App\Enums\OrderStatus;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        $customer_id = $user->id;

        $orders = Order::where('customer_id', $customer_id)
                ->orderBy('id', 'asc')
                ->get();
            
        return view('frontend/order',compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id',$id)
                ->orderBy('id', 'asc')
                ->first();

        return view('frontend/order_details',compact('order'));
    }
    
    public function checkout(Request $request)
    {
        $user = Auth::user();

        // dd($user);

        // Retrieve cart items
        // $cartItems = $customer->cartItems()->get();
        $cartItems = Cart::where('customer_id', $user->id)->get();

        // dd($cartItems);

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Begin transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Create an order
            $order = Order::create([
                'customer_id' => $user->id,
                'total_amount' => $cartItems->sum(fn($cart) => $cart->product->price * $cart->qty),
                'order_status' => OrderStatus::ORDER_PLACED, // or 'created', depending on your workflow
            ]);

            // Store order items
            foreach ($cartItems as $row) {
                $order->orderItems()->create([
                    'product_id' => $row->product_id,
                    'qty' => $row->qty,
                    'unit_price' => $row->product->price,
                    'amount' => $row->qty * $row->product->price
                ]);
            }

            // Clear the cart
            $user->cartItems()->delete();

            // Commit transaction
            DB::commit();

            // Redirect to payment gateway or order confirmation
            return redirect()->route('order.confirmation', ['order' => $order->id])
                            ->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollback();
            // throw new \Exception('Something went wrong.');
            throw new \Exception($e);
            // return redirect()->route('cart.index')->with('error', 'Something went wrong. Please try again.' . $e);
        }
    }

    public function confirmation(Request $request)
    {
        $user = Auth::user();

        $order = Order::where('customer_id', $user->id)->first();

        // dd($order);

        return view('frontend/order_confirmation', compact('order'));
    }

    public function order_history($id)
    {
        $history = OrderHistory::where('order_id', $id)->get();

        // dd($history);

        return view('frontend/order_history',compact('history'));
    }
}
