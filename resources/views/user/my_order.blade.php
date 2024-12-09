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
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Order List') }}
                        <a href="{{ route('write.review') }}" class="" style="float: right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                    </div>
                    <div class="card-body">
                        <div class="">
                            {{-- <h5>Recent Order</h5> --}}
                            <table class="table table-hover" id="example1">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Payment Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $row)
                                    <tr>
                                        <td>{{ $row->order_number }}</td>
                                        <td>{{ date('d, F Y', strtotime($row->date)) }}</td>
                                        <td>{{ $setting->currency }}{{ $row->total }}</td>
                                        <td>{{ $row->payment_type }}</td>
                                        <td>
                                            @if($row->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($row->status == 'received')
                                                <span class="badge badge-info">Received</span>
                                            @elseif($row->status == 'shipped')
                                                <span class="badge badge-primary">Shipped</span>
                                            @elseif($row->status == 'completed')
                                                <span class="badge badge-success">Completed</span>
                                            @elseif($row->status == 'return')
                                                <span class="badge badge-warning">Return</span>
                                            @elseif($row->status == 'cancelled')
                                                <span class="badge badge-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('view.order', $row->id) }}" class="btn btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            {{-- <a href="{{ route('order.invoice', $row->id) }}" class="btn btn-sm btn-info"><i class="fas fa-file-invoice-dollar"></i> Invoice</a> --}}
                                        </td>
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
@endsection
