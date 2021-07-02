@extends('layouts.app')

@section('title')
    Laravel TechShop | {{$category}}
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li class="@if($c->title == $category) categories__selected @endif" >{{ $c->title }}</li></a>
@endforeach

@endsection

@if (session()->has('message'))
    @section('message')
        <x-message :message="session()->get('message')" />
    @endsection
@endif

@section('content')
    <div class="productsPage">
        <form method="POST" action="/products/{{$category}}">
            @csrf
            <div class="d-flex align-items-center">
                <input type="checkbox" name="instock" id="instock_input">
                <label class="ms-2 my-0" for="instock_input">In stock only</label>
                @if(old('maxval'))<a href="/products/{{$category}}"><i class="fa fa-times-circle" aria-hidden="true"></i></a>@endif
            </div>
            <label for="minval_input">Minimum price</label>
            <input class="d-block" value="{{old('minval', 0)}}" placeholder="0" id="minval_input" type="number" name="minval" required >
            <label for="maxval_input">Maximum price</label>
            <input class="d-block" value="{{old('maxval')}}" placeholder="10000" id="maxval_input" type="number" name="maxval" required >
            <input type="submit" hidden>
        </form>
        <div class="d-flex flex-column @if(count($products) == 0)w-75 @endif">
            <h3 class="ps-4">{{$category}}</h3>
            <div class="products">
                @if(count($products) == 0) <h3>Sorry, no products matching the filter</h3> @endif
                @foreach ($products as $product)
                    @if (in_array($product->id, $cart))
                        <x-product :in-stock="$product->in_stock" :id="$product->id" :title="$product->title" :image="$product->image" :description="$product->description" :price="$product->price" :in-cart="true" />
                    @else
                        <x-product :in-stock="$product->in_stock" :id="$product->id" :title="$product->title" :image="$product->image" :description="$product->description" :price="$product->price" :in-cart="false" />
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection