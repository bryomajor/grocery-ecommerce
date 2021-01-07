@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>All Products</h1>
    <div class="row">
        @if(count($categories) > 0)
            @foreach($categories as $category)
                <div class="col-md-4">
                    <h4 class="mt-5"><b>{{$category->name}}</b></h4>
                    <ol>
                        @foreach($category->products->sortBy('desc') as $product)
                            <li class="mt-2" style="width: 60%">
                                {{$product->name}}
                                <a href="{{url('products/'.$product->id)}}" class="btn btn-sm btn-warning float-right">Manage</a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endforeach
        @else
                <p>No products to display!</p>
        @endif
    </div>
    </div>
@endsection
