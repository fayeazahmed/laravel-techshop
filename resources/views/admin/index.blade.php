@extends('layouts.app')

@section('title')
    Laravel TechShop | Admin
@endsection

@section('content')
    <div class="admin">
        <div class="row">
            <h3 class="col-3 bg-secondary text-white">Users</h3>
            <h3 class="col-3 bg-secondary text-white">Categories</h3>
            <h3 class="col-3 bg-secondary text-white">Products</h3>
            <h3 class="col-3 bg-secondary text-white">Orders</h3>
        </div>
        
        <div class="admin__content row mt-2">
            <div class="col-3">
                @foreach ($users as $user)
                    <a href="/admin/users/{{$user->id}}">
                        <div class="admin__items">
                            <p>{{$user->name}}</p>
                            <p>{{$user->email}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-3">
                <p class="delete-warning">
                    Warning! Clicking delete once will permanently delete the category and its associated products
                </p>
                @foreach ($categories as $c)
                    <div class="admin__items admin__items--category">
                        <form action="/admin/categories/{{$c->id}}" method="post">
                            @csrf
                            @method('patch')
                            <input name="title" disabled type="text" value="{{$c->title}}" >
                            <div class="buttons">
                                <button class="btn btn-warning btn-sm" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                <button class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                @endforeach
                <form class="admin__items admin__items--category" action="/admin/categories/0" method="post">
                    @csrf
                    <input placeholder="Create a new category" type="text" name="title" >
                    <div class="buttons"><button class="btn btn-success" type="submit"><i class="fa fa-plus" aria-hidden="true"></i></button></div>
                </form>
                <div class="admin__items admin__items--featured">
                    <h3 class="bg-secondary text-white mt-4">Featureds</h3>
                    <p class="delete-warning">
                        Find desired product id and add here to feature in homepage
                    </p>
                    @foreach ($featureds as $item)
                            <div class="d-flex justify-content-between align-items-center bg-light">
                                <p>Featured product id: <a href="/admin/products/{{$item->product_id}}">{{$item->product_id}}</a></p>
                                <form action="/admin/featureds" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="text" value="{{$item->product_id}}" name="product_id" hidden>
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </form>
                            </div>
                    @endforeach
                    <form class="admin__items admin__items--featured" action="/admin/featureds" method="post">
                        @csrf
                        <input placeholder="Enter valid product id" type="text" name="product_id" >
                        <div class="buttons"><button class="btn btn-success" type="submit"><i class="fa fa-star" aria-hidden="true"></i></button></div>
                    </form>
                </div>
            </div>
            <div class="col-3">
                <div class="position-sticky top-0 bg-white">
                    <a href="/admin/products/create" class="btn btn-success w-100">Add new</a>
                    <form action="/admin" method="post" class="product-filter-form">
                        @csrf
                        <select class="form-control mt-1" name="category_id" >
                            @foreach ($categories as $category)
                                <option @if($selected_category == $category->id) selected @endif value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                @foreach ($products as $product)
                    <a href="/admin/products/{{$product->id}}">
                        <div class="admin__items">
                            <p>{{$product->title}}</p>
                            <p>{{$product->price}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-3">
                <a href="/admin/orders" class="btn btn-primary w-100 position-sticky top-0">Filtered view</a>
                @foreach ($orders as $order)
                    <a href="/admin/orders/{{$order->id}}">
                        <div class="admin__items">
                            <p>{{$order->location}}</p>
                            <p>{{$order->total}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection