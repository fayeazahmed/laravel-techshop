@extends('layouts.app')

@section('title')
    Laravel TechShop | Checkout
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')
    <div class="checkout">
        @if ($total == 0)
            <h3>Add some item to cart first</h3>
        @else
            <h3>Checking out</h3>
            <div class="row mt-4">
                <p class="col-3">Item total:</p>
                <p class="col-2">{{$total}}</p>
            </div>
            <div class="row">
                <p class="col-3">Delivery charge:</p>
                <p class="col-2">100</p>
            </div>
            <div class="row">
                <p class="col-3">Total bill:</p>
                <p class="col-2">{{$total + 100}}</p>
            </div>

            <form method="POST" action="/cart/checkout">
                @csrf
                <label for="location">Select your city and make sure detail address is correct</label>
                <select name="location" id="location">
                    <option value="Dhaka">Dhaka</option>
                    <option value="Chittagong">Chittagong</option>
                    <option value="Barisal">Barisal</option>
                </select>
                <input type="hidden" name="total" value="{{$total + 100}}">
                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                <div class="checkout__confirm">
                    <textarea placeholder="Add any note" name="note" id="note" cols="30" rows="10"></textarea>
                    <button class="btn btn-success btn-lg">Place order</button>
                </div>
            </form>
        @endif
    </div>
@endsection