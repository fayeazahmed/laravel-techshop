
<div class="product card">
    <a href="/products/details/{{$id}}"><img src="{{$image}}" alt=""></a>
    <p class="product__title">{{$title}}</p>
    <p>{{$description}}</p>
    <div class="product__price">
        <p>{{$price}} ৳</p>
        @if (!$inStock) <button disabled class="btn btn-outline-dark">Stock out</button>         
        @elseif(!$inCart) <a href="/cart/add/{{$id}}" class="btn btn-outline-primary"><i class="fa fa-cart-plus fa-2x" aria-hidden="true"></i></a>
        @else <a href="/cart/remove/{{$id}}/1" class="btn btn-outline-danger"><i class="fa fa-minus-square fa-2x" aria-hidden="true"></i></a> @endif
    </div>
</div>
