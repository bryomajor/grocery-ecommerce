@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2>Sizes</h2>
        <div class="row">
            <div class="col-md-6">
                @if(count($measurements) > 0)
                    <ol>
                        @foreach($measurements as $measurement)
                            <li class="mt-2">{{$measurement->name}}</li>
                            {!! Form::open(['action' => ['MeasurementController@destroy', $measurement->id], 'method' => 'POST']) !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger float-right']) }}
                            {!! Form::close() !!}
                            <a href="{{url('measurements/'.$measurement->id.'/edit')}}" class="btn btn-sm btn-warning float-right mr-2">Edit</a>
                            <hr>
                        @endforeach
                    </ol>
                @else
                <p>Nothing to display!</p>
                @endif
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                {!! Form::open(['action' => 'MeasurementController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Size Name']) }}
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
