
@extends('layouts.app')

@section('content')
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Cart</li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-5 mx-auto jumbotron">
            <p><small>Make payment to complete order.</small></p>
            <h4>How to Pay</h4>
            <ol>
                <li>Go to Lipa na Mpesa & choose Buy Goods & Services.</li>
                <li>Enter till number 777800.</li>
                <li>Enter amount in your cart.</li>
                <li>Make payment.</li>
            </ol>
        </div>
    </div>
@endsection
