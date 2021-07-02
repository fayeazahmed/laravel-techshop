@extends('layouts.app')

@section('title')
    Laravel TechShop | Search
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')
    @if (count($products) === 0)
        <h4>Sorry no match, use correct keywords.</h4>
    @else
    <div class="products mt-2">
        @foreach ($products as $product)
            @if (in_array($product->id, $cart))
                <x-product :in-stock="$product->in_stock" :id="$product->id" :title="$product->title" :image="$product->image" :description="$product->description" :price="$product->price" :in-cart="true" />
            @else
                <x-product :in-stock="$product->in_stock" :id="$product->id" :title="$product->title" :image="$product->image" :description="$product->description" :price="$product->price" :in-cart="false" />
            @endif
        @endforeach
    </div>
    @endif
@endsection