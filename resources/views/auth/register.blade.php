@extends('layouts.app')

@section('title')
    Laravel TechShop | Register
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')    
<form class="auth-form" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mt-4">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" autofocus value="{{old('name')}}" required >
    </div>
    <div class="mt-4">
        <label for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email" value="{{old('email')}}" required >
    </div>
    
    <div class="mt-4">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" >
    </div>

    <div class="mt-4">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="current-password" >
    </div>

    <div class="mt-4">
        <label for="contact">Contact Number</label>
        <input id="contact" class="form-control" type="text" name="contact" required value="{{old('contact')}}" autocomplete="mobile" >
    </div>
    <div class="mt-4">
        <label for="address">Address</label>
        <input id="address" class="form-control" type="text" name="address" required value="{{old('address')}}" autocomplete="address" >
    </div>
    
    <div class="mt-4 d-flex align-items-center">
        <a style="text-decoration:underline" href="/login">Already registered?</a>
        <button class="btn btn-primary">
            {{ __('Sign up') }}
        </button>
    </div>
</form>

@if ($errors->any())
    <ul class="form-errors">
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif
@endsection