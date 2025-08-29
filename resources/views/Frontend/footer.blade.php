@php
    $setting = \App\Models\Setting::first();
@endphp

<footer class="footer-section" data-background="{{ asset('frontend/assets/front/images/Footer-bg.png') }}">
    <div class="container">
        <div class="footer-tops">
            <div class="row gap-4 gap-md-0 footer-section-row">

                <!-- Logo & About -->
                <div class="col-xl-4 col-lg-3 col-md-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="footer-logo">
                        <img src="{{ !empty($setting?->photo)
                                    ? asset('uploads/settings/'.$setting->photo)
                                    : asset('frontend/assets/front/images/default-logo.png') }}"
                             alt="logo" class="img-fluid">
                    </div>
                    <div class="footer-paragraph">
                        <p>{{ $setting->footer_about ?? 'Welcome to our website. Your trusted platform.' }}</p>
                    </div>

                    <!-- Social Icons -->
                    <div class="footer-socials-icons">
                        <div class="d-flex gap-2 social-links">
                            @if(!empty($setting?->linkedin))
                                <a class="common-icon" href="{{ $setting->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if(!empty($setting?->twitter))
                                <a class="common-icon" href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if(!empty($setting?->facebook))
                                <a class="common-icon" href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if(!empty($setting?->instagram))
                                <a class="common-icon" href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if(!empty($setting?->tilegram))
                                <a class="common-icon" href="{{ $setting->tilegram }}"><i class="fab fa-telegram-plane"></i></a>
                            @endif
                            @if(!empty($setting?->youtube))
                                <a class="common-icon" href="{{ $setting->youtube }}"><i class="fab fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Useful Links -->
                <div class="col-xl-2 offset-xl-1 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="footer-links">
                        <h5 class="p-0 m-0">Useful Links</h5>
                        <hr class="m-0 p-0">
                        <ul>
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="support-policy.html">Support</a></li>
                            <li><a href="terms.html">Terms Condition</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Company Links -->
                <div class="col-xl-2 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="footer-links">
                        <h5 class="p-0 m-0">Company</h5>
                        <hr class="m-0 p-0 footer-company-hr">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/plans') }}">Plans</a></li>
                            <li><a href="{{ url('/blogs') }}">Blog</a></li>
                            <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="footer-contact">
                        <h5 class="p-0 m-0">Contact Us</h5>
                        <hr class="m-0 p-0 footer-contact-hr">
                        <ul>
                            <li><i class="fas fa-phone-alt px-1"></i> {{ $setting->phone ?? '+880 123456789' }}</li>
                            <li><i class="fas fa-envelope px-1"></i> {{ $setting->email ?? 'support@example.com' }}</li>
                            <li><i class="fas fa-map-marker-alt px-1"></i> {{ $setting->address ?? 'Dhaka, Bangladesh' }}</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <hr class="bottom-footer-top-hr">

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <p>COPYRIGHT © {{ \Carbon\Carbon::now()->format('Y') }}. All Rights Reserved By
            <a href="#">priceticketbazar.com</a>
        </p>
    </div>
</footer>

<!-- JS Files -->
<script src="{{ asset('frontend/assets/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/slick.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/jquery-ui.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/nice-select.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/wow.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/parallax.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/tilt-js.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/waypoints.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/counterup.min.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/preloader.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/script.js') }}"></script>
<script src="{{ asset('frontend/assets/front/js/custom.js') }}"></script>

<script>
'use strict';
let mainurl = '#';
let tawkto = '0';
</script>

<script type="text/javascript">
if (tawkto == 1) {
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5bc2019c61d0b77092512d03/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
}
</script>

<script>
'use strict';

$('.invest-plan').on('click', function() {
    $('#modalAmount').val('').prop('readonly', false);

    let id = $(this).data('id');
    let title = $(this).data('title');
    let type = $(this).data('type');

    if (type == 1) {
        $('#modalAmount').val($(this).attr('data-fixAmount')).prop('readonly', true);
    }
    $('#investId').val(id);
    $('.plan-title').text(title);
});

$(document).on('change', '#investMethod', function() {
    var val = $(this).val();
    if (val == 'checkout') {
        $('.investForm').prop('action', 'user/invest/amount.html');
    }
    if (val == 'main_wallet') {
        $('.investForm').prop('action', 'user/invest/main.html');
    }
    if (val == 'interest_wallet') {
        $('.investForm').prop('action', 'user/invest/interest.html');
    }
});
</script>
</body>
</html>
