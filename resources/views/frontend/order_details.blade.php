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
        <h2 class="home_title">Order Details</h2>
    </div>
</div>

<!-- Shop -->
<div class="shop">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">{{ __('Order Information') }}
                    </div>
                    <div class="card-body">
                        <span>Order Number: {{ $order->order_number }}</span><br>
                        <span>Name: {{ $order->shipping_name }}</span><br>
                        <span>Phone: {{ $order->shipping_phone }}</span><br>
                        <span>Email: {{ $order->shipping_email }}</span><br>
                        <span>Sub Total: {{ $order->sub_total }}</span><br>
                        <span>Total: {{ $order->total }}</span><br>
                        <span>Status:
                            @if($order->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($order->status == 'received')
                                <span class="badge badge-info">Received</span>
                            @elseif($order->status == 'shipped')
                                <span class="badge badge-primary">Shipped</span>
                            @elseif($order->status == 'completed')
                                <span class="badge badge-success">Completed</span>
                            @elseif($order->status == 'return')
                                <span class="badge badge-warning">Return</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                            @endif
                        </span><br>
                        <span>Order Date: {{ date('d, F Y', strtotime($order->date)) }}</span><br>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">{{ __('Order Item List') }}
                    </div>
                    <div class="card-body">
                        <table id="" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $row)
                                <tr>
                                    <td><img src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="Product Image" width="50"></td>
                                    <td>{{ substr($row->product_name, 0, 15) }}</td>
                                    <td>
                                        @if($row->color != null)
                                        {{ $row->color }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->size != null)
                                       {{ $row->size }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $row->quantity }}
                                    </td>
                                    <td>{{ $setting->currency }}{{ $row->single_price }}</td>
                                    <td class="total-item">{{ $setting->currency }}{{ $row->subtotal_price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>

@endsection
