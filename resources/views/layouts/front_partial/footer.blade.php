@php
    $pages_one = DB::table('pages')->where('page_position',1)->get();
    $pages_two = DB::table('pages')->where('page_position',2)->get();
@endphp

<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 footer_col">
                <div class="footer_column footer_contact">
                    <div class="logo_container">
                        <div class="logo"><a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="" style="width: 65%; height: 80px;"></a></div>
                    </div>
                    <div class="footer_title">Got Question? Call Us 24/7</div>
                    <div class="footer_phone">+88{{ $setting->phone_two }}@if($setting->phone_two != null)
                        , +88{{ $setting->phone_two }}
                    @endif</div>
                    <div class="footer_phone">{{ $setting->main_email }}@if($setting->support_email != null)
                        , {{ $setting->support_email }}
                    @endif</div>
                    <div class="footer_contact_text">
                        {{-- <p>Dhaka</p> --}}
                        <strong>{{ $setting->address }}</strong>
                    </div>
                    <div class="footer_social">
                        <ul>
                            <li><a href="{{ strpos($setting->facebook, 'http') === false ? 'http://' . $setting->facebook : $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>

                            <li><a href="{{ strpos($setting->linkedin, 'http') === false ? 'http://' . $setting->linkedin : $setting->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a></li>

                            <li><a href="{{ strpos($setting->twitter, 'http') === false ? 'http://' . $setting->twitter : $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>

                            <li><a href="{{ strpos($setting->youtube, 'http') === false ? 'http://' . $setting->youtube : $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Other Pages</div>
                    <ul class="footer_list">
                        @foreach($pages_one as $row)
                        <li><a href="{{ route('view.page', $row->page_slug) }}">{{ $row->page_title }}</a></li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <ul class="footer_list footer_list_2">
                        @foreach($pages_two as $row)
                        <li><a href="{{ route('view.page', $row->page_slug) }}">{{ $row->page_title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Customer Care</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('home') }}">My Account</a></li>
                        <li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
                        <li><a href="{{ route('wishlist') }}">Wish List</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Copyright -->

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                    <div class="copyright_content">
                        Copyright &copy;<script data-cfasync="false" src="{{ asset('public/frontend') }}/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Tufan</a>
                        </div>
                        <div class="logos ml-sm-auto">
                        <ul class="logos_list">
                            <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_1.png" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_2.png" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_3.png" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('public/frontend') }}/images/logos_4.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
