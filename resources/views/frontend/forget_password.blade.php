@extends('frontend.layout.app')

@section('title')

Forget Password

@endsection

@section('content')

<div class="container">

<h1>welcome To Forget Password Page</h1>

<form id="forgetPasswordForm" onsubmit="return validateForm()">

<div  class="input-group">

<label form="email">Email Address<label>

<input type="email" id="email" name="email" required>

</div>

<button type="submit" class="btn">Submit</button>

<div id="error-message" class="error-message"></div>

</form>

</div>

@endsection
