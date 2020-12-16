@extends('layouts.app')

@section('content')
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <br>
                @if(\Cart::getTotalQuantity()>0)
                    <h4>{{\Cart::getTotalQuantity()}} Product(s) In Your Cart</h4><br>
                @else
                    <h4>No Product(s) In Your Cart</h4><br>
                    <a href="{{url('/')}}" class="btn btn-dark">Continue Shopping</a>
                @endif

                @foreach($cartCollection as $item)
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{url('storage/product_images/'.$item->attributes->image)}}" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-md-5">
                            <p>
                                <b><a href="#">{{$item->name}}</a></b><br>
                                @if($item->attributes->measurement)
                                    <b>Size: </b>{{$item->attributes->measurement}}<br>
                                @endif
                                @if($item->attributes->flavor)
                                <b>Flavor: </b>{{$item->attributes->flavor}}<br>
                                @endif
                                <b>Price: </b>Ksh. {{$item->price}} <br>
                                <b>Sub Total: </b>Ksh. {{Cart::get($item->id)->getPriceSum()}} <br>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <form action="{{route('cart.update')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <input type="hidden" value="{{$item->id}}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{$item->quantity}}" id="quantity" name="quantity">
                                        <button class="btn btn-secondary btn-sm">Update</button>
                                    </div>
                                </form>
                                <form action="{{route('cart.remove')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$item->id}}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($cartCollection)>0)
                    <form action="{{route('cart.clear')}}" method="POST">
                        {{csrf_field()}}
                        <button class="btn btn-secondary btn-md">Clear Cart</button>
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="col-md-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total: </b>Ksh. {{\Cart::getTotal()}}</li>
                        </ul>
                    </div><br>
                    <a href="{{url('/')}}" class="btn btn-dark">Continue Shopping</a>
                    <a href="{{url('/checkout')}}" class="btn btn-success">Proceed to Checkout</a>
                </div>
            @endif
        </div>
    </div>
@endsection
