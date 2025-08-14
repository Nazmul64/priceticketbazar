

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>priceticketbazar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('userdashboard')}}/assets/css/style.css" />

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
