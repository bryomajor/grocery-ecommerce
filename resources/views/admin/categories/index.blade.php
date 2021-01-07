@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <h4>Available Categories</h4>
                @if(count($categories) > 0)
                <ol>
                    @foreach ($categories as $category)
                        <li class="mt-3">{{$category->name}}</li>
                        {!! Form::open(['action' => ['CategoryController@destroy', $category->id], 'method' => 'POST']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-sm btn-danger float-right']) }}
                        {!! Form::close() !!}
                        <a href="{{url('categories/'.$category->id.'/edit')}}" class="btn btn-sm btn-warning float-right mr-2">Edit</a>
                        <hr>
                    @endforeach
                </ol>
                @endif
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <h4>Create Category</h4>
                @include('admin.categories.create')
            </div>
        </div>
    </div>
@endsection
