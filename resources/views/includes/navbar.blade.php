<!-- Navbar -->
<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light" id="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('frontend/svg/images/logo.svg') }}" alt="Logo Poling" />
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navb">
            <ul class="navbar-nav">
                <li class="nav-item mx-md-2">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="{{ route('catalog') }}"
                        class="nav-link {{ Route::currentRouteName() == 'catalog' ? 'active' : '' }}">Destinations</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                        Booking
                    </a>
                    <div class="dropdown-menu">
                        @auth
                            <a href="{{ route('my-ticket', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}"
                                class="dropdown-item">Ticket
                            </a>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="dropdown-item">Ticket
                            </a>
                        @endguest
                    </div>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="{{ route('testimonials') }}"
                        class="nav-link {{ Route::currentRouteName() == 'testimonials' ? 'active' : '' }}">Testimonial</a>
                </li>
            </ul>
            <!-- Tambahkan tombol login di dalam collapse agar muncul di mobile -->
            @guest
                <a id="login-btn" href="{{ route('login') }}" class="btn btn-login ml-auto d-lg-none">Login</a>
            @endguest

            <!-- Profil untuk mobile di dalam collapse -->
            @auth
                <div class="navbar-profile-mobile d-lg-none mt-3 text-center">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButtonMobile"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                                alt="Profile Photo" class="profile-photo" />
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonMobile">
                            <!-- Dropdown content -->
                            <a class="dropdown-item"
                                href="{{ route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Overview</a>
                            <a class="dropdown-item"
                                href="{{ route('my-ticket', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">My
                                Ticket</a>
                            <a class="dropdown-item"
                                href="{{ route('settings', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Settings</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ url('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                    <span class="profile-name ml-2">Hi, {{ ucfirst(Auth::user()->name) }}</span>
                </div>
            @endauth
        </div>
        <!-- Tambahkan elemen profil di sini -->
        @auth
            <div class="navbar-profile d-none d-lg-flex py-3 align-items-center ml-auto">
                <span class="profile-name ml-2">Hi, {{ ucfirst(Auth::user()->name) }}</span>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                            alt="Profile Photo {{ Auth::user()->name }}" class="profile-photo" />
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <!-- Konten dropdown -->
                        <a class="dropdown-item"
                            href="{{ route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Overview</a>
                        <a class="dropdown-item"
                            href="{{ route('my-ticket', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">My
                            Ticket</a>
                        <a class="dropdown-item"
                            href="{{ route('settings', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Settings</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ url('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth

        <!-- <a href="register.html" class="btn btn-register d-none d-lg-inline-block ml-lg-3">Register</a> -->

        @guest

            {{-- <a href="{{ route('login') }}" class="btn btn-login d-none d-lg-inline-block ml-auto">Login</a> --}}
            <button id="login-btn" class="btn btn-login d-none d-lg-inline-block ml-auto">Login</button>


        @endguest
    </nav>
</div>
