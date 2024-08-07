@extends('frontend.layout.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Order Confirmation</h1>

    <div class="alert alert-success" role="alert">
        Your order has been placed successfully!
    </div>

    <h3>Order Details</h3>
    <ul class="list-unstyled">
        <li><strong>Order ID:</strong> {{ $order->id }}</li>
        <li><strong>Date:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</li>
        <li><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</li>
        <li><strong>Status:</strong> {{ ucfirst($order->order_status) }}</li>
    </ul>

    <h3 class="mt-4">Order Items</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $row)
                <tr>
                    <td>{{ $row->product->name }}</td>
                    <td>{{ $row->qty }}</td>
                    <td>${{ number_format($row->unit_price, 2) }}</td>
                    <td>${{ number_format($row->unit_price * $row->qty, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Optional: Link to go back to shop or order history -->
    <div class="mt-4">
        <a href="{{ route('home.index') }}" class="btn btn-primary">Continue Shopping</a>
        <a href="{{ route('order.history', ['id' => $order->id]) }}" class="btn btn-secondary">View Order History</a>
        <a href="{{ route('invoice.stream-pdf', ['id' => $order->id]) }}" target="_blank" class="btn btn-secondary">View Invoice</a>
    </div>
</div>
@endsection
