@extends('frontend.layout.app')

@section('title')

Category page

@endsection

@section('content')

<div class="navbar">
        <a href="#fruits">Fruits</a>
        <a href="#vegetables">Vegetables</a>
        <a href="#dairy">Dairy</a>
        <a href="#bakery">Bakery</a>
    </div>

    <div id="fruits" class="container">
        <div class="category-card">
            <img src="fruits.jpg" alt="Fruits">
            <h3>Fruits</h3>
            <p>Explore a variety of fresh fruits.</p>
        </div>
    </div>

    <div id="vegetables" class="container">
        <div class="category-card">
            <img src="vegetables.jpg" alt="Vegetables">
            <h3>Vegetables</h3>
            <p>Discover a wide range of vegetables.</p>
        </div>
    </div>

    <div id="dairy" class="container">
        <div class="category-card">
            <img src="dairy.jpg" alt="Dairy">
            <h3>Dairy</h3>
            <p>Find the best dairy products.</p>
        </div>
    </div>

    <div id="bakery" class="container">
        <div class="category-card">
            <img src="bakery.jpg" alt="Bakery">
            <h3>Bakery</h3>
            <p>Enjoy our delicious bakery items.</p>
        </div>
    </div>

@endsection


