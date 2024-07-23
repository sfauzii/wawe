<!-- Navbar -->
<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light" id="navbar">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('frontend/images/logo.png') }}" alt="Logo Poling" />
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navb">
            <ul class="navbar-nav">
                <li class="nav-item mx-md-2">
                    <a href="#" class="nav-link active">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#" class="nav-link">Paket Healing</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                        Services
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">Link</a>
                        <a href="#" class="dropdown-item">Link</a>
                        <a href="#" class="dropdown-item">Link</a>
                    </div>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#" class="nav-link">Testimonial</a>
                </li>
            </ul>
            <!-- Tambahkan tombol login di dalam collapse agar muncul di mobile -->
            <a href="login.html" class="btn btn-login ml-auto d-lg-none">Login</a>

            <!-- Profil untuk mobile di dalam collapse -->
            <div class="navbar-profile-mobile d-lg-none mt-3 text-center">
                <img src="{{ url('frontend/images/member.png') }}" alt="Profile Photo" class="profile-photo" />
                <span class="profile-name ml-2">John Doe</span>
            </div>
        </div>
        <!-- Tambahkan elemen profil di sini -->
        <div class="navbar-profile d-none d-lg-flex align-items-center ml-auto">
            <span class="profile-name ml-2">John Doe</span>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ url('frontend/images/member.png') }}" alt="Profile Photo" class="profile-photo" />
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- Konten dropdown -->
                    <a class="dropdown-item" href="dashboard.html">My Ticket</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>

        <!-- <a href="register.html" class="btn btn-register d-none d-lg-inline-block ml-lg-3">Register</a> -->
        <!-- <a href="login.html" class="btn btn-login d-none d-lg-inline-block ml-auto">Login</a> -->
    </nav>
</div>