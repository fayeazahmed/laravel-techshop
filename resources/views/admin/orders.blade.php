@extends('layouts.app')

@section('title')
    Laravel TechShop | Orders
@endsection

@section('content')
    <div class="admin__details">
        <form action="/admin/orders" method="post" class="location-filter-form text-start mb-4">
            @csrf
            <label for="location">Filter by location: </label>
            <select class="form-control mt-1" name="location" id="location" >
                <option @if($location == "Dhaka") selected @endif value="Dhaka">Dhaka</option>
                <option @if($location == "Chittagong") selected @endif value="Chittagong">Chittagong</option>
                <option @if($location == "Barisal") selected @endif value="Barisal">Barisal</option>
            </select>
        </form>

        @foreach ($orders as $order)
            <a href="/admin/orders/{{$order->id}}">
                <div class="admin__items">
                    <p>{{$order->location}}</p>
                    <p>{{$order->total}}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection