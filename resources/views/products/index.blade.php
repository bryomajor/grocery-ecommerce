@extends('layouts.app')

@section('content')
    <h1>All Products</h1>
    @if(count($categories)>0)
        @foreach ($categories as $category)
            <h4 class="mt-5"><b>{{$category->name}}</b></h4>
            <div class="row pb-3">
                @foreach($category->products->sortBy('desc') as $product)
                    <div class="col-md-3 mt-5">
                        <img width="200" src="{{url('/storage/product_images/'.$product->product_image)}}" alt="product image" class="rounded-circle img-fluid">
                        <h3>{{$product->name}}</h3>
                        <h2>Ksh. {{$product->price}}</h2>
                        <hr>
                        <p>{{$product->desc}}</p>
                        <a href="{{url('products/'.$product->id)}}" class="btn btn-warning">Order</a>
                    </div>
                @endforeach
            </div>
            <hr>
        @endforeach
    @else
        <p>No product to display!</p>
    @endif
@endsection
