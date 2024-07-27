<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @livewireStyles
    @include('includes.users.style')

</head>

<body>
    <div class="container">

        @include('includes.users.sidebar')

        <!-- main section start -->
        <main>

            @include('includes.users.navbar')



            @yield('content')

            @include('sweetalert::alert')

        </main>
        <!-- main section end -->


    </div>


    @livewireScripts

</body>


@include('includes.users.script')

</html>
