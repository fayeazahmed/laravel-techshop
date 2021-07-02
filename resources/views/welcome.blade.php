@extends('layouts.app')

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

    <div class="welcome">
        <h3>FEATURED</h3>
        <div class="products">
            @foreach ($products as $product)
                @if (in_array($product->product_id, $cart))
                    <x-product :in-stock="$product->in_stock" :id="$product->product_id" :title="$product->title" :image="$product->image" :description="$product->description" :price="$product->price" :in-cart="true" />
                @else
                    <x-product :in-stock="$product->in_stock" :id="$product->product_id" :title="$product->title" :image="$product->image" :description="$product->description" :price="$product->price" :in-cart="false" />
                @endif
            @endforeach
        </div>
    </div>

@endsection