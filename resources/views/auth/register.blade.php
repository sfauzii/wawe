@extends('layouts.auth')

@section('content')
    <div class="login-container">
        <div class="background-image-register"></div>
        <div class="login-card">
            <div class="card-content">
                <div class="logo">
                    <!-- Place your logo image here -->
                    <img src="frontend/images/logo.png" alt="Logo">
                </div>
                <div class="title">
                    <h1>Register</h1>
                    <p>Welcome back! Please login to your account.</p>
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-input">
                        <!-- <span class="input-icon"><ion-icon name="person-circle-outline"></ion-icon></i></span> -->
                        <span class="input-icon">
                            <img src="frontend/images/icons/profile.png" alt="User Icon">
                        </span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name"
                            autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-input">
                        <!-- <span class="input-icon"><ion-icon name="mail-outline"></ion-icon></span> -->
                        <span class="input-icon">
                            <img src="frontend/images/icons/sms.png" alt="User Icon">
                        </span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-input">
                        <!-- <span class="input-icon"><ion-icon name="person-circle-outline"></ion-icon></i></span> -->
                        <span class="input-icon">
                            <img src="frontend/images/icons/tag-user.png" alt="User Icon">
                        </span>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" placeholder="Username" value="{{ old('username') }}" required
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
                            name="password" placeholder="Password" required autocomplete="new-password">

                        @error('password')
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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Password Confirm">

                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="login-button">Register</button>
                        <button type="submit" class="register-button" onclick="window.location.href='{{ route('login') }}';">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
