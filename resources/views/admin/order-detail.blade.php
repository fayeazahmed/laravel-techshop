@extends('layouts.app')

@section('title')
    Laravel TechShop | Order #{{$order->id}}
@endsection

@section('content')
    <div class="admin__details">
        <h4>Order ID: {{$order->id}}</h4>
        <h4>Customer email: <a href="/admin/users/{{$order->user_id}}">{{$order->email}}</a></h4>
        <h4>Location: {{$order->location}}</h4>

        <h4 class="mt-4 mb-3">Ordered products:</h3>
        <div class="row ordered-products border-bottom mb-3">
            <div class="col-6">
                <p class="m-0">Product title</p>
            </div>
            <div class="col-2">
                <p class="m-0">Price</p>
            </div>
            <div class="col-2">
                <p class="m-0">Quantity</p>
            </div>
            <div class="col-2">
                <p class="m-0">In stock</p>
            </div>
        </div>
        @foreach ($products as $item)
            <div class="row ordered-products">
                <div class="col-6">
                    <p>{{$item->title}}</p>
                </div>
                <div class="col-2">
                    <p>{{$item->price}}</p>
                </div>
                <div class="col-2">
                    <p>{{$item->quantity}}</p>
                </div>
                <div class="col-2">
                    @if($item->in_stock) <i class="fa fa-check-circle-o text-success" aria-hidden="true"></i>
                    @else <i class="fa fa-times text-danger" aria-hidden="true"></i>   
                    @endif
                </div>
            </div>
        @endforeach
        <p class="text-end mt-2">Total: {{$order->total}}</p>
    </div>
@endsection