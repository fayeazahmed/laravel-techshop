@extends('layouts.app')

@section('title')
    Laravel TechShop | Users
@endsection

@section('content')
    <div class="admin__details">
        <p>Name: {{$user->name}}</p>
        <p>Email: {{$user->email}}</p>
        <p>Contact: {{$user->contact}}</p>
        <p>Address: {{$user->address}}</p>

        <h3 class="text-start">Orders: {{count($orders)}}</h3>
        @foreach ($orders as $order)
            <a href="/admin/orders/{{$order->id}}">
                <div class="border rounded mt-2 p-2">
                    <p>Total: {{$order->total}}</p>
                    <p>Note: {{$order->note}}</p>
                    <p>Timestamp: {{$order->created_at}}</p>
                </div>
            </a>
        @endforeach

        <div class="deleteBtn">
            <button id="delete-btn" class="btn btn-danger">
                DELETE RECORD
            </button>
        </div>
        <form method="post" action="/admin/users/{{$user->id}}" class="deletePanel">
            @method('delete')
            @csrf
            <p>This item will be permanently deleted from database. Proceed?</p>
            <button type="submit" class="btn btn-danger">Confirm</button>
            <button type="reset" class="btn btn-warning">Cancel</button>
        </form>
    </div>
@endsection