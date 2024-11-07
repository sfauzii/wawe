<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title')</title>

        @stack('prepend-style')
        @include('includes.style')
        @stack('prepend-style')


    </head>

    <body>
        <!-- Navbar -->
        @include('includes.navbar')

        @yield('content')

        @include('sweetalert::alert')

        @include('includes.footer')

        @livewireScripts

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />

        @stack('prepend-script')
        @include('includes.script')
        @stack('addon-script')

        @yield('script')

    </body>

</html>
