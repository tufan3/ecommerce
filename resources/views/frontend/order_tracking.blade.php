@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_responsive.css">


<!-- Main Navigation -->
@include('layouts.front_partial.collaps_nav')
<!-- Menu -->


<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('public/frontend') }}/images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">Tracking Your Order Now</h2>
    </div>
</div>

<!-- Shop -->
<div class="shop">
    <div class="container">
        <div class="row">
           <div class="card col-lg-8">
               <form action="{{ route('checking.order') }}" method="post">
                @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Order Number</label>
                            <input type="text" name="order_number" class="form-control" placeholder="Enter your order number" required value="{{ old('order_number') }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Track Order</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
</div>
<hr>

@endsection
