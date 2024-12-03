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
            <div class="col-md-4">
                @include('user.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Setting') }}
                        <a href="{{ route('write.review') }}" class="" style="float: right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                    </div>
                    <div class="card-body">
                        <h4>Your Shipping Details</h4>
                        <div>
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="product_id">Shipping Name</label>
                                    <input type="text" class="form-control text-dark" name="shipping_name" value="">
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="shipping_email">Shipping Email</label>
                                        <input type="email" name="shipping_email" id="shipping_email" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="shipping_phone">Shipping Phone</label>
                                        <input type="text" class="form-control text-dark" name="shipping_phone" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="shipping_address">Shipping Address</label>
                                    <input type="text" class="form-control text-dark" name="shipping_address" value="">
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="shipping_country">Shipping Country</label>
                                        <input type="text" class="form-control text-dark" name="shipping_country" value="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="shipping_city">Shipping City</label>
                                        <input type="text" class="form-control text-dark" name="shipping_city" value="">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="shipping_zipcode">Shipping Zipcode</label>
                                        <input type="text" class="form-control text-dark" name="shipping_zipcode" value="">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card-body">
                        <h4>Change Your Password</h4>
                            <form action="{{ route('customer.password.change') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Old Password</label>
                                    <input type="password" class="form-control" id="exampleInputEmail" name="old_password" placeholder="Old password" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword2" name="password" placeholder="New Password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword2">Confirm Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword2" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
