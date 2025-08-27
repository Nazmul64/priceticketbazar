<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!-- SEO Meta Tags -->
      <meta name="keywords" content="Genius, Ocean, Sea, Etc">
      <meta name="author" content="GeniusOcean" />
      <title>Price Ticket Bazar</title>
      <!-- Essential CSS Files -->
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/all.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/jquery-ui.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/nice-select.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/animate.css') }}">
      <link rel="stylesheet" href="{{ asset('frontend/assets/front/css/style.css') }}">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
      <link rel="stylesheet" id="colorr" href="{{ asset('frontend/assets/front/css/font9f05.css?font_familly=IBM%20Plex%20Sans') }}">
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('frontend/assets/images/Yo7c3v0R1650180806.png') }}">
      <!-- Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137437974-1"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag() {
             dataLayer.push(arguments);
         }
         gtag('js', new Date());
         gtag('config', 'UA-137437974-1');
      </script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    @if (Session::has('success') || Session::has('error'))
    @php
        $successMessage = Session::get('success');
        $errorMessage = Session::get('error');
    @endphp

    <script>
    $(document).ready(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: 5000
        };

        @if ($errorMessage)
            toastr.error("{{ $errorMessage }}");
        @endif

        @if ($successMessage)
            toastr.success("{{ $successMessage }}");
        @endif
    });
    </script>
    @endif
   </head>
   @php
        $setting =\App\Models\Setting::first();
   @endphp
   <body>
      <header class="header-section position-relative z-2 header-sticky">
         <div class="container-header">
            <div class="crete-navbar">
               <div class="row align-items-center">
                  <div class="col-lg-2 col-xl-2 col-6">
                     <div class="logo-wrapper">
                        <a href="https://demo.geniusocean.com/hyip-king"> <img src="{{asset('uploads/settings/'.$setting->photo)}}"
                           alt="logo" class="img-fluid logo-dsgn" style="height: 60px; width: auto;">
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-7 col-lg-7 d-none d-lg-block">
                     <nav class="crete-navmenu text-center ps-xl-5">
                        <ul>
                           <li class="active"><a href="{{route('frontend')}}"
                              target="_self">Home</a>
                           </li>
                           <li class=""><a href="#about"
                              target="_self">About</a>
                           </li>
                           <li class=""><a href="#plane"
                              target="_self">Plans</a>
                           </li>
                           <li class=""><a href="contact.html"
                              target="_self">Contact Us</a>
                           </li>


                        </ul>
                     </nav>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-6 ">
                     <div class="text-end d-flex align-items-center justify-content-end header-right gap-3 d-none d-lg-block contact-btn-head">
                        <a href="{{route('register')}}"class="template-btn white-btn d-xl-block contact-btn">Login Now</a>
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
            src="{{asset('uploads/settings/'.$setting->photo)}}" alt=""style="height: 60px; width: auto;">
         <a href="javascript:void(0)" class="close"><i class="fas fa-xmark"></i></a>
         <ul class="mobile-nav-menu">
            <li><a href="{{route('frontend')}}" target="_self">Home</a>
            </li>
            <li><a href="#" target="_self">About</a>
            </li>
            <li><a href="#" target="_self">Plans</a>
            </li>
            <li><a href="#" target="_self">Blog</a>
            </li>
            <li><a href="#" target="_self">Contact Us</a>
            </li>
            <div class="mobile-menu-login">
               <a href="{{route('register')}}" class="mobile-menu-btn white-btn d-xl-block">Login</a>
            </div>
         </ul>
      </div>
      <!-- Mobile Menu End -->

