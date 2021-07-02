@extends('layouts.app')

@section('title')
    Laravel TechShop | Login
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@if (session()->has('message'))
    @section('message')
        <x-message :message="session()->get('message')" />
    @endsection
@endif

@section('content')    
<form class="auth-form" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mt-4">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" id="email" required autofocus value="{{old('email')}}" >
    </div>
    
    <div class="mt-4">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="password" name="password"  autocomplete="current-password">
    </div>
    
    <div class="mt-4 d-flex align-items-center">
        <label for="remember_me">Remember me</label>
        <input id="remember_me" class="ms-2" type="checkbox" name="remember_me">
        <button class="btn btn-primary">
            {{ __('Log in') }}
        </button>
    </div>
    
</form>
<div class="mt-2 form-link">
    <a href="/register">Don't have an account? Create now</a>
</div>

@if ($errors->any())
    <ul class="form-errors">
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    </ul>
@endif
@endsection