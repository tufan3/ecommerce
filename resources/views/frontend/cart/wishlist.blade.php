@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">

<!-- Main Navigation -->
@include('layouts.front_partial.collaps_nav')
<!-- Menu -->

<!-- Cart -->

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                    <div class="cart_items">
                        <ul class="cart_list">
                            @foreach ($cart_content as $row)
                            <li class="cart_item clearfix">
                                <div class="cart_item_image"><img style="width: 100px; height: 100px;" src="{{ asset('public/files/product/' . $row->options->product_thumbnail) }}" alt="" srcset=""></div>
                                <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                    <div class="cart_item_name cart_info_col">
                                        <div class="cart_item_text">{{ substr($row->name, 0, 15) }}</div>
                                    </div>
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_text">
                                            <select class="custom-select form-control-sm ml-0" style="color: #000000; min-width: 70px;" name="size">
                                                <option value="">Black</option>
                                                <option value="">red</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cart_item_color cart_info_col">
                                        <div class="cart_item_text">
                                            <select class="custom-select form-control-sm ml-0" style="color: #000000; min-width: 70px;" name="size">
                                                <option value="">XXL</option>
                                                <option value="">XL</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cart_item_quantity cart_info_col">
                                        <div class="cart_item_text">
                                            <input type="number" class="form-control-sm" value="{{ $row->qty }}" name="qty" min="1" style="width: 70px;" required>
                                        </div>
                                    </div>
                                    <div class="cart_item_price cart_info_col">
                                        <div class="cart_item_text">$2000</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_text">$2000</div>
                                    </div>
                                    <div class="cart_item_total cart_info_col">
                                        <div class="cart_item_text"><a href="#" class="text-danger">X</a></div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>


                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                            <div class="order_total_amount">$2000</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                        <button type="button" class="btn cart_button_checkout btn-danger btn-sm">Clear Cart</button>
                        <button type="button" class="btn cart_button_checkout btn-info btn-sm">Checkout</button>
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="cart_title">Your Wishlist Item</div>
                        <table id="ytable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlist as $row)
                                {{-- @php
                                    $product = DB::table('products')->find($row->id);
                                    $sizes = explode(',', $product->size ?? '');
                                    $colors = explode(',', $product->color ?? '');
                                @endphp --}}
                                <tr>
                                    <td><img src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="Product Image" width="50"></td>
                                    <td>{{ substr($row->product_name, 0, 30) }}</td>
                                    <td>{{ $row->date }}</td>


                                    <td>
                                        <a href="{{ route('product.details', $row->product_slug) }}" class="button cart_button_clear bg-info text-white">Add to Cart</a>
                                        <a href="{{ route('wishlistproduct.delete', $row->id) }}" class="btn btn-danger text-white delete-item"> X </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="cart_buttons">
                    <a href="{{ route('clear.wishlist') }}" class="button cart_button_clear bg-danger text-white">Clear</a>
					<a href="{{ url('/') }}" class="button cart_button_checkout">Back to Home</a>
				</div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/frontend') }}/js/cart_custom.js"></script>

@endsection
