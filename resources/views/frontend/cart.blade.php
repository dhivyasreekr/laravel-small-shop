@extends('frontend.layout.app')

@section('title', 'Your Cart')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Your Cart</h1>

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($carts->isEmpty())
        <div class="alert alert-info" role="alert">
            Your cart is empty.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td>{{ $cart->product->name }}</td>
                        <td>${{ number_format($cart->product->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.decrease', $cart->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">-</button>
                            </form>

                            {{ $cart->qty }}

                            <form action="{{ route('cart.increase', $cart->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">+</button>
                            </form>
                            
                        </td>
                        <td>${{ number_format($cart->product->price * $cart->qty, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $cart->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Cart Summary -->
        <div class="d-flex justify-content-between mt-4">
            <h4>Total Amount:</h4>
            <h4>${{ number_format($carts->sum(fn($cart) => $cart->product->price * $cart->qty), 2) }}</h4>
        </div>

        <!-- Clear Cart Button -->
        <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger">Clear Cart</button>
        </form>

        <!-- Checkout Button -->
        <div class="mt-4">
            <!-- <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a> -->
             <!-- Clear Cart Button -->
            <form action="{{ route('checkout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-danger">Proceed to Checkout</button>
            </form>
        </div>
    @endif
</div>
@endsection
