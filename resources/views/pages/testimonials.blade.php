@extends('layouts.app')

@section('title', 'WaWe | Testimonials')

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


    <!-- Section Review-Testy -->
    <section class="section-review-header">
        <div class="container-header-review">
            <h1>Our Clients Say</h1>
            <p>What our clients have to say about our services</p>
        </div>
    </section>


    <!--<section class="section-heading-review">
                                                <div class="container">
                                                    <h1>Our Clients Say</h1>
                                                    <p>What our clients have to say about our services</p>
                                                </div>
                                            </section>-->

    <!-- Section Client Says -->
    <section class="section-client-says">
        <div class="container">
            <div class="review-heading">
                <h1>Client Testimonials</h1>
                <p>Read what our satisfied customers are saying about us!</p>
            </div>
            <div class="review-cards">
                <!-- Review Card Example -->
                @foreach ($testimonies as $testimonial)
                    <div class="review-card">
                        <h3>{{ ucwords($testimonial->transactionDetail->transaction->travel_package->title) }}</h3>
                        <p class="review-message">
                            @php
                                // Menghitung jumlah kata dalam message
                                $wordCount = str_word_count($testimonial->message);

                                // Memotong message jika lebih dari 100 kata
                                if ($wordCount > 30) {
                                    // Mengambil 30 kata pertama
                                    $trimmedMessage = implode(
                                        ' ',
                                        array_slice(explode(' ', $testimonial->message), 0, 30),
                                    );
                                    $remainingMessage = implode(
                                        ' ',
                                        array_slice(explode(' ', $testimonial->message), 30),
                                    );
                                } else {
                                    // Jika tidak lebih dari 100 kata, tampilkan seluruh message
                                    $trimmedMessage = $testimonial->message;
                                    $remainingMessage = '';
                                }
                            @endphp

                            {{ $trimmedMessage }}

                            @if ($remainingMessage)
                                <span class="more" style="display:none;">
                                    {{ $remainingMessage }}
                                </span>
                                <span class="read-more" style="cursor: pointer;">...more</span>
                            @endif <!-- Pindah ...more ke sini -->
                        </p>
                        <div class="review-footer">
                            <img src="{{ $testimonial->user->photo ? asset('storage/' . $testimonial->user->photo) : 'https://ui-avatars.com/api/?name=' . $testimonial->user->name }}"
                                alt="{{ $testimonial->user->name }}" class="review-image">
                            <div class="review-details">
                                <p class="name-user-review">{{ ucwords($testimonial->user->name) }}</p>
                                <p class="created_at">Reviewed on {{ $testimonial->created_at->format('M, j Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!-- Tambahkan lebih banyak review-card sesuai kebutuhan -->
            </div>
        </div>
    </section>


    <!-- Section About Us -->
    <section class="section-about-us">
        <div class="container-about">
            <img src="{{ url('frontend/svg/images/about.svg') }}" alt="About Us" class="about-image">
            <div class="about-content">
                <h3>Who We Are</h3>
                <h1>About Our Company</h1>
                <p>At WaWe Tour and Travel, we are passionate about creating unforgettable travel
                    experiences. We specialize in curating personalized travel packages that cater to every kind
                    of traveler—whether you seek relaxation, adventure, or cultural exploration. Our team of
                    travel experts is dedicated to providing exceptional service, ensuring every detail of your
                    journey is carefully planned. <br>
                    <br>
                    From exotic getaways to guided tours of iconic cities, we aim to make your travel dreams a
                    reality. Let us take you on an adventure you'll never forget!
                </p>
                <button class="learn-more-btn" onclick="window.location.href = '{{ route('catalog') }}';">Get
                    Started</button>
            </div>
        </div>
    </section>


    <!-- Section Let's Get Started -->
    <section class="section-lets-started">
        <div class="card card-test">
            <h3>Ready to Begin?</h3>
            <h1>Let’s Get Started!</h1>
            <button class="get-started-btn" onclick="window.location.href = '{{ route('catalog') }}';">Get Started</button>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.review-card').forEach(card => {
            const reviewMessage = card.querySelector('.review-message');
            const moreText = card.querySelector('.more');
            const readMoreLink = card.querySelector('.read-more');

            readMoreLink.addEventListener('click', () => {
                // Toggle visibility of the additional message
                if (moreText.style.display === 'none') {
                    moreText.style.display = 'inline'; // Tampilkan teks lebih banyak
                    readMoreLink.innerText = '...less'; // Ubah teks menjadi less
                } else {
                    moreText.style.display = 'none'; // Sembunyikan teks lebih banyak
                    readMoreLink.innerText = '...more'; // Kembalikan teks menjadi more
                }

                // Mengatur tinggi card sesuai isi pesan
                card.style.height = 'auto'; // Mengatur tinggi menjadi otomatis untuk menyesuaikan isi
            });
        });
    </script>
@endsection


@section('script')
    <script>
        document.querySelectorAll('.review-card').forEach(card => {
            const reviewMessage = card.querySelector('.review-message');
            const moreText = card.querySelector('.more');
            const readMoreLink = card.querySelector('.read-more');

            if (moreText) { // Pastikan ada elemen lebih
                readMoreLink.addEventListener('click', () => {
                    // Toggle visibility of the additional message
                    if (moreText.style.display === 'none') {
                        moreText.style.display = 'inline'; // Tampilkan teks lebih banyak
                        readMoreLink.innerText = '...less'; // Ubah teks menjadi less
                    } else {
                        moreText.style.display = 'none'; // Sembunyikan teks lebih banyak
                        readMoreLink.innerText = '...more'; // Kembalikan teks menjadi more
                    }

                    // Mengatur tinggi card sesuai isi pesan
                    card.style.height = 'auto'; // Mengatur tinggi menjadi otomatis untuk menyesuaikan isi
                });
            }
        });
    </script>
@endsection
