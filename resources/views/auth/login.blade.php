@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <div class="background-image-login"></div>
        <div class="login-card">
            <div class="card-content">
                <div class="logo">
                    <!-- Place your logo image here -->
                    <a href="{{ route('home') }}">
                        <img src="frontend/svg/images/logo.svg" alt="Logo">
                    </a>
                </div>
                <div class="title">
                    <h1>Login</h1>
                    <p>Welcome back! Please login to your account.</p>
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="form-input">
                        <!-- <span class="input-icon"><ion-icon name="person-circle-outline"></ion-icon></i></span> -->
                        <span class="input-icon">
                            <img src="frontend/images/icons/profile.png" alt="User Icon">
                        </span>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" placeholder="Username" required
                            autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <!-- <span class="input-icon"><ion-icon name="key-outline"></ion-icon></i></span> -->
                        <span class="input-icon">
                            <img src="frontend/images/icons/key.png" alt="User Icon">
                        </span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role ="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="action-buttons">
                        <button type="submit" class="login-button">Login</button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link custom-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        {{-- <a href="{{ route('register') }}" class="register-button">Register</a> --}}
                        <button type="button" class="register-button"
                            onclick="window.location.href='{{ route('register') }}';">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
