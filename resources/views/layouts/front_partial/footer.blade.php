<footer class="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 footer_col">
                <div class="footer_column footer_contact">
                    <div class="logo_container">
                        <div class="logo"><a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="" style="width: 65%; height: 80px;"></a></div>
                    </div>
                    <div class="footer_title">Got Question? Call Us 24/7</div>
                    <div class="footer_phone">+88{{ $setting->phone_one }}@if($setting->phone_two != null)
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

                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            {{-- <li><a href="#"><i class="fab fa-google"></i></a></li> --}}
                            {{-- <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Find it Fast</div>
                    <ul class="footer_list">
                        <li><a href="#">Computers & Laptops</a></li>
                        <li><a href="#">Cameras & Photos</a></li>
                        <li><a href="#">Hardware</a></li>
                        <li><a href="#">Smartphones & Tablets</a></li>
                        <li><a href="#">TV & Audio</a></li>
                    </ul>
                    <div class="footer_subtitle">Gadgets</div>
                    <ul class="footer_list">
                        <li><a href="#">Car Electronics</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <ul class="footer_list footer_list_2">
                        <li><a href="#">Video Games & Consoles</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Cameras & Photos</a></li>
                        <li><a href="#">Hardware</a></li>
                        <li><a href="#">Computers & Laptops</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Customer Care</div>
                    <ul class="footer_list">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Order Tracking</a></li>
                        <li><a href="#">Wish List</a></li>
                        <li><a href="#">Customer Services</a></li>
                        <li><a href="#">Returns / Exchange</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Product Support</a></li>
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
