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
			<h2 class="home_title">Campaign Products</h2>
		</div>
	</div>

	<!-- Shop -->

	<div class="shop">
		<div class="container">
			<div class="row">
				{{-- <div class="col-lg-12">

				</div> --}}

				<div class="col-lg-12">

					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{ count($product) }}</span> products found</div>
						</div>

						<div class="product_grid row">
							<div class="product_grid_border"></div>
                            @foreach ($product as $row)

                            <div class="product_item discount col-lg-2">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img style="width: 100%; height: 100%;" src="{{ asset('public/files/product/' . $row->product_thumbnail) }}" alt="" srcset=""></div>
								<div class="product_content">
									{{-- <div class="product_price">$225<span>$300</span></div> --}}

                                    {{-- @if($row->discount_price == null) --}}
                                        <div class="product_price">
                                            {{ $setting->currency }}{{ $row->price }}
                                        </div>
                                    {{-- @else --}}

                                    {{-- <div class="product_price">{{ $setting->currency }}{{ $row->discount_price }}<span>{{ $setting->currency }}{{ $row->price }}</span></div>
                                    @endif --}}

									<div class="product_name"><div><a href="{{ route('product.details', $row->product_slug) }}" tabindex="0">{{ $row->product_name }}</a></div></div>
								</div>
								<a href="{{ route('add.wishlist',$row->product_id) }}"><div class="product_fav"><i class="fas fa-heart"></i></div></a>
								<ul class="product_marks">
									<li class="product_mark product_discount bg-info"><a href="#" id="{{ $row->product_id }}" class="quick_view" data-toggle="modal" data-target="#quickModal"> <i class="fas fa-eye text-white"></i> </a></li>
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
