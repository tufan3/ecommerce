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
                    <div class="card-header">
                        {{ __('All Tickets') }}
                        <button class="btn btn-danger btn-sm" style="float: right;" data-toggle="modal" data-target="#addModal">Open ticket</button>

                    </div>
                    <div class="card-body">
                        <div class="mt-4">
                            <table class="table table-hover" id="">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Service</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ticket as $row)
                                    <tr>
                                        <td>{{ date('d, F Y', strtotime($row->date)) }}</td>
                                        <td>{{ $row->service }}</td>
                                        <td>{{ $row->subject }}</td>
                                        <td>
                                            @if($row->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($row->status == 1)
                                                <span class="badge badge-info">Replied</span>
                                            @elseif($row->status == 2)
                                                <span class="badge badge-danger">Closed</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('show.ticket',$row->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            {{-- <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> --}}
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

    {{-- add modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="addModalLabel">Open Ticket</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.ticker') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" name="subject" placeholder="Subject" value="" required>

                            {{-- class="form-control @error('coupon_code') is-invalid @enderror" id="coupon_code"
                            @error('coupon_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select name="priority" class="form-control text-dark ml-0" style="min-width: 100%;" required>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="service" class="form-label">Service</label>
                                    <select name="service" class="form-control text-dark ml-0" style="min-width: 100%;" required>
                                        <option value="Technical">Technical</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Affiliate">Affiliate</option>
                                        <option value="Return">Return</option>
                                        <option value="Refund">Refund</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add modal --}}
@endsection
