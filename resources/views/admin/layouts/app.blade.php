<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{config('app.name')}}{{isset($page) ? " | ".$page :""}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{URL::to('/')}}/public/assets/img/logo.png" rel="icon">
    <link href="{{URL::to('/')}}/public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{URL::to('/')}}/public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/css/style.css" rel="stylesheet">
    <link href="{{URL::to('/')}}/public/assets/css/sidebar.css" rel="stylesheet">
</head>

<body>

    <main id="main" class="main">
        @include('admin.layouts.partials.navbar')
        @include('admin.layouts.partials.sidebar')
        @yield('content')
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <script src="{{URL::to('/')}}/public/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{URL::to('/')}}/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{URL::to('/')}}/public/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{URL::to('/')}}/public/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{URL::to('/')}}/public/assets/vendor/quill/quill.js"></script>
    <script src="{{URL::to('/')}}/public/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="{{URL::to('/')}}/public/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{URL::to('/')}}/public/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{URL::to('/')}}/public/assets/js/main.js"></script>

    @yield('scripts')

</body>
</html>
