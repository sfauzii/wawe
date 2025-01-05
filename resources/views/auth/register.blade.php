@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="login-container">
        <div class="background-image-register"></div>
        <div class="login-card">
            <div class="card-content">
                <div class="logo">
                    <!-- Place your logo image here -->
                    <a href="{{ route('home') }}">
                        <img src="frontend/svg/images/logo.svg" alt="Logo">

                    </a>
                </div>
                <div class="title">
                    <h1>Register</h1>
                    <p>Create an account to get started with booking your travel packages.</p>
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-input">
                        <span class="input-icon">
                            <img src="frontend/images/icons/profile.png" alt="User Icon">
                        </span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" placeholder="Name">

                        @error('name')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <span class="input-icon">
                            <img src="frontend/images/icons/sms.png" alt="User Icon">
                        </span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" placeholder="Email" value="{{ old('email') }}">

                        @error('email')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <span class="input-icon">
                            <img src="frontend/images/icons/tag-user.png" alt="User Icon">
                        </span>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" placeholder="Username" value="{{ old('username') }}">

                        @error('username')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <span class="input-icon">
                            <img src="frontend/images/icons/key.png" alt="User Icon">
                        </span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Password">

                        @error('password')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <span class="input-icon">
                            <img src="frontend/images/icons/key.png" alt="User Icon">
                        </span>
                        <input id="password-confirm" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" placeholder="Password Confirm">

                        @error('password_confirmation')
                            <div class="invalid-feedback" style="display: block;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="login-button">Register</button>
                        <button type="button" class="register-button"
                            onclick="window.location.href='{{ route('login') }}';">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
