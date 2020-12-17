@extends('layouts.app')

@section('content')
<h4 class="mb-4">Product Name: <b>{{$product->name}}</b></h4>
<div class="row">
    <div class="col-md-8">
        <img src="{{url('storage/product_images/'.$product->product_image)}}" alt="" class="img-fluid">
    </div>
    <div class="col-md-4">
        <p><b>Category: </b>{{$product->category->name}}</p>

        @if(count($product->measurements))
        <p><b>Size: </b>{{implode($product->measurements->pluck('name')->toArray())}}</p>
        @endif

        @if(count($product->flavors))
        <p><b>Flavors: </b>{{implode(', ', $product->flavors->pluck('name')->toArray())}}</p>
        @endif
        
        <h5><b>Price:</b> Ksh. {{$product->price}}</h2>
        <hr>
        <p>{{$product->desc}}</p>
        {{Form::open(['action'=>['ProductsController@destroy', $product->id], 'method'=>'POST'])}}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class'=>'btn btn-danger float-right'])}}
        <a href="{{url('products/'.$product->id.'/edit')}}" class="btn btn-primary float-right mr-3">Edit product</a>
    </div>
</div>
@endsection
