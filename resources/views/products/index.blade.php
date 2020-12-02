@extends('layouts.app')

@section('content')
    <h1>All Products</h1>
    @if(count($products)>0)
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mt-5">
                <img src="{{url('/storage/product_images/'.$product->product_image)}}" alt="product image" class="rounded-circle img-fluid">
                <h3>{{$product->name}}</h3>
                <h2>Ksh. {{$product->price}}</h2>
                <hr>
                <p>{{$product->desc}}</p>
                <a href="{{url('products/'.$product->id)}}" class="btn btn-warning">Order</a>
            </div>
        @endforeach
    </div>
    @else
    <p>No product to display</p>
    @endif
@endsection
