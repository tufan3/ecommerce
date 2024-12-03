@extends('layouts.app')
@section('content')

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css"> --}}

{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_responsive.css">


<!-- Main Navigation -->
@include('layouts.front_partial.collaps_nav')
<!-- Menu -->

<div class="super_container">
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('public/frontend') }}/images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">{{ $subcategory->subcategory_name }}</h2>
		</div>
	</div>

	<!-- Shop -->

    <!-- Brands -->

     <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach ($brand as $row)
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><a href="{{ route('brandwise.product',$row->brand_slug) }}" title="{{ $row->brand_name }}"><img style="width: 100px; height: 50px;" src="{{ asset($row->brand_logo) }}" alt="{{ $row->brand_name }}"></a></div>
                            </div>
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

	<div class="shop">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
                        @if($childcategory->isNotEmpty())
                            <div class="sidebar_section">
                                <div class="sidebar_title">Child Categories</div>
                                <ul class="sidebar_categories">
                                    @foreach ($childcategory as $row)
                                        <li><a href="{{ route('childcategorywise.product', $row->childcategory_slug) }}">{{ $row->childcategory_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            @else
                            <div class="sidebar_section">
                                <div class="sidebar_title">Categories</div>
                                <ul class="sidebar_categories">
                                    @foreach ($category as $row)
                                        <li><a href="{{ route('categorywise.product', $row->category_slug) }}">{{ $row->category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


						<div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div>
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
								<li class="color"><a href="#" style="background: #b19c83;"></a></li>
								<li class="color"><a href="#" style="background: #000000;"></a></li>
								<li class="color"><a href="#" style="background: #999999;"></a></li>
								<li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
								<li class="color"><a href="#" style="background: #df3b3b;"></a></li>
								<li class="color"><a href="#" style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
							</ul>
						</div>
						{{-- <div class="sidebar_section">
							<div class="sidebar_subtitle brands_subtitle">Brands</div>
							<ul class="brands_list">
                                @foreach ($brand as $row)
								<li class="brand"><a href="#">{{ $row->brand_name }}</a></li>
                                @endforeach
							</ul>
						</div> --}}
					</div>

				</div>

				<div class="col-lg-9">

					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{ count($product) }}</span> products found</div>
							<div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>

						<div class="product_grid row">
							<div class="product_grid_border"></div>
                            @foreach ($product as $row)

                            <div class="product_item discount col-lg-2">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img style="width: 100%; height: 100%;" src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="" srcset=""></div>
								<div class="product_content">
									{{-- <div class="product_price">$225<span>$300</span></div> --}}

                                    @if($row->discount_price == null)
                                        <div class="product_price">
                                            {{ $setting->currency }}{{ $row->selling_price }}
                                        </div>
                                    @else

                                    <div class="product_price">{{ $setting->currency }}{{ $row->discount_price }}<span>{{ $setting->currency }}{{ $row->selling_price }}</span></div>
                                    @endif

									<div class="product_name"><div><a href="{{ route('product.details', $row->product_slug) }}" tabindex="0">{{ $row->product_name }}</a></div></div>
								</div>
								<a href="{{ route('add.wishlist',$row->id) }}"><div class="product_fav"><i class="fas fa-heart"></i></div></a>
								<ul class="product_marks">
									<li class="product_mark product_discount bg-info"><a href="#" id="{{ $row->id }}" class="quick_view" data-toggle="modal" data-target="#quickModal"> <i class="fas fa-eye text-white"></i> </a></li>
									{{-- <li class="product_mark product_new is_new"></li> --}}
								</ul>
							</div>

                            @endforeach
						</div>

						<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							<div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
							<ul class="page_nav d-flex flex-row">
								{{ $product->links() }}
							</ul>
							<div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
						</div>

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
                        <h3 class="viewed_title">Product for you</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">
                            @foreach ($recent_view as $row)
                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div
                                    class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="{{ $row->product_name }}" style="width: 80%; height: 100%;"></div>
                                    <div class="viewed_content text-center">

                                        @if($row->discount_price == null)
                                                    <div class="viewed_price" style="color: #ff6f61; font-size: 16px;">
                                                        {{ $setting->currency }} {{ $row->selling_price }}
                                                    </div>
                                                @else
                                                <div class="viewed_price">{{ $setting->currency }} {{ $row->discount_price }}<span>{{ $setting->currency }} {{ $row->selling_price }}</span></div>
                                                @endif

                                        <div class="viewed_name">
                                            {{-- <a href="#" id="{{ $row->id }}" class="quick_view" data-toggle="modal" data-target="#quickModal"> Quick View </a> --}}
                                            <a href="{{ route('product.details', $row->product_slug) }}">{{ substr($row->product_name, 0, 20) }}</a></div>
                                    </div>


                                    @if($row->discount_price != null)
                                    <ul class="item_marks">
                                        @php
                                            $discountPercentage = round((($row->selling_price - $row->discount_price) / $row->selling_price) * 100);
                                        @endphp
                                        <li class="item_mark item_discount">-{{ $discountPercentage }}%</li>
                                        {{-- <li class="item_mark item_new">new</li> --}}
                                    </ul>
                                    @endif

                                    {{-- <ul class="item_marks">
                                        <li class="item_mark item_discount">-25%</li>
                                        <li class="item_mark item_new">new</li>
                                    </ul> --}}
                                </div>
                            </div>
                            @endforeach

                        </div>
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
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
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


{{-- <script src="{{ asset('public/frontend') }}/js/cart_custom.js"></script> --}}
{{-- <script src="{{ asset('public/frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/parallax-js-master/parallax.min.js"></script> --}}
<script src="{{ asset('public/frontend') }}/js/shop_custom.js"></script>


 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

 {{-- <script>
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
 </script> --}}

 <script>
     $(document).on('click', '.quick_view', function() {
     var quick_id = $(this).attr('id');

     $('#quick_view_body').html(`
         <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
             <i class="fas fa-spinner fa-spin" style="font-size: 2rem;"></i>
         </div>
     `);

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
