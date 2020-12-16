@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <h5>Products In Our Store</h5>
                </div>
            </div>
            <hr>
            @if(count($categories) > 0)
                @foreach ($categories as $category)
                    <h4 class="mt-5">{{$category->name}}</h4>
                    <div class="row pb-3">
                        @foreach($category->products->sortBy('desc') as $product)
                            <div class="col-md-3 mt-5">
                                <div class="card bg-transparent align-items-center text-center">
                                    <img src="{{url('/storage/product_images/'.$product->product_image)}}" alt="product image" class="rounded-circle img-fluid">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$product->name}}
                                            @if(count($product->measurements) > 0)
                                                ({{implode($product->measurements->pluck('name')->toArray())}})
                                            @endif
                                        </h5>
                                        <p>Ksh. {{$product->price}}</p>
                                        <form action="{{route('cart.store')}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="hidden" value="{{$product->id}}" id="id" name="id">
                                            <input type="hidden" value="{{$product->name}}" id="name" name="name">
                                            <input type="hidden" value="{{$product->price}}" id="price" name="price">
                                            <input type="hidden" value="{{$product->product_image}}" id="img" name="img">
                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                            <input type="hidden" name="measurement" id="measurement" value="{{implode($product->measurements->pluck('name')->toArray())}}">
                                            @if(count($product->flavors) > 0)
                                            <select name="flavor" id="flavor">
                                                @foreach($product->flavors as $flavor)
                                                    <option value="{{$flavor->name}}">{{$flavor->name}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            <button class="btn btn-warning btn-sm" title="add to cart">
                                                Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
