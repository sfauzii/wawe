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
                                value="{{ old('username') }}" placeholder="Enter username" required
                                autocomplete="username" autofocus>

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
                                onclick="window.location.href = '{{ route('socialite.redirect', 'google') }}';">
                                <img src="{{ url('frontend/images/icons/icon-google.svg') }}" alt="Google Icon"
                                    class="google-icon">
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
