@extends('frontend.layout.app')

@section('title')

Role Nmae

@endsection

@section('content')

<div class="container">
        <h1>Welcome To Role Page</h1>
        <form id="roleForm">
            <div class="form-group">
                <label for="roleName">Role Name:</label>
                <input type="text" id="roleName" name="roleName">
                <div id="roleNameError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <div id="emailError" class="error"></div>
            </div>
            <button type="submit">Add Role</button>
        </form>
        <div class="category-list">
            <div class="category-item">Category 1</div>
            <div class="category-item">Category 2</div>
            <div class="category-item">Category 3</div>
            <div class="category-item">Category 4</div>
        </div>
    </div>
@endsection


