@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Edit Product</h1>
    {!! Form::open(['action' => ['ProductsController@update', $product->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $product->name, ['class' => 'form-control', 'placeholder'=>'Product name'])}}
    </div>
    <div class="form-group">
        {{ Form::label('', 'Has Flavor?', ['class' => 'font-weight-bold']) }}
        @foreach($flavors as $flavor)
            {{ Form::label('flavors[]', $flavor->name, ['class' => 'ml-3']) }}
            {{ Form::checkbox('flavors[]', $flavor->id, '', ['class' => 'ml-1']) }}
        @endforeach
        <a href="{{url('/flavors')}}" class="btn btn-sm btn-dark ml-5">Add Flavor</a>
    </div>
    <div class="form-group">
        {{ Form::label('', 'Has Size?', ['class' => 'font-weight-bold']) }}
        @foreach($measurements as $measurement)
            {{ Form::label('measurements[]', $measurement->name, ['class' => 'ml-3']) }}
            {{ Form::checkbox('measurements[]', $measurement->id, '', ['class' => 'ml-1']) }}
        @endforeach
        <a href="{{url('/measurements')}}" class="btn btn-sm btn-dark ml-5">Size</a>
    </div>
    <div class="form-group">
        {{Form::label('price', 'Price')}}
        {{Form::number('price', $product->price, ['class'=>'form-control', 'placeholder'=>'Product price'])}}
    </div>
    <div class="form-group">
        {{Form::label('desc', 'Description')}}
        {{Form::textarea('desc', $product->desc, ['class'=>'form-control', 'placeholder'=>'Product description'])}}
    </div>
    <div class="form-group">
        {{ Form::label('category', 'Category') }}
        {{ Form::select('category', $categories, $product->category_id, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {{Form::file('product_image')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    </div>
@endsection
