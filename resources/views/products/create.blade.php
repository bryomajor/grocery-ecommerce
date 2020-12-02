@extends('layouts.app')

@section('content')
    <h1>Add Product</h1>
    {!! Form::open(['action' => 'ProductsController@store', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder'=>'Product name'])}}
    </div>
    <div class="form-group">
        {{Form::label('price', 'Price')}}
        {{Form::number('price', '', ['class'=>'form-control', 'placeholder'=>'Product price'])}}
    </div>
    <div class="form-group">
        {{Form::label('desc', 'Description')}}
        {{Form::textarea('desc', '', ['class'=>'formcontrol', 'placeholder'=>'Product description'])}}
    </div>
    <div class="form-group">
        {{Form::file('product_image')}}
    </div>
    <div class="form-group">
        {{Form::label('category', 'Category')}}
        {{Form::select('category', $categories, null, ['placeholder' => 'Pick a category...'])}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
