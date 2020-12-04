@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 mx-auto">
        <div class="card p-3">
            {!! Form::open(['action' => ['CategoryController@update', $category->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', $category->name, ['class' => 'form-control'])}}
            </div>
            {{ Form::hidden('_method', 'PUT') }}
            {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
