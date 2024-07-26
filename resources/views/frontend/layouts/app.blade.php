<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base-url" content="{{ URL::to("/") }}">

  <meta name="author" content="ecommartbd.com">

  <title>Ecom Mart BD</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('/')}}/public/frontend/images/favicon.png" />

  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/plugins/bootstrap-slider/bootstrap-slider.min.css">
  <!-- Main Slider -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/plugins/slick-carousel/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{URL::to('/')}}/public/frontend/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  @yield('stylesheet')
</head>
<body id="body">
    @include('frontend.layouts.navbar')
    @include('frontend.layouts.search')

    @yield('content')

    @include('frontend.layouts.footer')

    <script src="{{URL::to('/')}}/public/frontend/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 4.3.1 -->
    <script src="{{URL::to('/')}}/public/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
     <!-- Count Down Js -->
    <script src="{{URL::to('/')}}/public/frontend/plugins/SyoTimer/jquery.syotimer.min.js"></script>
    <script src="{{URL::to('/')}}/public/frontend/plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
    <!-- Slick Slider -->
    <script src="{{URL::to('/')}}/public/frontend/plugins/slick-carousel/slick/slick.min.js"></script>
    <!-- rating star -->
    <script src="{{URL::to('/')}}/public/frontend/plugins/rating/rating.js"></script>
    <!-- Instagram Feed Js -->
    <script src="{{URL::to('/')}}/public/frontend/plugins/instafeed-js/instafeed.min.js"></script>
    <!-- Google Mapl -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script> --}}
    <script src="{{URL::to('/')}}/public/frontend/plugins/google-map/gmap.js"></script>

    <!-- Main Js File -->
    <script src="{{URL::to('/')}}/public/frontend/js/script.js"></script>
    <script src="{{URL::to('/')}}/public/frontend/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        getCartItems("{{route('cart.items')}}", "{{URL::to("/")}}");
    </script>

    @yield('script')
</body>
</html>
