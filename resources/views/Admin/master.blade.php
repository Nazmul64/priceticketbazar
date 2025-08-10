<!doctype html>
<html lang="en" class="semi-dark">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="icon" href="{{ asset('backend/assets/images/favicon-32x32.png') }}" type="image/png" />

<!-- Plugins CSS -->
<link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

<!-- Bootstrap CSS -->
<link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" />

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<!-- Loader -->
<link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />

<!-- Theme Styles -->
<link href="{{ asset('backend/assets/css/dark-theme.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/light-theme.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/semi-dark.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/css/header-colors.css') }}" rel="stylesheet" />
<!-- Custom CSS -->
<link href="{{ asset('backend/assets/css/custom.css') }}" rel="stylesheet" />


<!-- Title -->
<title>Admin Dashboard</title>
<!-- Custom Toster Messages -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


     @if (Session::has('success') || Session::has('error'))
     <script>
     $(document).ready(function () {
     console.log("Toastr script initialized");

     toastr.options = {
         closeButton: true,
         progressBar: true,
         positionClass: "toast-top-right",
         timeOut: 5000
     };

     @if (Session::has('error'))
         console.log("Error message: {{ Session::get('error') }}");
         toastr.error("{{ Session::get('error') }}");
     @endif

     @if (Session::has('success'))
         console.log("Success message: {{ Session::get('success') }}");
         toastr.success("{{ Session::get('success') }}");
     @endif
     });
     </script>
     @endif
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
       @include('Admin.pages.header')
       <!--end top header-->

        <!--start sidebar -->
          @include('Admin.pages.sidebar')
       <!--end sidebar -->

       <!--start content-->
          <main class="page-content">
              @yield('content')
          </main>
       <!--end page main-->

       <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
       <!--end overlay-->

       <!--Start Back To Top Button-->
		     <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
       <!--End Back To Top Button-->

       <!--start switcher-->
       <div class="switcher-body">
        <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-paint-bucket me-0"></i></button>
        <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <h6 class="mb-0">Theme Variation</h6>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1">
              <label class="form-check-label" for="LightTheme">Light</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
              <label class="form-check-label" for="DarkTheme">Dark</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3" checked>
              <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
            </div>
            <hr>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
              <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
            </div>
            <hr/>
            <h6 class="mb-0">Header Colors</h6>
            <hr/>
            <div class="header-colors-indigators">
              <div class="row row-cols-auto g-3">
                <div class="col">
                  <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                  <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
       <!--end switcher-->

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
<!-- jQuery -->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('backend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>

<!-- ApexCharts -->
<script src="{{ asset('backend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>

<!-- Vector Maps -->
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<!-- App Scripts -->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
<script src="{{ asset('backend/assets/js/chartjs.js') }}"></script>
<script src="{{ asset('backend/assets/js/apexcharts.js') }}"></script>
<script src="{{ asset('backend/assets/js/vector-maps.js') }}"></script>
<script src="{{ asset('backend/assets/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>
  <script>
    new PerfectScrollbar(".review-list")
    new PerfectScrollbar(".chat-talk")
 </script>


</body>

<script>'undefined'=== typeof _trfq || (window._trfq = []);'undefined'=== typeof _trfd && (window._trfd=[]),_trfd.push({'tccl.baseHost':'secureserver.net'},{'ap':'cpsh-oh'},{'server':'p3plzcpnl509132'},{'dcenter':'p3'},{'cp_id':'10399385'},{'cp_cl':'8'}) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.</script><script src='../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js'></script>
</html>
