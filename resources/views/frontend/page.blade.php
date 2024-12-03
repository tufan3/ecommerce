@extends('layouts.app')
@section('content')

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css"> --}}

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_responsive.css">


<!-- Main Navigation -->
@include('layouts.front_partial.collaps_nav')
<!-- Menu -->


<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('public/frontend') }}/images/shop_background.jpg"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">{{ $page->page_title }}</h2>
    </div>
</div>

<!-- Shop -->
<div class="shop">
    <div class="container">
        <div class="row">
            {!! $page->page_description !!}
        </div>
    </div>
</div>
<hr>


{{-- <script src="{{ asset('public/frontend') }}/js/cart_custom.js"></script> --}}
{{-- <script src="{{ asset('public/frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/parallax-js-master/parallax.min.js"></script> --}}
<script src="{{ asset('public/frontend') }}/js/shop_custom.js"></script>

@endsection
