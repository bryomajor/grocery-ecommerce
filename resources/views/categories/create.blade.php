{!! Form::open(['action' => 'CategoryController@store', 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('name', 'Name')}}
    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Category Name'])}}
</div>
{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
{{-- <form action="{{route('categories.store')}}" method="POST">
    <div class="form-group">
        {{csrf_field()}}
        <div class="form-label">
            Name:
        </div>
        <input type="text" class="form-control" placeholder="Category Name" name="category" id="category">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form> --}}
