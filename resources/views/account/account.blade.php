@extends('layouts.app')

@section('title')
    Laravel TechShop | {{$user->name}}
@endsection

@if (session()->has('message'))
    @section('message')
        <x-message :message="session()->get('message')" />
    @endsection
@endif

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')
    <div class="user">
        <div class="d-flex mb-3 align-items-center">
            <h3 class="m-0">Your account </h3>
            <a class="btn btn-primary ms-2" href="/account/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a class="btn btn-sm btn-dark ms-2" href="/change-password">Change password</a>
        </div>
        <div class="user__name row">
            <p class="col-2">Name</p>
            <p class="col-3">{{$user->name}}</p>
        </div>

        <div class="user__email row">
            <p class="col-2">Email</p>
            <p class="col-3">{{$user->email}}</p>
        </div>

        <div class="user__address row">
            <p class="col-2">Address</p>
            <p class="col-3">{{$user->address}}</p>
        </div>

        <div class="user__contact row">
            <p class="col-2">Contact</p>
            <p class="col-3">{{$user->contact}}</p>
        </div>

        <div class="mt-3">
            @if (count($orders) === 0)
                <h3>You have not ordered anything before</h3>
            @else
                @foreach ($orders as $order)
                    <a href="/account/orders/{{$order->id}}">
                        <div class="user__orders">
                            <div class="row">
                                <p class="col-3">Order id #{{$order->id}}</p>
                                <p class="col-6">Date: {{$order->created_at}}</p>
                            </div>
                            <div class="row">
                                <p class="col-3">Total: {{$order->total}}</p>
                                <p class="col-6">Notes: {{$order->note}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
@endsection