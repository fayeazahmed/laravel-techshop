@extends('layouts.app')

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')
    <div class="user">
        <form class="auth-form" action="/account/edit" method="post">
            @csrf
            <input class="form-control mt-3" placeholder="Your name" value="{{$user->name}}" name="name" type="text">
            <input class="form-control mt-3" placeholder="Your email" value="{{old('email', $user->email)}}" name="email" type="email">
            <input class="form-control mt-3" placeholder="Full address" value="{{$user->address}}" name="address" type="text">
            <input class="form-control mt-3" placeholder="Contact number" value="{{$user->contact}}" name="contact" type="text">
            <input class="btn btn-lg btn-success w-100 mt-3" type="submit" value="Save">
        </form>
    </div>

    @if ($errors->any())
    <ul class="form-errors">
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
@endsection