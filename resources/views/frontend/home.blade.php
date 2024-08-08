@extends('frontend/layout/app')

@section('title')

Home Page

@endsection


@section('content')


<div class="container mt-4">

    <!-- Search and Filter Form -->

    <form method="GET" action="{{ route('home.index') }}" class="mb-4">
        
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request()->input('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="All" {{ request()->input('category') == 'All' ? 'selected' : '' }}>All Categories</option>            
                    @foreach($categories as $row)
                        <option value="{{ $row->id }}" {{ request()->input('row') == $row->name ? 'selected' : '' }}>
                            {{ $row->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach ($product as $item)
            <div class="col-md-4 mb-4">
                <a href="/products/{{ $item->id }}">
                    <div class="card">
                        <img src="{{ $item->GetImagePath() }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><strong>${{ $item->price }}</strong></p>
                            <a href="/cart" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@endsection