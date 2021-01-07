@extends('layouts.app')

@section('content')
@include('layouts.hero-section')
<div class="container">
    <div class="row justify-content-center mt-3 text-center">
        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8 mx-auto">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2 class="mt-3 font-weight-bold animate__animated animate__fadeInUp animate__delay-0.1s" id="shopnow">Products In Our Store</h2>
                </div>
            </div>
            <hr>
            @if(count($categories) > 0)
                @foreach ($categories as $category)
                    <h3 class="mt-5 font-weight-bold animate__animated animate__fadeInUp animate__delay-0.3s">{{$category->name}}</h3>
                    <div class="row p-3">
                        @foreach($category->products->sortBy('desc') as $product)
                            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 mt-5">
                                <div class="card bg-transparent align-items-center text-center">
                                    <img src="{{url('/storage/product_images/'.$product->product_image)}}" alt="product image" class="rounded-circle img-fluid animate__animated animate__slideInDown animate__delay-0.1s">
                                    <div class="card-body">
                                        <h5 class="card-title animate__animated animate__fadeInDown animate__delay-0.5s">
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
                                                <i class="fa fa-shopping-cart"></i> Add to Cart
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
