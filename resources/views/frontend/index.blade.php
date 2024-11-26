@extends('layouts.app')
@section('navbar')
    <!-- Main Navigation -->
    @include('layouts.front_partial.main_nav')
    <!-- Menu -->
@endsection
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner_background"
            style="background-image:url({{ asset('public/frontend') }}/images/banner_background.jpg)"></div>
        <div class="container fill_height">
            {{-- <div class="row fill_height">
            <div class="banner_product_image"><img src="{{ asset('public/frontend') }}/images/banner_product.png" alt=""></div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">new era of smartphones</h1>
                    <div class="banner_price"><span>$530</span>$460</div>
                    <div class="banner_product_name">Apple Iphone 6s</div>
                    <div class="button banner_button"><a href="#">Shop Now</a></div>
                </div>
            </div>
        </div> --}}

            <div class="row fill_height">
                <div class="banner_product_image">
                    <img src="{{ asset('public/files/product/' . $banner_product->product_thumbnail) }}" alt="">
                </div>

                <div class="col-lg-5 offset-lg-4 fill_height">
                    <div class="banner_content">
                        <h1 class="banner_text">{{ $banner_product->product_name }}</h1>
                        <div class="banner_price">
                            @if ($banner_product->discount_price == null)
                                {{ $setting->currency }} {{ $banner_product->selling_price }}
                            @else
                                <span> {{ $setting->currency }} {{ $banner_product->selling_price }}</span>
                                {{ $setting->currency }} {{ $banner_product->discount_price }}
                            @endif
                        </div>
                        <div class="banner_product_name">{{ $banner_product->brand->brand_name }}</div>
                        <div class="button banner_button"><a
                                href="{{ route('product.details', $banner_product->product_slug) }}">Shop Now</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Characteristics -->

    <div class="characteristics">
        <div class="container">
            <div class="row">

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend') }}/images/char_1.png" alt="">
                        </div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend') }}/images/char_2.png" alt="">
                        </div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend') }}/images/char_3.png" alt="">
                        </div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend') }}/images/char_4.png" alt="">
                        </div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from $50</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deals of the week -->

    <div class="deals_featured">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                    <!-- Deals -->

                    <div class="deals">
                        <div class="deals_title">Deals of the Week</div>
                        <div class="deals_slider_container">

                            <!-- Deals Slider -->
                            <div class="owl-carousel owl-theme deals_slider">

                                <!-- Deals Item -->
                                <div class="owl-item deals_item">
                                    <div class="deals_image"><img src="{{ asset('public/frontend') }}/images/deals.png"
                                            alt=""></div>
                                    <div class="deals_content">
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_category"><a href="#">Headphones</a></div>
                                            <div class="deals_item_price_a ml-auto">$300</div>
                                        </div>
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_name">Beoplay H7</div>
                                            <div class="deals_item_price ml-auto">$225</div>
                                        </div>
                                        <div class="available">
                                            <div class="available_line d-flex flex-row justify-content-start">
                                                <div class="available_title">Available: <span>6</span></div>
                                                <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                                            </div>
                                            <div class="available_bar"><span style="width:17%"></span></div>
                                        </div>
                                        <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                            <div class="deals_timer_title_container">
                                                <div class="deals_timer_title">Hurry Up</div>
                                                <div class="deals_timer_subtitle">Offer ends in:</div>
                                            </div>
                                            <div class="deals_timer_content ml-auto">
                                                <div class="deals_timer_box clearfix" data-target-time="">
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deals Item -->
                                <div class="owl-item deals_item">
                                    <div class="deals_image"><img src="{{ asset('public/frontend') }}/images/deals.png"
                                            alt=""></div>
                                    <div class="deals_content">
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_category"><a href="#">Headphones</a></div>
                                            <div class="deals_item_price_a ml-auto">$300</div>
                                        </div>
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_name">Beoplay H7</div>
                                            <div class="deals_item_price ml-auto">$225</div>
                                        </div>
                                        <div class="available">
                                            <div class="available_line d-flex flex-row justify-content-start">
                                                <div class="available_title">Available: <span>6</span></div>
                                                <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                                            </div>
                                            <div class="available_bar"><span style="width:17%"></span></div>
                                        </div>
                                        <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                            <div class="deals_timer_title_container">
                                                <div class="deals_timer_title">Hurry Up</div>
                                                <div class="deals_timer_subtitle">Offer ends in:</div>
                                            </div>
                                            <div class="deals_timer_content ml-auto">
                                                <div class="deals_timer_box clearfix" data-target-time="">
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer2_hr" class="deals_timer_hr"></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer2_min" class="deals_timer_min"></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer2_sec" class="deals_timer_sec"></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deals Item -->
                                <div class="owl-item deals_item">
                                    <div class="deals_image"><img src="{{ asset('public/frontend') }}/images/deals.png"
                                            alt=""></div>
                                    <div class="deals_content">
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_category"><a href="#">Headphones</a></div>
                                            <div class="deals_item_price_a ml-auto">$300</div>
                                        </div>
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_name">Beoplay H7</div>
                                            <div class="deals_item_price ml-auto">$225</div>
                                        </div>
                                        <div class="available">
                                            <div class="available_line d-flex flex-row justify-content-start">
                                                <div class="available_title">Available: <span>6</span></div>
                                                <div class="sold_title ml-auto">Already sold: <span>28</span></div>
                                            </div>
                                            <div class="available_bar"><span style="width:17%"></span></div>
                                        </div>
                                        <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                            <div class="deals_timer_title_container">
                                                <div class="deals_timer_title">Hurry Up</div>
                                                <div class="deals_timer_subtitle">Offer ends in:</div>
                                            </div>
                                            <div class="deals_timer_content ml-auto">
                                                <div class="deals_timer_box clearfix" data-target-time="">
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer3_hr" class="deals_timer_hr"></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer3_min" class="deals_timer_min"></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer3_sec" class="deals_timer_sec"></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="deals_slider_nav_container">
                            <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i>
                            </div>
                            <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="featured">
                        <div class="tabbed_container">
                            <div class="tabs">
                                <ul class="clearfix">
                                    <li class="active">Featured</li>
                                    <li>Most Popular</li>
                                    {{-- <li>Best Rated</li> --}}
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>

                            <!-- feature product Panel -->
                            <div class="product_panel panel active">
                                <div class="featured_slider slider">

                                    @foreach ($featured as $feature)
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item m-2">
                                        <div class="border_active"></div>
                                        <div
                                            class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div
                                                class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{ asset('public/files/product/' . $feature->product_thumbnail) }}" alt="{{ $feature->product_name }}" style="width: 80%; height: 100%;"></div>
                                            <div class="product_content">
                                                {{-- <div class="product_price discount">$225<span>$300</span></div> --}}

                                                @if($feature->discount_price == null)
                                                    <div class="product_price discount" style="color: #ff6f61; font-size: 16px;">
                                                        {{ $setting->currency }} {{ $feature->selling_price }}
                                                    </div>
                                                @else
                                                    <div class="product_price discount">
                                                        <span  style="font-size: 16px; color: #ff6f61">{{ $setting->currency }} {{ $feature->discount_price }}</span>
                                                        <span ><del>{{ $setting->currency }} {{ $feature->selling_price }}</del></span>
                                                    </div>
                                                @endif

                                                <div class="product_name">
                                                    <div><a href="{{ route('product.details', $feature->product_slug) }}">{{ substr($feature->product_name, 0, 20) }}</a></div>
                                                </div>
                                                <div class="product_extras mt-2">
                                                    <a href="#" id="{{ $feature->id }}" class="quick_view" data-toggle="modal" data-target="#quickModal"> Quick View </a>

                                                    <button class="product_cart_button btn-sm">Add to Cart</button>
                                                </div>
                                            </div>
                                            <a href="{{ route('add.wishlist',$feature->id) }}">
                                                <div class="product_fav btn-outline-info">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                            </a>
                                            @if($feature->discount_price != null)
                                            <ul class="product_marks">
                                                @php
                                                    $discountPercentage = round((($feature->selling_price - $feature->discount_price) / $feature->selling_price) * 100);
                                                @endphp
                                                <li class="product_mark product_discount">-{{ $discountPercentage }}%</li>
                                                {{-- <li class="product_mark product_new">new</li> --}}
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>
                            {{-- end fearture product --}}

                            <!-- most popular part -->
                            <div class="product_panel panel">
                                <div class="featured_slider slider">

                                    @foreach ($popular_products as $row)
                                    <!-- Slider Item -->
                                    <div class="featured_slider_item m-2">
                                        <div class="border_active"></div>
                                        <div
                                            class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div
                                                class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="{{ $row->product_name }}" style="width: 80%; height: 100%;"></div>
                                            <div class="product_content">
                                                {{-- <div class="product_price discount">$225<span>$300</span></div> --}}

                                                @if($row->discount_price == null)
                                                    <div class="product_price discount" style="color: #ff6f61; font-size: 16px;">
                                                        {{ $setting->currency }} {{ $row->selling_price }}
                                                    </div>
                                                @else
                                                    <div class="product_price discount">
                                                        <span  style="font-size: 16px; color: #ff6f61">{{ $setting->currency }} {{ $row->discount_price }}</span>
                                                        <span ><del>{{ $setting->currency }} {{ $row->selling_price }}</del></span>
                                                    </div>
                                                @endif

                                                <div class="product_name">
                                                    <div><a href="{{ route('product.details', $row->product_slug) }}">{{ substr($row->product_name, 0, 20) }}</a></div>
                                                </div>
                                                <div class="product_extras mt-2">
                                                    {{-- <a type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#quickModal"> Quick View </a> --}}

                                                    <a href="#" id="{{ $row->id }}" class="quick_view" data-toggle="modal" data-target="#quickModal"> Quick View </a>

                                                    <button class="product_cart_button btn-sm">Add to Cart</button>
                                                </div>
                                            </div>
                                            <a href="{{ route('add.wishlist',$row->id) }}">
                                                <div class="product_fav btn-outline-info">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                            </a>
                                            @if($row->discount_price != null)
                                            <ul class="product_marks">
                                                @php
                                                    $discountPercentage = round((($row->selling_price - $row->discount_price) / $row->selling_price) * 100);
                                                @endphp
                                                <li class="product_mark product_discount">-{{ $discountPercentage }}%</li>
                                                {{-- <li class="product_mark product_new">new</li> --}}
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>
                            {{-- end most popular product --}}

                            <!-- Product Panel -->

                            {{-- <div class="product_panel panel">
                                <div class="featured_slider slider">

                                    <!-- Slider Item -->
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div
                                            class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <div
                                                class="product_image d-flex flex-column align-items-center justify-content-center">
                                                <img src="images/featured_1.png" alt=""></div>
                                            <div class="product_content">
                                                <div class="product_price discount">$225<span>$300</span></div>
                                                <div class="product_name">
                                                    <div><a href="product.html">Huawei MediaPad...</a></div>
                                                </div>
                                                <div class="product_extras">
                                                    <div class="product_color">
                                                        <input type="radio" checked name="product_color"
                                                            style="background:#b19c83">
                                                        <input type="radio" name="product_color"
                                                            style="background:#000000">
                                                        <input type="radio" name="product_color"
                                                            style="background:#999999">
                                                    </div>
                                                    <button class="product_cart_button">Add to Cart</button>
                                                </div>
                                            </div>
                                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                                            <ul class="product_marks">
                                                <li class="product_mark product_discount">-25%</li>
                                                <li class="product_mark product_new">new</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div> --}}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->

    <div class="popular_categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title">Popular Categories</div>
                        <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i
                                    class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i
                                    class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                        <div class="popular_categories_link"><a href="#">full catalog</a></div>
                    </div>
                </div>

                <!-- Popular Categories Slider -->

                <div class="col-lg-9">
                    <div class="popular_categories_slider_container">
                        <div class="owl-carousel owl-theme popular_categories_slider">

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div
                                    class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="images/popular_1.png"
                                            alt=""></div>
                                    <div class="popular_category_text">Smartphones & Tablets</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div
                                    class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="images/popular_2.png"
                                            alt=""></div>
                                    <div class="popular_category_text">Computers & Laptops</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div
                                    class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="images/popular_3.png"
                                            alt=""></div>
                                    <div class="popular_category_text">Gadgets</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div
                                    class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="images/popular_4.png"
                                            alt=""></div>
                                    <div class="popular_category_text">Video Games & Consoles</div>
                                </div>
                            </div>

                            <!-- Popular Categories Item -->
                            <div class="owl-item">
                                <div
                                    class="popular_category d-flex flex-column align-items-center justify-content-center">
                                    <div class="popular_category_image"><img src="images/popular_5.png"
                                            alt=""></div>
                                    <div class="popular_category_text">Accessories</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Hot New Arrivals -->
    @foreach ($home_category as $row)
    @php
        $cat_product = DB::table('products')->where('category_id',$row->id)->where('status',1)->orderBy('id','desc')->limit(24)->get();
    @endphp
    @if($cat_product->isNotEmpty())
    <div class="new_arrivals">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">{{ $row->category_name }}</div>
                            <ul class="clearfix">
                                <li><a href="#">View More</a></li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:1;">

                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">
                                        @foreach ($cat_product as $row)
                                        <!-- Slider Item -->
                                        <div class="arrivals_slider_item">
                                            <div class="border_active"></div>
                                            <div
                                                class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                                <div
                                                    class="product_image d-flex flex-column align-items-center justify-content-center">
                                                    <img style="width: 80%; height: 100%;" src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="" srcset=""></div>
                                                <div class="product_content">
                                                    {{-- <div class="product_price">$225</div> --}}


                                                    @if($row->discount_price == null)
                                                    <div class="product_price" style="color: #ff6f61; font-size: 16px;">
                                                        {{ $setting->currency }} {{ $row->selling_price }}
                                                    </div>
                                                @else
                                                    <div class="product_price">
                                                        <span  style="font-size: 16px; color: #ff6f61">{{ $setting->currency }} {{ $row->discount_price }}</span>
                                                        <span ><del>{{ $setting->currency }} {{ $row->selling_price }}</del></span>
                                                    </div>
                                                @endif


                                                    <div class="product_name">
                                                        <div><a href="{{ route('product.details', $row->product_slug) }}">{{ substr($row->product_name, 0, 20) }}</a></div>
                                                    </div>
                                                    <div class="product_extras">
                                                        {{-- <div class="product_color">

                                                        </div> --}}
                                                        <a href="#" id="{{ $row->id }}" class="quick_view" data-toggle="modal" data-target="#quickModal"> Quick View </a>
                                                        <button class="product_cart_button btn-sm">Add to Cart</button>
                                                    </div>



                                                </div>
                                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                @if($row->discount_price != null)
                                                    <ul class="product_marks">
                                                        @php
                                                            $discountPercentage = round((($row->selling_price - $row->discount_price) / $row->selling_price) * 100);
                                                        @endphp
                                                        <li class="product_mark product_new bg-danger">-{{ $discountPercentage }}%</li>
                                                        {{-- <li class="product_mark product_new">new</li> --}}
                                                    </ul>
                                                    @endif
                                            </div>
                                        </div>

                                        @endforeach

                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach



    <!-- Adverts -->

    {{-- <div class="adverts">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_title"><a href="#">Trends 2018</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</div>
                        </div>
                        <div class="ml-auto">
                            <div class="advert_image"><img src="images/adv_1.png" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_subtitle">Trends 2018</div>
                            <div class="advert_title_2"><a href="#">Sale -45%</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                        </div>
                        <div class="ml-auto">
                            <div class="advert_image"><img src="images/adv_2.png" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_title"><a href="#">Trends 2018</a></div>
                            <div class="advert_text">Lorem ipsum dolor sit amet, consectetur.</div>
                        </div>
                        <div class="ml-auto">
                            <div class="advert_image"><img src="images/adv_3.png" alt=""></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <!-- Trends -->

    <div class="trends">
        <div class="trends_background" style="background-image:url(images/trends_background.jpg)"></div>
        <div class="trends_overlay"></div>
        <div class="container">
            <div class="row">

                <!-- Trends Content -->
                <div class="col-lg-3">
                    <div class="trends_container">
                        <h2 class="trends_title">Trendy Product</h2>
                        <div class="trends_text">
                            <p>This year best trendy product for you</p>
                        </div>
                        <div class="trends_slider_nav">
                            <div class="trends_prev trends_nav btn-outline-primary"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="trends_next trends_nav btn-outline-primary"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Trends Slider -->
                <div class="col-lg-9">
                    <div class="trends_slider_container">
                        <!-- Trends Slider -->
                        <div class="owl-carousel owl-theme trends_slider">
                            @foreach ($trendy_product as $row)
                            <!-- Trends Slider Item -->
                            <div class="owl-item">
                                <div class="trends_item is_new">
                                    <div
                                        class="trends_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="{{ $row->product_name }}" style="width: 80%; height: 100%;"></div>
                                    <div class="trends_content">
                                        <div class="trends_category">
                                            <a href="#">{{ $row->category->category_name }}</a>

                                            @if($row->discount_price == null)
                                            <div class="trends_price" style="color: #ff6f61;">
                                                {{ $setting->currency }} {{ $row->selling_price }}
                                            </div>
                                        @else
                                            <div class="trends_price">
                                                <span  style="color: #ff6f61">{{ $setting->currency }} {{ $row->discount_price }}</span>
                                                <span ><del>{{ $setting->currency }} {{ $row->selling_price }}</del></span>
                                            </div>
                                        @endif

                                            {{-- <div class="trends_price">$379</div> --}}
                                        </div>
                                        <div class="trends_info clearfix">
                                            <div class="trends_name"><a href="{{ route('product.details', $row->product_slug) }}">{{ substr($row->product_name, 0, 20) }}</a></div>
                                        </div>
                                    </div>

                                    <ul class="trends_marks">
                                        {{-- <li class="trends_mark trends_discount">-25%</li> --}}
                                        <a href="#" id="{{ $row->id }}" class="trends_mark trends_new quick_view" data-toggle="modal" data-target="#quickModal"><i class="fa fa-eye"></i></a>

                                        {{-- <a href="#" id="{{ $row->id }}" class="quick_view" data-toggle="modal" data-target="#quickModal"> Quick View </a> --}}
                                    </ul>
                                    <a href="{{ route('add.wishlist',$row->id) }}">
                                        <div class="trends_fav btn-outline-info"><i class="fas fa-heart"></i></div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Reviews -->

    <div class="reviews">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="reviews_title_container">
                        <h3 class="reviews_title">Latest Reviews</h3>
                        <div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
                    </div>

                    <div class="reviews_slider_container">

                        <!-- Reviews Slider -->
                        <div class="owl-carousel owl-theme reviews_slider">

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="images/review_1.jpg" alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Roberto Sanchez</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="images/review_2.jpg" alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Brandon Flowers</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="images/review_3.jpg" alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Emilia Clarke</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="images/review_1.jpg" alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Roberto Sanchez</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="images/review_2.jpg" alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Brandon Flowers</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews Slider Item -->
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img src="images/review_3.jpg" alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">Emilia Clarke</div>
                                        <div class="review_rating_container">
                                            <div class="rating_r rating_r_4 review_rating">
                                                <i></i><i></i><i></i><i></i><i></i></div>
                                            <div class="review_time">2 day ago</div>
                                        </div>
                                        <div class="review_text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum
                                                laoreet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="reviews_dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Recently Viewed</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="images/view_1.jpg" alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$225<span>$300</span></div>
                                        <div class="viewed_name"><a href="#">Beoplay H7</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="images/view_2.jpg" alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$379</div>
                                        <div class="viewed_name"><a href="#">LUNA Smartphone</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="images/view_3.jpg" alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$225</div>
                                        <div class="viewed_name"><a href="#">Samsung J730F...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="images/view_4.jpg" alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$379</div>
                                        <div class="viewed_name"><a href="#">Huawei MediaPad...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="images/view_5.jpg" alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$225<span>$300</span></div>
                                        <div class="viewed_name"><a href="#">Sony PS4 Slim</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="images/view_6.jpg" alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">$375</div>
                                        <div class="viewed_name"><a href="#">Speedlink...</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul>
                                </div>
                            </div>
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

                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_1.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_2.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_3.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_4.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_5.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_6.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_7.jpg" alt=""></div>
                            </div>
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="images/brands_8.jpg" alt=""></div>
                            </div>

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
                    <div
                        class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text">
                                <p>...and receive %20 coupon for first shopping.</p>
                            </div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="#" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required"
                                    placeholder="Enter your email address">
                                <button class="newsletter_button">Subscribe</button>
                            </form>
                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="quickModal" tabindex="-1" aria-labelledby="quickModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="quickModalLabel">Quick View Product</h3>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="quick_view_body">

                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}

    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    // $(document).ready(function() {
        $(document).on('click', '.quick_view', function() {
            var quick_id = $(this).attr('id');
            // alert(quick_id)
            $.ajax({
                url: "{{ url('product-quick-view') }}/" + quick_id,
                type: "GET",
                success: function(data) {
                    $('#quick_view_body').html(data);
                },
            });

        });
</script>
@endsection