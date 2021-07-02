@extends('layouts.app')

@section('title')
    Laravel TechShop | Cart
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')
    @if (count($cart) == 0)
        <h4>There is no item in your cart, continue shopping</h4>
    @else
        <div class="cart container">
            <div class="row">
                <p class="m-0 col-2">Image</p>
                <p class="m-0 col-4">Product name</p>
                <p class="m-0 col-2">Qty</p>
                <p class="m-0 col-2">Price</p>
                <p class="m-0 col-2">Total</p>
            </div>
            @foreach ($cart as $c)
                <div class="cart__item card">
                    <img src="{{$c->image}}" alt="">
                    <p class="cart__title">{{$c->title}}</p>
                    <div class="cart__qty">
                        <a href="/cart/add/{{$c->id}}"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
                        <p>{{$c->quantity}}</p>
                        <a href="/cart/remove/{{$c->id}}/0"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    </div>
                    <p class="cart__price">{{$c->price}}</p>
                    <p class="cart__total">{{$c->price * $c->quantity}}.00</p>
                </div>
            @endforeach

            <div class="cart__checkout">
                <p>Total: {{$total}}</p>
                <a href="/cart/checkout" class="btn btn-success btn-lg" >Checkout</a>
            </div>
        </div>
    @endif
@endsection