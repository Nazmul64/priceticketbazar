

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>priceticketbazar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('userdashboard')}}/assets/css/style.css" />
!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">


<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Page Title -->
<title>Admin Dashboard</title>

<!-- jQuery (required for Toastr) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Toastr Notifications -->
@if (Session::has('success') || Session::has('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 5000
            };

            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif

            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif
        });
    </script>
@endif

  </head>
  <body>
    <!-- SIDEBAR (kept markup & menu items you provided) -->
    @include('userdashboard.pages.sidebar')

    <!-- Overlay for mobile -->
    <div id="overlay" aria-hidden="true"></div>

    <!-- HEADER -->
   @include('userdashboard.pages.header')

    <!-- MAIN -->
    <main role="main">
        @yield('content')
    </main>

    <!-- js line here -->
    <script src="{{asset('userdashboard')}}/assets/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

  </body>
</html>
