
<div class="modal-body">
    <div class="row">
        <div class="col-lg-4">
            <div class="quick_view_image"><img style="width: 100%; height: 100%;" src="{{ asset('public/files/product/' . $product->product_thumbnail) }}" alt="" srcset=""></div>
        </div>
        <div class="col-lg-8">
            <div class="product_description">
                <div class="product_category">{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</div>
                <div class="product_name" style="font-size: 18px"><b>{{ $product->product_name }}</b></div>

                {{-- <div class="">$45.00</div> --}}

                @if($product->discount_price == null)
                        <div class="product_price" style="margin: 20px 0px 0px 0px; color: #ff6f61;">
                            {{ $setting->currency }} {{ $product->selling_price }}
                        </div>
                    @else
                        <div class="" style="margin: 20px 0px 0px 0px;">
                            <span  style="font-size: 25px;color: #ff6f61">{{ $setting->currency }} {{ $product->discount_price }}</span>

                            <span style="font-size: 18px;"><del>{{ $setting->currency }} {{ $product->selling_price }}</del></span>
                            @php
                                $discountPercentage = round((($product->selling_price - $product->discount_price) / $product->selling_price) * 100);
                            @endphp
                            <span style="color: #ff6f61;">-{{ $discountPercentage }}%</span>
                        </div>
                    @endif

                @if($product->brand == null)
                <div class="product_category">Brand: Not Available</div>
                @else
                <div class="product_category"><b>Brand: </b>{{ $product->brand->brand_name }}</div>
                @endif

                <div class="row mt-2 mb-2">
                    <div class="col-lg-7">
                        <div class="product_category"><b>Stock: </b>
                            @if($product->stock_quantity < 1)
                            <span class="badge badge-danger">Out of Stock</span>
                            @else
                            <span class="badge badge-success">Stock Available</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5">
                        @if($product->product_unit != null)
                        <div class="product_category"><b>Unit: </b>{{ $product->product_unit }}</div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('add.to.cart.quickView') }}" method="POST" id="add_cart_form">
                    @csrf
                <div class="form-group">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @if($product->discount_price == null)
                    <input type="hidden" name="product_price" value="{{ $product->selling_price }}">
                    @else
                    <input type="hidden" name="product_price" value="{{ $product->discount_price }}">
                    @endif
                    <div class="row">
                        @isset($product->size)
                        <div class="col-lg-6">
                            <label for="size-select"><b>Size</b></label><br>

                            @php
                                $sizes = explode(',', $product->size);
                            @endphp

                            <select class="custom-select form-control-sm ml-0" style="color: #000000; min-width: 100%;" name="size">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size }}">{{ $size }}</option>
                                @endforeach
                                {{-- <option value="">XXL</option>
                                <option value="">XL</option> --}}
                            </select>

                        </div>
                        @endisset

                        @isset($product->color)
                        <div class="col-lg-6">
                            <label for="color-select"><b>Color</b></label><br>
                            @php
                                $colors = explode(',', $product->color);
                            @endphp

                            <select class="custom-select form-control-sm ml-0" style="color: #000000; min-width: 100%;" name="color">
                                @foreach ($colors as $color)
                                    <option value="{{ $color }}">{{ $color }}</option>
                                @endforeach
                                {{-- <option value="">Red</option>
                                <option value="">Black</option> --}}
                            </select>
                        </div>
                        @endisset
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <span style="text-info"><b>Quantity</b> </span><br>
                            <input type="number" min="1" max="100" name="qty" class="form-control" value="1" >
                        </div>
                    </div>
                    <div class="mt-3">
                        @if($product->stock_quantity < 1)
                        <button type="submit" class="btn btn-danger" disabled>Out of Stock</button>
                            @else
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                            @endif
                        {{-- <button class="btn btn-primary">Add to Cart</button> --}}
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>




<script>
    $('#add_cart_form').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        // alert(url)
        $.ajax({
            type: 'POST',
            url: url,
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#add_cart_form')[0].reset();
                cart();
            }
        });
    });
</script>
