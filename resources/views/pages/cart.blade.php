@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <br>
                @if(\Cart::getTotalQuantity()>0)
                    <h4 class=" animate__animated animate__fadeInUp animate__delay-0.3s">{{\Cart::getTotalQuantity()}} Product(s) In Your Cart</h4><br>
                @else
                    <h4>No Product(s) In Your Cart</h4><br>
                    <a href="{{url('/')}}" class="btn btn-dark">Continue Shopping</a>
                @endif

                @foreach($cartCollection as $item)
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <img src="{{url('storage/product_images/'.$item->attributes->image)}}" alt="" class="img-thumbnail  animate__animated animate__fadeInLeft animate__delay-0.5s">
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                            <p class=" animate__animated animate__fadeInLeft animate__delay-0.3s">
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
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <form action="{{route('cart.update')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="form-group row animate__animated animate__fadeInUp animate__delay-0.5s">
                                        <input type="hidden" value="{{$item->id}}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{$item->quantity}}" id="quantity" name="quantity">
                                        <button class="btn btn-secondary btn-sm"><i class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{route('cart.remove')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$item->id}}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm animate__animated animate__fadeInUp animate__delay-0.5s"><i class="fa fa-trash"></i></button>
                                </form>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($cartCollection)>0)
                    <form action="{{route('cart.clear')}}" method="POST">
                        {{csrf_field()}}
                        <button class="btn btn-secondary btn-md animate__animated animate__fadeInDown animate__delay-0.5s">Clear Cart</button>
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="card">
                        <ul class="list-group list-group-flush animate__animated animate__fadeInUp animate__delay-0.5s">
                            <li class="list-group-item"><b>Total: </b>Ksh. {{\Cart::getTotal()}}</li>
                        </ul>
                    </div><br>
                    <a href="{{url('/')}}" class="btn btn-dark animate__animated animate__fadeInRight animate__delay-0.5s">Continue Shopping</a>
                    <a href="{{url('/checkout')}}" class="btn btn-success animate__animated animate__fadeInRight animate__delay-0.5s">Proceed to Checkout</a>
                </div>
            @endif
        </div>
    </div>
@endsection
