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
                        <div class="cart_title">Shopping Cart</div>
                        <table id="ytable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_content as $row)
                                @php
                                    $product = DB::table('products')->find($row->id);
                                    $sizes = explode(',', $product->size ?? '');
                                    $colors = explode(',', $product->color ?? '');
                                @endphp
                                <tr>
                                    <td><img src="{{ asset('public/files/product/' . $row->options->product_thumbnail) }}" alt="Product Image" width="50"></td>
                                    <td>{{ substr($row->name, 0, 15) }}</td>
                                    <td>
                                        @if($row->options->color != null)
                                        <select class="custom-select form-control-sm color" style="color: #000000; min-width: 70px;" name="color" data-id="{{ $row->rowId }}">
                                            @foreach ($colors as $color)
                                            <option value="{{ $color }}" {{ $row->options->color == $color ? 'selected' : '' }}>{{ $color }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->options->size != null)
                                        <select class="custom-select form-control-sm size" style="color: #000000; min-width: 70px;" name="size" data-id="{{ $row->rowId }}">
                                            @foreach ($sizes as $size)
                                            <option value="{{ $size }}" {{ $row->options->size == $size ? 'selected' : '' }}>{{ $size }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="number" class="form-control-sm qty-input" value="{{ $row->qty }}" data-id="{{ $row->rowId }}" name="qty" min="1" style="width: 70px;" required>
                                    </td>
                                    <td>{{ $setting->currency }}{{ $row->price }} x {{ $row->qty }}</td>
                                    <td class="total-item">{{ $setting->currency }}{{ $row->price * $row->qty }}</td>
                                    <td><a href="#" class="text-danger delete-item" data-id="{{ $row->rowId }}">X</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="order_total">
                    <div class="order_total_content text-md-right">
                        <div class="order_total_title">Order Total:</div>
                        <div class="order_total_amount">{{ $setting->currency }}{{ Cart::subtotal() }}</div>
                    </div>
                </div>

                <div class="cart_buttons">
							<a href="{{ route('cart.destroy') }}" class="button cart_button_clear bg-danger text-white">Clear Cart</a>
							<a href="{{ route('checkout') }}" class="button cart_button_checkout">Checkout</a>
						</div>
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
