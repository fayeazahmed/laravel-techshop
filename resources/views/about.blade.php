@extends('layouts.app')

@section('title')
    Laravel TechShop | About
@endsection

@section('category')

@foreach ($categories as $c)
    <a href="/products/{{$c->title}}"><li>{{ $c->title }}</li></a>
@endforeach

@endsection

@section('content')
    <div class="about">
        <p>
            Hello, this is Ahmed. It's a personal project e-commerce app. I learnt building similar website before, 
            but now the main focus was to create a full functioning admin dashboard.<br>
            So the customer end works in the regular way. You create account, add products to cart and checkout. 
            There are category wise product pages and options to filter by price. There is account page to edit user info and see all order details.<br>
            In admin area, you can create new categories and add new products. Existing categories and products can be modified or deleted. 
            Also the details of all orders and users can be seen. Admin can add or remove from the list of featured products to feature in homepage.<br>
            All product data is scraped from <a href="https://www.startech.com.bd/">StarTech</a>.
        </p>
    </div>
@endsection