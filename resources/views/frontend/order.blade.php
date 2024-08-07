@extends('frontend.layout.app')

@section('title')

Order page

@endsection

@section('content')

    <div class="container mt-5">
        <h1 class="mb-4">Your Orders</h1>

        @if ($orders->isEmpty())
            <div class="alert alert-info" role="alert">
                You have no orders yet.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $row)
                            <tr>
                                <td>{{ $row->order_number }}</td>
                                <td>{{ $row->order_date }}</td>
                                <td>{{ $row->total_amount }}</td>
                                <td>{{ $row->order_status }}</td>
                                <td>{{ $row->payment_method }}</td>
                                <td>
                                    <a href="{{ route('order.show', $row->id) }}" class="btn btn-info btn-sm">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection