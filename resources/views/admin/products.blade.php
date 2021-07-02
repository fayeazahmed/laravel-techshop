@extends('layouts.app')

@section('title')
    Laravel TechShop | {{$product->title}}
@endsection

@section('content')
    <div class="admin__details">
        <form class="edit-product" action="/admin/products/{{$product->id}}" method="post">
            @csrf
            @method('PATCH')
            <label class="mt-4" for="">Title: </label>
            <input name="title" disabled class="form-control toggle-input" type="text" value="{{$product->title}}">
            <label class="mt-4" for="">Price: </label>
            <input name="price" disabled class="form-control toggle-input" type="text" value="{{$product->price}}">
            <label class="mt-4" for="">Description: </label>
            <textarea name="description" disabled class="form-control toggle-input">{{$product->description}}</textarea>
            <label class="mt-4" for="">Image link: </label>
            <input name="image" disabled class="form-control toggle-input" type="text" value="{{$product->image}}">
            <div class="d-flex align-items-center mt-2">
                <label for="in_stock">In stock</label>
                <input disabled type="checkbox" @if($product->in_stock) checked @endif class="w-auto ms-2 toggle-input" name="in_stock" id="in_stock">
                <button disabled type="submit" class="btn btn-success ms-auto toggle-input">Update</button>
            </div>
        </form>
        <img src="{{$product->image}}" alt="">
        <div class="deleteBtn d-flex">
            <button id="edit-btn" class="btn btn-info me-2">
                EDIT INFO
            </button>
            <button id="delete-btn" class="btn btn-danger">
                DELETE RECORD
            </button>
        </div>
        <form method="post" action="/admin/products/{{$product->id}}" class="deletePanel">
            @method('delete')
            @csrf
            <p>This item will be permanently deleted from database. Proceed?</p>
            <button type="submit" class="btn btn-danger">Confirm</button>
            <button type="button" class="btn btn-warning">Cancel</button>
        </form>
    </div>
@endsection