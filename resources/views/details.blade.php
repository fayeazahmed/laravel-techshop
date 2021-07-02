@extends('layouts.app')

@section('title')
    Laravel TechShop | {{$product->title}}
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')
    <div class="product-details">
        <div>
            <h5 class="m-0 text-start">Product id #{{$product->id}}</h5>
            <img src="{{$product->image}}" alt="">
        </div>
        <div class="d-flex flex-column ms-2">
            <p class="">{{$product->title}}</p>
            <p>{{$product->description}}</p>
            <p>{{$product->price}} ৳</p>
            @if(!$product->in_stock) <button disabled class="btn btn-lg btn-outline-dark mt-auto">Stock out</button>
            @elseif (!in_array($product->id, $cart)) <a href="/cart/add/{{$product->id}}" class="btn btn-lg btn-outline-primary mt-auto">Add to cart</a>           
            @else <a href="/cart/remove/{{$product->id}}/1" class="btn btn-lg btn-outline-danger mt-auto">Already in cart</a> @endif
        </div>
    </div>
@endsection