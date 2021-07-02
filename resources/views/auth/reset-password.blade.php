@extends('layouts.app')

@section('title')
    Laravel TechShop | Change Password
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')    
<form class="auth-form" method="POST" action="{{ route('password.update') }}">
    @csrf
    <div class="mt-4">
        <label for="old_password">Old Password</label>
        <input type="password" class="form-control" name="old_password" id="old_password" autofocus value="{{old('oldPassword')}}" required >
    </div>
    <div class="mt-4">
        <label for="password">New Password</label>
        <input id="email" class="form-control" type="password" name="password" value="{{old('password')}}" required >
    </div>
    
    <div class="mt-4">
        <label for="password_confirmation">Confirm Password (Again)</label>
        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required" >
    </div>
    
    <div class="mt-4 d-flex align-items-center">
        <button class="btn btn-primary">
            {{ __('Change') }}
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
