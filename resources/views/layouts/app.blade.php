<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.css">
    <link href="{{ asset('public/frontend') }}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/responsive.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- toster link --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    {{-- toster link --}}

    <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- DataTables -->


</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/phone.png" alt=""></div>{{ $setting->phone_one }}</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/mail.png" alt=""></div><a href="mailto:{{ $setting->main_email }}"><span class="__cf_email__" data-cfemail="">{{ $setting->main_email }}</span></a></div>

                        {{-- <div class="user_icon"><img src="{{ asset('public/frontend') }}/images/user.svg" alt=""></div> --}}
						<div class="top_bar_content ml-auto">
                            @if(Auth::check())

							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">{{ Auth::user()->name }}<i class="fas fa-chevron-down"></i></a>
										<ul style="width: 150px">
											<li><a href="{{ route('home') }}">Profile</a></li>
											<li><a href="{{ route('user.logout') }}">Logout</a></li>
										</ul>
									</li>
								</ul>
							</div>
                            @endif

                            @guest
							<div class="top_bar_user">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#" data-toggle="modal" data-target="#loginModal">Login<i class="fas fa-chevron-down" ></i></a>
										{{-- <ul style="width: 300px; padding: 10px;">
											<div>
                                                <br>
                                                <form action="{{ route('login') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                                                    </div>
                                                    <button type="submit" class="btn btn-info btn-sm">Login</button>
                                                </form>
                                            </div>
										</ul> --}}
									</li>
									<li>
										<a href="{{ route('register.user') }}">Register</a>

									</li>
								</ul>
							</div>
                            @endguest
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="{{ url('/') }}"><img style="width: 65%; height: 80px;" class="rounded-5" src="{{ asset($setting->logo) }}" alt="" srcset=""></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													<li><a class="clc" href="#">Computers</a></li>
													<li><a class="clc" href="#">Laptops</a></li>
													<li><a class="clc" href="#">Cameras</a></li>
													<li><a class="clc" href="#">Hardware</a></li>
													<li><a class="clc" href="#">Smartphones</a></li>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{ asset('public/frontend') }}/images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

                    @php
                        $wishlist = DB::table('wishlists')->where('user_id',Auth::id())->count();
                    @endphp
					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{ asset('public/frontend') }}/images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{ route('wishlist') }}">Wishlist</a></div>
									<div class="wishlist_count">{{ $wishlist }}</div>
								</div>
							</div>

							<!-- Cart -->
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{ asset('public/frontend') }}/images/cart.png" alt="">
										<div class="cart_count"><span class="cart_qty"></span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{ route('cart.page') }}">Cart</a></div>
										<div class="cart_price">{{ $setting->currency }}<span class="cart_total"></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



        {{-- main navbar for yield --}}
        @yield('navbar')

	</header>

	@yield('content')

	<!-- Footer -->
	@include('layouts.front_partial.footer')


</div>

{{-- category add modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="loginModalLabel">Login</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- category add modal --}}

<script src="{{ asset('public/frontend') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('public/frontend') }}/styles/bootstrap4/popper.js"></script>
<script src="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{ asset('public/frontend') }}/plugins/easing/easing.js"></script>
<script src="{{ asset('public/frontend') }}/js/custom.js"></script>

<script src="{{ asset('public/frontend') }}/js/product_custom.js"></script>

  {{-- toster cdn link --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  {{-- toster cdn link --}}

  <!-- DataTables  & Plugins -->
<script src="{{ asset('public/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<script>
    function cart() {
        $.ajax({
            method: 'get',
            url: '{{ route('all.cart') }}',
            dataType: 'json',
            success: function(data) {
                // alert(data);
                $('.cart_qty').empty();
                $('.cart_total').empty();
                $('.cart_qty').append(data.cart_qty);
                $('.cart_total').append(data.cart_total);
        }
        });
    }
    $(document).ready(function(event) {
        cart();
    });
</script>

{{-- toastr message --}}
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':

                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();
                break;
            case 'success':

                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'warning':

                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
            case 'error':

                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
                var audio = new Audio('audio.mp3');
                audio.play();

                break;
        }
    @endif
</script>
{{-- toastr message --}}

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>


</body>


</html>
