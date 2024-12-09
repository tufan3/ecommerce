@extends('layouts.app')

@section('content')

@include('layouts.front_partial.collaps_nav')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
<style>
    .profile-card {
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
    .sidebar {
        font-size: 18px;
    }
    .card-counter {
        text-align: center;
        padding: 10px;
        margin: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f8f9fa;
    }
</style>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('user.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">{{ __('My order') }}
                        <a href="{{ route('my.order') }}" class="btn btn-info btn-sm" style="float: right;">My Order List</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <span>Order Number: {{ $order->order_number }}</span><br>
                                <span>Name: {{ $order->shipping_name }}</span><br>
                                <span>Phone: {{ $order->shipping_phone }}</span><br>
                                <span>Email: {{ $order->shipping_email }}</span><br>
                            </div>
                            <div class="col-lg-6">
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
                </div>
                <div class="card mt-2">
                    <div class="card-header">{{ __('My Order Details') }}
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
@endsection
