@if(count(\Cart::getContent())>0)
    @foreach(\Cart::getContent() as $item)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{url('/storage/product_images/'.$item->attributes->image)}}" alt="" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <b>{{$item->name}}</b><br>
                    <small>Qty: {{$item->quantity}}</small>
                </div>
                <div class="col-md-3">
                    <p>Ksh. {{\Cart::get($item->id)->getPriceSum()}}</p>
                </div>
                <hr>
            </div>
        </li>
    @endforeach
    <br>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-9">
                <b>Total: </b>Ksh. {{\Cart::getTotal()}}
            </div>
            <div class="col-md-2">
                <form action="{{route('cart.clear')}}" method="POST">
                    {{csrf_field()}}
                    <button class="btn btn-secondary btn-sm">Remove</button>
                </form>
            </div>
        </div>
    </li>
    <br>
    <div class="row m-0">
        <a href="{{route('cart.index')}}" class="btn btn-dark btn-sm btn-block">
            CART
        </a>
        <a href="{{route('checkout')}}" class="btn btn-dark btn-sm btn-block">
            CHECKOUT
        </a>
    </div>
@else
    <li class="list-group-item">Your Cart is Empty</li>
@endif
