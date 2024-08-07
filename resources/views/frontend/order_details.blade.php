@extends('frontend.layout.app')

@section('title', 'Order Details')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Order Details</h1>

    <!-- Order Summary -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Order #{{ $order->id }}</h5>
            <p class="card-subtitle mb-2 text-muted">Order Date: {{ $order->created_at->format('F j, Y') }}</p>
        </div>
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">Customer Information</h6>
            <p class="card-text">Name: {{ $order->customer->name }}</p>
            <p class="card-text">Email: {{ $order->customer->email }}</p>
            <p class="card-text">Address: {{ $order->customer->address }}</p>
            
            <h6 class="card-subtitle mb-2 text-muted">Order Summary</h6>
            <p class="card-text">Total Amount: ${{ number_format($order->total_amount, 2) }}</p>
            <p class="card-text">Status: <span class="badge bg-{{ $order->order_status === 'ORDER PLACED' ? 'success' : 'warning' }}">{{ ucfirst($order->status) }}</span></p>
        </div>
    </div>

    <!-- Order Items Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Order Items</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>${{ number_format($item->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-4">
        <a href="{{ route('order.index') }}" class="btn btn-primary">Back to Orders</a>
        <!-- Additional actions like printing or emailing the invoice can go here -->
    </div>
</div>
@endsection
