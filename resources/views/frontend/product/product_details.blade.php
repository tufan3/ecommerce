@extends('layouts.app')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">

<!-- Main Navigation -->
@include('layouts.front_partial.collaps_nav')
<!-- Menu -->
<!-- Single Product -->

<style>
    .product-info {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    background: #f9f9f9;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    max-width: 400px;
    /* margin: 20px auto; */
}

.product-info h4 {
    /* margin-top: 20px; */
    font-size: 16px;
    color: #555;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.product-info p {
    margin: 5px 0;
}

.product-info .product-video iframe {
    width: 100%;
    height: 200px;
    border-radius: 8px;
}


.stars {
    color: #f0a500;
    font-size: 12px;
}


textarea {
    width: 100%;
    height: 80px;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    resize: none;
}

.btn {
    padding: 10px 15px;
    margin-right: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.select-review {
    background: #f0a500;
    color: #fff;
}

.submit-review {
    background: #007bff;
    color: #fff;
}

.btn:hover {
    opacity: 0.9;
}

.image_list_container {
    max-height: 420px; /* Adjust this height as needed */
    overflow-y: auto;  /* Enable vertical scrollbar */
}

.image_list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.image_list li {
    margin-bottom: 10px; /* Adjust spacing between images */
}


</style>

<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <!-- Images -->
                <div class="col-lg-1 order-lg-1 order-2">
                    <div class="image_list_container">
                        <ul class="image_list">
                            @php
                                $product_images = json_decode($product->product_image, true);
                            @endphp
                           @if (!empty($product_images))
                                @foreach ($product_images as $product_image)
                                    <li data-image="{{ asset('public/files/product/' . $product_image) }}"> <img src="{{ asset('public/files/product/' . $product_image) }}" alt=""> </li>
                                @endforeach
                            @endif
                            <li data-image="{{ asset('public/files/product/' . $product->product_thumbnail) }}"><img src="{{ asset('public/files/product/' . $product->product_thumbnail) }}" alt=""></li>
                        </ul>
                    </div>
                </div>


            <!-- Selected Image -->
            <div class="col-lg-3 order-lg-2 order-1">
                <div class="image_selected"><img style="width: 65%; height: 80px;" src="{{ asset('public/files/product/' . $product->product_thumbnail) }}" alt="" srcset=""></div>
            </div>

            <!-- Description -->
            <div class="col-lg-4 order-3">
                <div class="product_description">
                    <div class="product_category">{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</div>
                    <div class="product_name" style="font-size: 20px">{{ $product->product_name }}</div>

                    @if($product->brand == null)
                    <div class="product_brand">Brand: Not Available</div>
                    @else
                    <div class="product_category"><b>Brand: </b>{{ $product->brand->brand_name }}</div>
                    @endif


                    <div class="product_category"><b>Stock: </b>{{ $product->stock_quantity }}</div>
                    <div class="product_category"><b>Unit: </b>{{ $product->product_unit }}</div>

                    {{-- <div class="product_category"><span class="stars">⭐⭐⭐⭐</span></div> --}}

                    <div class="product_category">
                        <span class="stars">
                            @php
                                // Calculate the number of full stars, half stars, and empty stars
                                $fullStars = floor($average_rating); // Full stars
                                $halfStar = ($average_rating - $fullStars) >= 0.5 ? 1 : 0; // Half star
                                $emptyStars = 5 - $fullStars - $halfStar; // Remaining empty stars
                            @endphp

                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star" style="color: gold;"></i> <!-- Full star -->
                            @endfor

                            @if ($halfStar)
                                <i class="fas fa-star-half-alt" style="color: gold;"></i> <!-- Half star -->
                            @endif

                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="fas fa-star" style="color: black;"></i> <!-- Empty star -->
                            @endfor
                        </span>
                    </div>



                    @if($product->discount_price == null)
                        <div class="product_price" style="margin: 20px 0px 0px 0px; color: #ff6f61;">
                            {{ $setting->currency }} {{ $product->selling_price }}
                        </div>
                    @else
                        <div class="" style="margin: 20px 0px 0px 0px;">
                            <span  style="font-size: 25px;color: #ff6f61">{{ $setting->currency }} {{ $product->discount_price }}</span>
                            <br>
                            <span style="font-size: 18px;"><del>{{ $setting->currency }} {{ $product->selling_price }}</del></span>
                            @php
                                $discountPercentage = round((($product->selling_price - $product->discount_price) / $product->selling_price) * 100);
                            @endphp
                            <span style="color: #ff6f61;">-{{ $discountPercentage }}%</span>
                        </div>
                    @endif

                    <div class="order_info d-flex flex-row mt-4">
                        <form action="#">
                            <div class="row">
                                @isset($product->size)
                                <div class="col-lg-6">
                                    <label for="size-select">Size</label><br>

                                    @php
                                        $sizes = explode(',', $product->size);
                                    @endphp

                                    <select class="custom-select form-control-sm ml-0" style="color: #000000; min-width: 100%;" name="size">
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size }}">{{ ucfirst($size) }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                @endisset

                                @isset($product->color)
                                <div class="col-lg-6">
                                    <label for="color-select">Color</label><br>
                                    @php
                                        $colors = explode(',', $product->color);
                                    @endphp

                                    <select class="custom-select form-control-sm ml-0" style="color: #000000; min-width: 100%;" name="color">
                                        @foreach ($colors as $color)
                                            <option value="{{ $color }}">{{ ucfirst($color) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endisset
                            </div>

                            <br>
                            <div class="clearfix" style="z-index: 1000;">

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
                                    <span style="text-info">Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[1-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>

                            </div>
                            <div class="button_container">
                                {{-- <button type="button" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i>dbdb</div> --}}

                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-primary">Add to Cart</button>
                                    <a href="{{ route('add.wishlist',$product->id) }}" type="submit" class="btn btn-outline-info"><i class="fas fa-heart"></i></a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-3">
                <div class="product-info">
                    <h4>Pickup Point of this product</h4>
                    @if($product->pickup_point_id != null || $product->pickup_point_id != 0)
                    <p> <i class="fas fa-map-marker-alt"></i> {{ $product->pickup_point->pickup_point_address }}</p>@endif

                    <h4>Home Delivery :</h4>
                    <p>-> (4-8) days after the order placed.</p>
                    @if($product->cash_on_delivery == 1)
                    <p>-> Cash on Delivery Available.</p>
                    @else
                    <p>-> Cash on Delivery Not Available.</p>
                    @endif
                    <h4>Product Return & Warranty :</h4>
                    <p>-> 7 days return guaranty.</p>
                    <p>-> Warranty not available.</p>
                    @isset($product->product_video)
                    <h4>Product Video :</h4>
                    <div class="product-video">
                        <iframe
                            src="https://www.youtube.com/embed/{{ $product->product_video }}"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>
                    </div>
                    @endisset
                </div>
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product details of {{ $product->product_name }}</h4>
                    </div>
                    <div class="card-body">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ratings & Reviews of {{ $product->product_name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="average-review">
                                    <strong>Average Review:</strong><br>
                                        @php
                                        $fullStars = floor($average_rating);
                                        $halfStar = ($average_rating - $fullStars) >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                        $total_reviews = array_sum($rating_count->toArray());
                                    @endphp
                                        <span><b>{{ $average_rating }}</b>/5</span><br>
                                        <span>
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star" style="color: gold;"></i>
                                        @endfor

                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt" style="color: gold;"></i>
                                        @endif

                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="fas fa-star" style="color: black;"></i>
                                        @endfor
                                        <span> <strong style="color: #ff6f61;"> {{ $total_reviews }} Reviews</strong></span>
                                        </span>

                                </div>
                            </div>
                            <div class="col-3">
                                Total Review of this Product.
                                @php
                                    $five_count = $rating_count[5] ?? 0;
                                    $four_count = $rating_count[4] ?? 0;
                                    $three_count = $rating_count[3] ?? 0;
                                    $two_count = $rating_count[2] ?? 0;
                                    $one_count = $rating_count[1] ?? 0;
                                @endphp
                                <div>
                                    <span>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                    </span>
                                    <span style="color: #ff6f61;">Total {{ $five_count }}</span> <br>

                                    <span>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                    </span>
                                    <span style="color: #ff6f61;">Total {{ $four_count }}</span> <br>

                                    <span>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                    </span>
                                    <span style="color: #ff6f61;">Total {{ $three_count }}</span> <br>

                                    <span>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                    </span>
                                    <span style="color: #ff6f61;">Total {{ $two_count }}</span> <br>

                                    <span>
                                        <i class="fas fa-star" style="color: gold;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                        <i class="fas fa-star" style="color: black;"></i>
                                    </span>
                                    <span style="color: #ff6f61;">Total {{ $one_count }}</span> <br>
                                </div>
                            </div>
                            <div class="col-6">
                                <form action="{{ route('review.store') }}" method="POST">
                                 @csrf
                                 <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label for="review">Write Your Review</label>
                                    <textarea id="review" name="review" placeholder="Write Your Review" required></textarea>

                                    <select name="rating" class="custom-select form-control-sm ml-0 mb-2" style="min-width: 100%;" required>
                                        <option value="" disabled selected>Select Your Review</option>
                                        <option value="1">1 star</option>
                                        <option value="2">2 star</option>
                                        <option value="3">3 star</option>
                                        <option value="4">4 star</option>
                                        <option value="5">5 star</option>
                                    </select>

                                    @if(Auth::check())
                                    <button type="submit" class="btn submit-review">Submit Review</button>
                                    @else
                                    <p class="text-danger">Please at first login to your account then submit a review</p>
                                    @endif
                                </div>
                            </form>
                            </div>
                        </div>
                        <br>
                        <div><strong>All Review of {{ $product->product_name }}</strong> <hr></div>
                        <div class="row">
                            @foreach($review_all as $review)
                            <div class="card col-lg-5 m-1">
                                <div class="card-header">
                                    <b>{{ $review->user->name }} </b>   ({{ date('d F, Y'), strtotime($review->review_date) }})
                                </div>
                                <div class="card-body">
                                    {{ $review->review }} <br>
                                    @if($review->rating == 5)
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    @elseif($review->rating == 4)
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    @elseif($review->rating == 3)
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    @elseif($review->rating == 2)
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    @elseif($review->rating == 1)
                                    <i class="fas fa-star" style="color: gold;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    <i class="fas fa-star" style="color: black;"></i>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Related Product</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">
                        @foreach ($related_products as $related_product)
                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{ asset('public/files/product/' . $related_product->product_thumbnail) }}" alt=""></div>
                                <div class="viewed_content text-center">
                                    @if($related_product->discount_price == null)
                                        <div class="viewed_price">{{ $setting->currency }} {{ $related_product->selling_price }}</div>
                                    @else
                                         <div class="viewed_price">{{ $setting->currency }} {{ $related_product->discount_price }}<span>{{ $setting->currency }} {{ $related_product->selling_price }}</span></div>
                                    @endif

                                    <div class="viewed_name"><a href="{{ route('product.details',$related_product->product_slug) }}">{{ substr($related_product->product_name, 0, 50) }}</a></div>
                                </div>
                                <ul class="item_marks">
                                    @php
                                        $discountPercentage = round((($related_product->selling_price - $related_product->discount_price) / $related_product->selling_price) * 100);
                                    @endphp
                                    @if($related_product->discount_price != null)
                                    <li class="item_mark item_discount">-{{ $discountPercentage }}%</li>
                                    @endif
                                    <li class="item_mark item_new">new</li>
                                </ul>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">

                    <!-- Brands Slider -->
                    <div class="owl-carousel owl-theme brands_slider">
                        @foreach ($brands as $brand)
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img style="width: 120px; height: 40px;" src="{{ asset($brand->brand_logo) }}" alt=""></div></div>
                        @endforeach
                    </div>

                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{ asset('public/frontend') }}/images/send.png" alt=""></div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="#" class="newsletter_form">
                            <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                            <button class="newsletter_button">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="{{ asset('public/frontend') }}/js/product_custom.js"></script> --}}
@endsection
