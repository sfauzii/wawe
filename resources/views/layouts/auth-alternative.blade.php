<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>@yield('title')</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ url('backend/assets/img/favicon.png') }}" rel="icon">
        <link href="{{ url('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ url('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ url('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ url('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ url('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ url('backend/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ url('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ url('backend/assets/vendor/simple-datatables/style.css"') }} rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ url('backend/assets/css/style.css') }}" rel="stylesheet">

        <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>

        @yield('content')

        @include('sweetalert::alert')
        <!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{ url('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ url('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
        <script src="{{ url('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ url('backend/assets/vendor/quill/quill.js') }}"></script>
        <script src="{{ url('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ url('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ url('backend/assets/vendor/php-email-form/validate.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ url('backend/assets/js/main.js') }}"></script>

    </body>

</html>
