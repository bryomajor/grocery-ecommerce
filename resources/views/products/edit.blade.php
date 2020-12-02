@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    {!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $product->name, ['class' => 'form-control', 'placeholder'=>'Product name'])}}
    </div>
    <div class="form-group">
        {{Form::label('price', 'Price')}}
        {{Form::number('price', $product->price, ['class'=>'form-control', 'placeholder'=>'Product price'])}}
    </div>
    <div class="form-group">
        {{Form::label('desc', 'Description')}}
        {{Form::textarea('desc', $product->desc, ['class'=>'formcontrol', 'placeholder'=>'Product description'])}}
    </div>
    <div class="form-group">
        {{Form::file('product_image')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
