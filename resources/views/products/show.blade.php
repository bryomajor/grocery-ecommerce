@extends('layouts.app')

@section('content')
<h1>{{$product->name}}</h1>
<h2>Ksh. {{$product->price}}</h2>
<hr>
<p>{{$product->desc}}</p>
<a href="#" class="btn btn-warning">Add to cart</a>
@if(!Auth::guest() && Auth::user()->is_admin)

        <a href="{{url('products/'.$product->id.'/edit')}}" class="btn btn-primary">Edit product</a>
        {{Form::open(['action'=>['ProductsController@destroy', $product->id], 'method'=>'POST'])}}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}

@endif
@endsection
