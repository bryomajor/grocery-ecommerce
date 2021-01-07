@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2>Edit Size</h2>
        <div class="row">
            <div class="col-md-5 mx-auto">
                {!! Form::open(['action' => ['MeasurementController@update', $measurement->id], 'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', $measurement->name, ['class' => 'form-control']) }}
                </div>
                {{ Form::hidden('_method', 'PUT') }}
                {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
