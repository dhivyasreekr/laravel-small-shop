@extends('frontend.layout.app')

@section('title', 'Order History')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Order History</h1>

    @if($history->isEmpty())
        <div class="alert alert-info" role="alert">
            You have no order history.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th> <!-- Counter column -->
                    <th scope="col">Status</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @php $counter = 1; @endphp <!-- Initialize counter -->
                @foreach($history as $order)
                    <tr>
                        <td>{{ $counter++ }}</td> <!-- Display counter and increment -->
                        <td>{{ ucfirst($order->order_status) }}</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>{{ $order->created_at->format('F j, Y') }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
