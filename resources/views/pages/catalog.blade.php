@extends('layouts.app')

@section('title')
    WaWe - Destinations
@endsection


@section('content')
    {{-- Login Pop Up --}}
    <div id="login-popup" class="login-popup">
        <div class="card login-card">
            <div class="row no-gutters">
                <!-- Left side with background image -->
                <div class="col-md-6 login-image"></div>

                <!-- Right side with login form -->
                <div class="col-md-6">
                    <div class="card-body login-content">
                        <h2 class="title-login">Login</h2>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control rounded-input" id="email"
                                    placeholder="Enter email">
                            </div> --}}
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" name="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror rounded-input"
                                    value="{{ old('username') }}" placeholder="Enter username" required autocomplete="username"
                                    autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror rounded-input"
                                    placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role ="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                            @endif
                            <div class="action-buttons">
                                <button type="submit" class="login-button">Login</button>
                                <button type="button" class="register-button"
                                    onclick="window.location.href = '{{ route('register') }}';">Register</button>
                            </div>

                            <hr>
                            <div class="action-buttons">
                                <button type="button" class="btn-dark google"
                                    onclick="window.location.href = 'register.html';">
                                    <img src="frontend/images/icons/icon-google.svg" alt="Google Icon" class="google-icon">
                                    Masuk/Daftar
                                </button>
                                {{-- <button type="button" class="btn-dark google"
                                    onclick="window.location.href = 'register.html';">
                                    <img src="frontend/images/icons/icon-google.svg" alt="Google Icon" class="google-icon">
                                    Masuk/Daftar</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="catalogue">
        <div class="hero-title">
            <h1>Destinations</h1>
            <p>Explore Our Exclusive Travel Packages <br>to the Most Beautiful Places</p>
        </div>
        <div class="content">
            <div class="menu">
                <h2>Sort</h2>
                <form id="sortForm" method="GET" action="{{ route('catalog') }}">
                    <div class="menu-item">
                        <input type="checkbox" id="sort1" name="sort" value="baru_rilis"
                            {{ request('sort') == 'baru_rilis' ? 'checked' : '' }} onclick="submitForm(this);" />
                        <label for="sort1">Baru Rilis</label>
                    </div>
                    <div class="menu-item">
                        <input type="checkbox" id="sort2" name="sort" value="murah"
                            {{ request('sort') == 'murah' ? 'checked' : '' }} onclick="submitForm(this);" />
                        <label for="sort2">Murah</label>
                    </div>
                </form>

                <h2 style="margin-top: 30px;">Type</h2>
                <div class="menu-item">
                    <input type="checkbox" id="type1" name="type1" />
                    <label for="type1">Type Option 1</label>
                </div>
                <div class="menu-item">
                    <input type="checkbox" id="type2" name="type2" />
                    <label for="type2">Type Option 2</label>
                </div>
                <div class="menu-item">
                    <input type="checkbox" id="type3" name="type3" />
                    <label for="type3">Type Option 3</label>
                </div>
            </div>
            <div class="catalog-cards">
                {{-- @php
                $items = $items->sortByDesc('created_at'); // Sort items by 'created_at' in descending order
            @endphp --}}
                @foreach ($items as $item)
                    <a href="{{ route('details', $item->slug) }}" class="card-link">
                        <div class="card-catalogue">
                            <div class="card-background"
                                style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image[0]) : '' }} ');">
                                <div class="card-overlay"></div>
                            </div>
                            <div class="card-content">
                                <div class="text-content">
                                    <h3>{{ ucwords($item->title) }}</h3>
                                    <p class="price">Rp {{ number_format($item->price, 0, ',') }}</p>
                                </div>
                                <div class="icons">
                                    <div class="icon-item">
                                        <ion-icon name="calendar-outline"></ion-icon>
                                        <span>{{ $item->duration }}</span>
                                    </div>
                                    <div class="icon-item">
                                        <ion-icon name="people-outline"></ion-icon>
                                        <span>{{ $item->kuota }} Persons</span>
                                    </div>
                                    <div class="icon-item">
                                        <ion-icon name="star-outline"></ion-icon>
                                        <span>{{ $item->testimonies_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>



            <!-- Repeat card as needed -->
        </div>

        <!-- Floating button for mobile -->
        <button class="menu-button" onclick="toggleMobileMenu()"><ion-icon name="filter-outline"></ion-icon></button>

        <!-- Mobile menu -->
        <div class="mobile-menu">
            <!-- <button onclick="toggleMobileMenu()">Close</button> -->
            <span class="material-icons" onclick="toggleMobileMenu()" style="margin-bottom: 20px;">close</span>
            <!-- Mobile menu content, replicate existing menu here -->
            <h2>Sort</h2>
            <form id="sortForm" method="GET" action="{{ route('catalog') }}">
                <div class="menu-item">
                    <input type="checkbox" id="sort1" name="sort" value="baru_rilis"
                        {{ request('sort') == 'baru_rilis' ? 'checked' : '' }} onclick="submitForm(this);" />
                    <label for="sort1">Baru Rilis</label>
                </div>
                <div class="menu-item">
                    <input type="checkbox" id="sort2" name="sort" value="murah"
                        {{ request('sort') == 'murah' ? 'checked' : '' }} onclick="submitForm(this);" />
                    <label for="sort2">Murah</label>
                </div>
            </form>
            <h2 style="margin-top: 30px;">Type</h2>
            <div class="menu-item">
                <input type="checkbox" id="type1-mobile" name="type1" />
                <label for="type1-mobile">Type Option 1</label>
            </div>
            <div class="menu-item">
                <input type="checkbox" id="type2-mobile" name="type2" />
                <label for="type2-mobile">Type Option 2</label>
            </div>
            <div class="menu-item">
                <input type="checkbox" id="type3-mobile" name="type3" />
                <label for="type3-mobile">Type Option 3</label>
            </div>
        </div>


    </section>
@endsection
