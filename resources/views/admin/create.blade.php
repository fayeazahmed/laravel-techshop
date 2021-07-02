@extends('layouts.app')

@section('title')
    Laravel TechShop | Create
@endsection

@section('content')
    <div class="admin__details">
        <form class="edit-product" action="/admin/products/create" method="post">
            @csrf
            <label class="mt-4" for="title">Title: </label>
            <input required id="title" name="title" class="form-control" type="text">
            <label class="mt-4" for="price">Price: </label>
            <input required id="price" name="price" class="form-control" type="text">
            <label class="mt-4" for="category_id">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
            <label class="mt-4" for="description">Description: </label>
            <textarea required id="description" name="description" class="form-control"></textarea>
            <label class="mt-4" for="image">Image link: </label>
            <input required id="image" name="image" class="form-control" type="text" value="">
            <div class="d-flex align-items-center mt-2">
                <label for="in_stock">In stock</label>
                <input type="checkbox" checked class="w-auto ms-2" name="in_stock" id="in_stock">
                <button type="submit" class="btn btn-success ms-auto">Add</button>
            </div>
        </form>
    </div>
@endsection