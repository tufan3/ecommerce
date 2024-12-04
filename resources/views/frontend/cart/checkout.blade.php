@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">

<!-- Main Navigation -->
@include('layouts.front_partial.collaps_nav')
<!-- Menu -->

@php
    $billing_address = DB::table('shippings')->where('user_id', Auth::user()->id)->first();
@endphp

<!-- Cart -->
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="cart_title">Billing Address</div>
                        <div class="card p-2">
                            <form action="">
                                <a href="">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>
                                            <strong>{{ $billing_address->shipping_name }}  {{ $billing_address->shipping_phone }}</strong><br>
                                            {{ $billing_address->shipping_address }}, {{ $billing_address->shipping_city }}, {{ $billing_address->shipping_country }} - {{ $billing_address->shipping_zipcode }}<br>
                                        </span>
                                        <span><i class="fas fa-arrow-right"></i></span>
                                    </li>
                                </a>
                            </form>
                        </div>
                        <div class="cart_title mt-4">Order Summary</div>
                        <div class="my-4">
                            <ul class="list-group">
                                @foreach ($cart_content as $row)
                              <li class="list-group-item d-flex justify-content-between">
                                <img src="{{ asset('public/files/product/' . $row->options->product_thumbnail) }}" alt="Product Image" width="100px" height="100px">

                                <span>
                                    <strong>{{ substr($row->name, 0, 30) }}</strong><br>
                                    @if($row->options->color != null)
                                        <span>Color: {{ $row->options->color }}</span>
                                    @endif
                                    @if($row->options->size != null)
                                        <span>, Size: {{ $row->options->size }}</span>
                                    @endif
                                    <br><br>
                                    <span>{{ $setting->currency }}{{ $row->price }}</span>
                                </span>
                                <span><br><br><br>Qty: {{ $row->qty }}</span>
                                <span>{{ $setting->currency }}{{ $row->price * $row->qty }}</span>
                            </li>
                            @endforeach
                              {{-- <li class="list-group-item d-flex justify-content-between">
                                <span>Product 2</span>
                                <span>$30</span>
                              </li> --}}
                              {{-- <li class="list-group-item d-flex justify-content-between">
                                <strong>Sub Total</strong>
                                <strong>{{ $setting->currency }}{{ Cart::subtotal() }}</strong>
                              </li> --}}
                            </ul>
                          </div>



                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <span style="font-size: 14px;line-height: 40px;">Sub Total: <span style="float: right">{{ $setting->currency }}{{ Cart::subtotal() }}</span></span><br>
                        @if(Session::has('coupon'))
                        <span style="font-size: 14px;line-height: 40px;">Coupon:({{ Session::get('coupon')['name'] }}) <a href="{{ route('coupon.remove') }}" class="text-danger"> X</a> <span style="float: right">{{ $setting->currency }}{{ Session::get('coupon')['discount'] }}</span></span><br>
                        @endif
                        <span style="font-size: 14px;line-height: 40px;">Tax (5%): <span style="float: right">{{ $setting->currency }}{{ Cart::tax() }}</span></span><br>
                        <span style="font-size: 14px;line-height: 40px;">Shipping: <span style="float: right">{{ $setting->currency }}60</span></span><br>
                        @if(Session::has('coupon'))
                        <span style="font-size: 14px;line-height: 40px;">Total: <span style="float: right">{{ $setting->currency }}{{ Session::get('coupon')['after_discount'] + 60 }}</span></span><br>
                        @else
                        @php
                            $total = (float) str_replace(',', '', Cart::total());
                        @endphp
                        <span style="font-size: 14px;line-height: 40px;">Total: <span style="float: right">{{ $setting->currency }}{{ $total + 60 }}</span></span><br>
                        @endif
                    </div>
                </div>
                {{-- <div class="card" style="align-items: center">
                    <div class="order_total_content">
                        <div class="order_total_title">Sub Total</div>
                        <div class="order_total_amount">{{ $setting->currency }}{{ Cart::subtotal() }}</div>
                    </div>
                </div> --}}

                @if(!Session::has('coupon'))
                <div class="card mt-2" style="align-items: center">
                    <div class="p-2">
                        <form action="{{ route('apply.coupon') }}" method="POST">
                            @csrf
                            <div class="" style="color: rgba(0,0,0,0.5); font-size: 14px;line-height: 30px;">Coupon:</div>
                            <input type="text" name="coupon" placeholder="Apply Coupon">
                            <button type="submit" class="ml-1 btn btn-info btn-sm"> Apply</button>
                        </form>
                    </div>
                </div>
                @endif

                {{-- <div class="card mt-2" >
                    <div class="order_total_content">
                        <div class="order_total_title">Tax (5%):</div>
                        <div class="order_total_amount">{{ $setting->currency }}{{ Cart::tax() }}</div>
                    </div>
                </div>

                <div class="card mt-2" >
                    <div class="order_total_content">
                        <div class="order_total_title">Shipping:</div>
                        <div class="order_total_amount">{{ $setting->currency }}60</div>
                    </div>
                </div>

                <div class="card mt-2" >
                    <div class="order_total_content">
                        <div class="order_total_title">Total</div>
                        <div class="order_total_amount">{{ $setting->currency }}{{ Cart::total() }}</div>
                    </div>
                </div> --}}

                <form action="">
                    @csrf
                    <input type="text" name="c_shipping_id" id="" value="{{ $billing_address->id }}">
                    {{-- <input type="hidden" name="c_phone" id="" value="{{ $billing_address->shipping_phone }}">
                    <input type="hidden" name="c_email" id="" value="{{ $billing_address->shipping_email }}">
                    <input type="hidden" name="c_country" id="" value="{{ $billing_address->shipping_country }}">
                    <input type="hidden" name="c_address" id="" value="{{ $billing_address->shipping_address }}">
                    <input type="hidden" name="c_city" id="" value="{{ $billing_address->shipping_city }}">
                    <input type="hidden" name="c_zipcode" id="" value="{{ $billing_address->shipping_zipcode }}"> --}}
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Paypal</label><br>
                                    <input type="radio" name="payment_method">
                                </div>
                                <div class="col-md-4">
                                    <label for="">SSL Commerze</label><br>
                                    <input type="radio" name="payment_method">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Cash On Delivery</label><br>
                                    <input type="radio" name="payment_method" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4" style="float: right">
                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/frontend') }}/js/cart_custom.js"></script>

{{-- ajax request form edit --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



<script>
    $(document).ready(function () {
        //--qty product upadte--//
        $('.qty-input').on('change', function () {
            // let rowId = $(this).closest('tr').data('id');
            let qty = $(this).val();
            // let rowId = $('#productid').val();
            let rowId = $(this).data('id');
            // alert(rowId);

            $.ajax({
                url: '{{ url('cartproduct/update/') }}/' + rowId+'/' + qty,
                method: 'get',
                success: function (response) {
                    toastr.success(response);
                    location.reload();
                    cart();
                }
            });
        });

        //--color product update--//
        $('.color').on('change', function () {
            let color = $(this).val();
            let rowId = $(this).data('id');
            // alert(color);
            // alert(rowId);

            $.ajax({
                url: '{{ url('cartproduct/update-color/') }}/' + rowId+'/' + color,
                method: 'get',
                success: function (response) {
                    toastr.success(response);
                    location.reload();
                    cart();
                }
            });
        });
        //--color product upadte--//

        //--size product update--//
        $('.size').on('change', function () {
            let size = $(this).val();
            let rowId = $(this).data('id');
            // alert(size);
            // alert(rowId);

            $.ajax({
                url: '{{ url('cartproduct/update-size/') }}/' + rowId+'/' + size,
                method: 'get',
                success: function (response) {
                    toastr.success(response);
                    location.reload();
                    cart();
                }
            });
        });
        //--size product upadte--//

    $('.delete-item').on('click', function (e) {
            e.preventDefault();
            let rowId = $(this).data('id');
            // alert(rowId);
            $.ajax({
                url: '{{ url('cartproduct/remove/') }}/' + rowId,
                method: 'get',
                async:false,
                success: function (response) {
                    toastr.success(response);
                    location.reload();
                    cart();
                }
            });
        });
    });
    </script>
@endsection
