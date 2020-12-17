{!! Form::open(['action' => 'CategoryController@store', 'method' => 'POST']) !!}
<div class="form-group">
    {{Form::label('name', 'Name')}}
    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Category Name'])}}
</div>
{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
