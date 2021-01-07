@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2>Flavors</h2>
        <div class="row">
            <div class="col-md-6">
                @if(count($flavors) > 0)
                    <ol>
                        @foreach($flavors as $flavor)
                            <li class="mt-3">{{$flavor->name}}</li>
                            {!! Form::open(['action' => ['FlavorController@destroy', $flavor->id], 'method' => 'POST']) !!}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger float-right']) }}
                            {!! Form::close() !!}
                            <a href="{{url('flavors/'.$flavor->id.'/edit')}}" class="btn btn-sm btn-warning float-right mr-2">Edit</a>
                            <hr>
                        @endforeach
                    </ol>
                @else
                <h4>No flavors as yet!</h4>
                @endif
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <h4>Add Flavor</h4>
                {!! Form::open(['action' => 'FlavorController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Flavor Name']) }}
                </div>
                {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
