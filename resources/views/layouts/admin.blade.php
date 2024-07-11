<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Dashboard - WaWe</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        @include('includes.admin.style')

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>

        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">

            @include('includes.admin.navbar')

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        @include('includes.admin.sidebar')
        <!-- End Sidebar-->

        <main id="main" class="main">

            @yield('content')

            @include('sweetalert::alert')

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        @include('includes.admin.footer')
        <!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        @include('includes.admin.script')

    </body>

    <script>
        function confirmDeletion(id, formId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus itu!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the specific form
                    document.getElementById(formId).submit();
                }
            })
        }
    </script>

</html>
