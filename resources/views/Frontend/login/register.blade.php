<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta name="keywords" content="Genius, Ocean, Sea, Etc">
      <meta name="author" content="GeniusOcean">
      <title>Hyip Investment Platform</title>
      <!-- Essential CSS files -->
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/all.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/jquery-ui.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/nice-select.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/animate.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/style.css') }}">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
      <!-- Custom Font CSS -->
      <link rel="stylesheet" id="colorr" href="{{ asset('frontend/assets/front/css/font9f05.css?font_familly=IBM%20Plex%20Sans') }}">
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('frontend/assets/images/Yo7c3v0R1650180806.png') }}">
      <!-- Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137437974-1"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', 'UA-137437974-1');
      </script>
   </head>
   <body>
      <header class="header-section position-relative z-2 header-sticky">
         <div class="container-header">
            <div class="crete-navbar">
               <div class="row align-items-center">
                  <div class="col-lg-2 col-xl-2 col-6">
                     <div class="logo-wrapper">
                        <a href="https://demo.geniusocean.com/hyip-king"> <img src="{{asset('frontend')}}/assets/images/WrK86hHx1659607850.png"
                           alt="logo" class="img-fluid logo-dsgn">
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-7 col-lg-7 d-none d-lg-block">
                     <nav class="crete-navmenu text-center ps-xl-5">
                        <ul>
                           <li class=""><a href="https://demo.geniusocean.com/hyip-king"
                              target="_self">Home</a>
                           </li>
                           <li class=""><a href="../about.html"
                              target="_self">About</a>
                           </li>
                           <li class=""><a href="../plans.html"
                              target="_self">Plans</a>
                           </li>
                           <li class=""><a href="../blogs.html"
                              target="_self">Blog</a>
                           </li>
                           <li class=""><a href="../contact.html"
                              target="_self">Contact Us</a>
                           </li>
                        </ul>
                     </nav>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-6 ">
                     <div
                        class="text-end d-flex align-items-center justify-content-end header-right gap-3 d-none d-lg-block contact-btn-head">
                        <a href="login.html"
                           class="template-btn white-btn d-xl-block contact-btn">Login Now</a>
                     </div>
                     <button type="button" class="header-toggle mobile-menu-toggle d-flex d-lg-none">
                     <span></span>
                     <span></span>
                     <span></span>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- Mobile Menu Start -->
      <div class="mobile-menu">
         <img class="mobile-menu-logo"
            src="{{asset('frontend')}}/assets/product.geniusocean.com/genius-hyip-light/assets/images/ldNavhzl1674033807.png" alt="">
         <a href="javascript:void(0)" class="close"><i class="fas fa-xmark"></i></a>
         <ul class="mobile-nav-menu">
            <li><a href="https://demo.geniusocean.com/hyip-king" target="_self">Home</a>
            </li>
            <li><a href="../about.html" target="_self">About</a>
            </li>
            <li><a href="../plans.html" target="_self">Plans</a>
            </li>
            <li><a href="../blogs.html" target="_self">Blog</a>
            </li>
            <li><a href="../contact.html" target="_self">Contact Us</a>
            </li>
            <div class="mobile-menu-login">
               <a href="contact.html" class="mobile-menu-btn white-btn d-xl-block">Login</a>
            </div>
         </ul>
      </div>
      <!-- Mobile Menu End -->
      <!-- Main Section -->
      <main>
         <div class="breadcrumb-section-login" data-background="{{asset('frontend')}}/assets/images/57U8bXGi1705124911.png">
         </div>
         <div class="login-section">
            <div class="container">
               <div class="row login-rows">
                  <div class="col-lg-6">
                     <div class="login-img">
                        <img src="{{asset('frontend')}}/assets/images/D1I2tyHJ1704876360.png" alt="">
                     </div>
                  </div>
                  <div class="col-lg-6 form-section">
                    <div class="login-form">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('frontend/assets/images/WrK86hHx1659607850.png') }}" alt="logo" />
                            </a>
                        </div>
                        <h4>Create Your Account</h4>
                        <div class="login-form-area">
                            <form id="registerform" action="#" method="POST">
                                @csrf

                                <!-- Full Name -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name">Your Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Full Name">
                                </div>

                                <!-- Phone -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="phone">Phone</label>
                                    <div class="input-group">
                                        <select class="input-group-text m-0 form-label" name="phone_code" id="phone_code">
                                            <option value="880">880</option>
                                        </select>
                                        <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Your Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                </div>

                                <!-- Reference Name -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="ref_name">Reference Name</label>
                                    <input type="text" id="ref_name" name="ref_name" class="form-control" placeholder="Reference Name">
                                </div>

                                <!-- Reference ID -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="ref_id">Reference ID</label>
                                    <input type="text" id="ref_id" name="ref_id" class="form-control" placeholder="Reference ID">
                                </div>

                                <!-- Username -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="username">User Name</label>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="User Name">
                                </div>

                                <!-- Password -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="password">Your Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-outline mb-2">
                                    <label class="form-label" for="confirm-password">Confirm Password</label>
                                    <input type="password" id="confirm-password" name="password_confirmation" class="form-control">
                                </div>

                                <!-- Terms & Conditions -->
                                <div class="row mb-4">
                                    <div class="col d-flex">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="termes" checked>
                                            <label class="form-check-label" for="termes">
                                                I agree with all Terms & Conditions
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="form-btn primary-btn-forms btn-forms mb-4">
                                    Create Account
                                    <div class="spinner-border formSpin" role="status"></div>
                                </button>

                                <!-- Alert Messages -->
                                <div class="position-absolute w-full">
                                    <div class="alert alert-success alert-dismissible fade show" style="display: none;">
                                        <p class="m-0 text-success"></p>
                                    </div>
                                    <div class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                                        <p class="m-0 text-danger"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="social-icon-section">
                            <p class="sign-up-option">Already you have an account in here?
                                <a class="sign-up" href="login.html">Login</a>
                            </p>
                        </div>
                    </div>

                  </div>
               </div>
            </div>
         </div>
         <footer class="footer-section" data-background="{{asset('frontend')}}assets/front/images/Footer-bg.html">
            <div class="container">
               <div class="footer-tops">
                  <div class="row gap-4 gap-md-0 footer-section-row">
                     <div class="col-xl-4 col-lg-3 col-md-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="footer-logo">
                           <img src="{{asset('frontend')}}/assets/images/WrK86hHx1659607850.png" alt="">
                        </div>
                        <div class="footer-paragraph">
                           <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo...</p>
                        </div>
                        <div class="footer-socials-icons">
                           <div class="d-flex gap-2 social-links">
                              <a class="common-icon" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                              <a class="common-icon" href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                              <a class="common-icon" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-2 offset-xl-1 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="footer-links ">
                           <h5 class="p-0 m-0">Useful Links</h5>
                           <hr class="m-0 p-0">
                           <ul>
                              <li>
                                 <a href="../provicay.html">Privacy Policy</a>
                              </li>
                              <li>
                                 <a href="../support-policy.html">Support</a>
                              </li>
                              <li>
                                 <a href="../terms.html">Terms Condition</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-xl-2 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="footer-links ">
                           <h5 class="p-0 m-0">Company</h5>
                           <hr class="m-0 p-0 footer-company-hr">
                           <ul>
                              <li><a href="https://demo.geniusocean.com/hyip-king"
                                 target="_self">Home</a>
                              </li>
                              <li><a href="../about.html"
                                 target="_self">About</a>
                              </li>
                              <li><a href="../plans.html"
                                 target="_self">Plans</a>
                              </li>
                              <li><a href="../blogs.html"
                                 target="_self">Blog</a>
                              </li>
                              <li><a href="../contact.html"
                                 target="_self">Contact Us</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="footer-contact">
                           <h5 class="p-0 m-0">Contact Us</h5>
                           <hr class="m-0 p-0 footer-contact-hr">
                           <ul>
                              <li><i class="fas fa-phone-alt px-1"></i> +0123456789</li>
                              <li><i class="fas fa-envelope px-1"></i>admin@geniusocean.com</li>
                              <li><i class="fas fa-map-marker-alt px-1"></i> New York, United States</li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="bottom-footer-top-hr">
            <div class="footer-bottom">
               <p>COPYRIGHT © 2019. All Rights Reserved By <a href="http://geniusocean.com/">GeniusOcean.com</a></p>
            </div>
         </footer>
      </main>
      <!-- Invest Modal -->
      <div class="modal modal-position fade" id="invest-modal">
         <div class="modal-dialog">
            <div class="modal-content model-area">
               <form class="investForm modal-form" action="https://demo.geniusocean.com/hyip-king/user/invest/amount" method="POST">
                  <input type="hidden" name="_token" value="Gety1CLWTuqmcpc0MjWKHAV1zB7MfyVZDAr9wSFy" autocomplete="off">
                  <div class="modal-body p-4">
                     <h4 class="modal-title text-center plan-title">Basic Plan</h4>
                     <div class="pt-3 pb-1">
                        <label for="amount" class="form-label">Enter Amount</label>
                        <div class="input-group input--group">
                           <input type="number" step="any" name="amount"
                              class="form-group-input form-control form--control bg--section" placeholder="0.00"
                              id="modalAmount">
                           <button type="button" class="input-group-text">USD</button>
                        </div>
                        <label for="amount" class="form-label">Select Wallet</label>
                        <div class="input-group input--group">
                           <select name="wallet" id="investMethod" class="forms nice_select w-100 rounded"
                              required>
                              <option value="checkout">Checkout</option>
                              <option value="main_wallet">Main Balance</option>
                              <option value="interest_wallet">Interest Balance</option>
                           </select>
                        </div>
                     </div>
                     <input type="hidden" name="investId" id="investId" value="">
                     <div class="d-flex gap-3 modal-btns">
                        <button type="button" class="template-btn primary-outline w-50"
                           data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="template-btn primary-btn w-50">Proceed</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Essential JS files -->
      <!-- Essential JS Files -->
      <script src="{{ asset('frontend/assets/front/js/jquery.min.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/popper.min.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/bootstrap.min.js') }}"></script>
      <!-- Plugin JS -->
      <script src="{{ asset('frontend/assets/front/js/slick.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/jquery-ui.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/nice-select.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/wow.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/parallax.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/tilt-js.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/waypoints.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/counterup.min.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/preloader.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/jquery.magnific-popup.min.js') }}"></script>
      <!-- Custom JS -->
      <script src="{{ asset('frontend/assets/front/js/script.js') }}"></script>
      <script src="{{ asset('frontend/assets/front/js/custom.js') }}"></script>
      <script>
         'use strict';
         let mainurl = 'https://demo.geniusocean.com/hyip-king';
         let tawkto = '0';
      </script>
      <script type="text/javascript">
         if (tawkto == 1) {
             var Tawk_API = Tawk_API || {},
                 Tawk_LoadStart = new Date();
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





      </script>
      <script>
         'use strict';

         $('.invest-plan').on('click', function() {
             $('#modalAmount').val('');
             $('#modalAmount').prop('readonly', false)

             let id = $(this).data('id');
             let title = $(this).data('title');
             let type = $(this).data('type');

             if (type == 1) {
                 $('#modalAmount').val($(this).attr('data-fixAmount'));
                 $('#modalAmount').prop('readonly', true)
             }
             $('#investId').val(id);
             $('.plan-title').text(title);
         });

         $(document).on('change', '#investMethod', function() {
             var val = $(this).val();
             if (val == 'checkout') {
                 $('.investForm').prop('action', 'invest/amount.html');
             }

             if (val == 'main_wallet') {
                 $('.investForm').prop('action', 'invest/main.html');
             }

             if (val == 'interest_wallet') {
                 $('.investForm').prop('action', 'invest/interest.html');
             }
         });
      </script>
   </body>
</html>

