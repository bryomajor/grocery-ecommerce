@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active">Shop</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <h4>Products In Our Store</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{url('/storage/product_images/'.$product->product_image)}}" alt="product image" class="rounded-circle img-fluid">
                            <div class="card-body">
                                <a href="">
                                    <h6 class="card-title">{{$product->name}}</h6>
                                </a>
                                <p>{{$product->price}}</p>
                                <form action="{{route('cart.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$product->id}}" id="id" name="id">
                                    <input type="hidden" value="{{$product->name}}" id="name" name="name">
                                    <input type="hidden" value="{{$product->price}}" id="price" name="price">
                                    <input type="hidden" value="{{$product->product_image}}" id="img" name="img">
                                    <input type="hidden" value="1" id="quantity" name="quantity">
                                    <div class="card-footer">
                                        <div class="row">
                                            <button class="btn btn-secondary btn-sm" title="add to cart">
                                                add to cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
