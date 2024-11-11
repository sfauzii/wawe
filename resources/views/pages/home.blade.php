@extends('layouts.app')


@section('title')
    WaWe | Purbalingga, Jawa Tengah
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

    <!-- Header -->

    <section class="curved-header">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>

            @php
                $carousels = \App\Models\Carousel::where('is_active', true)->get();
            @endphp

            <div class="carousel-inner">
                @foreach ($carousels as $index => $carousel)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img class="d-block w-100" src="{{ Storage::url($carousel->image_carousel) }}"
                            alt="Slide {{ $index + 1 }}" />
                        <div class="overlay">
                            <h1>{{ ucwords($carousel->title_carousel) }}</h1>
                            <p>{{ ucwords($carousel->description_carousel) }}</p>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ url('frontend/images/landing-1.jpg') }}" alt="First slide" />
                    <div class="overlay">
                        <h1>Judul Utama 1</h1>
                        <p>Deskripsi singkat di bawah judul 1</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ url('frontend/images/landing.png') }}" alt="Second slide" />
                    <div class="overlay">
                        <h1>Judul Utama 2</h1>
                        <p>Deskripsi singkat di bawah judul 2</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ url('frontend/images/regis.jpg') }}" alt="Third slide" />
                    <div class="overlay">
                        <h1>Judul Utama 3</h1>
                        <p>Deskripsi singkat di bawah judul 3</p>
                    </div>
                </div> --}}
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>


    <main>
        <div class="container">
            <!-- Statistik -->

            <section class="section-stats" id="stats">
                <div class="stats-card">
                    <div class="stats-item">
                        <!-- <i class="fa fa-users"></i> -->
                        <div class="stats-icon">
                            <img src="frontend/images/icons/profile-2user.png" alt="Members Icon" class="icons-stats" />
                        </div>
                        <div class="stats-content">
                            <h2>20K</h2>
                            <p>Members</p>
                        </div>
                    </div>
                    <div class="stats-item border-left">
                        <!-- <i class="fa fa-globe"></i> -->
                        <div class="stats-icon">
                            <img src="frontend/images/icons/sun-fog.png" alt="Members Icon" class="icons-stats" />
                        </div>
                        <div class="stats-content">
                            <h2>Good</h2>
                            <p>Destinations</p>
                        </div>
                    </div>
                    <div class="stats-item border-left">
                        <!-- <i class="fa fa-hotel"></i> -->
                        <div class="stats-icon">
                            <img src="frontend/images/icons/global.png" alt="Members Icon" class="icons-stats" />
                        </div>
                        <div class="stats-content">
                            <h2>100%</h2>
                            <p>Trusted</p>
                        </div>
                    </div>
                    <div class="stats-item border-left">
                        <!-- <i class="material-icons">handshake</i> -->
                        <div class="stats-icon">
                            <img src="frontend/images/icons/heart-tick.png" alt="Members Icon" class="icons-stats" />
                        </div>
                        <div class="stats-content">
                            <h2>Nice</h2>
                            <p>Partners</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Popular -->
        <section class="section-popular" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h1>Package Popular</h1>
                        <p>
                            Something that you never
                            <br />
                            before in this world
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Package Section -->
        <section class="section-package-popular row justify-content-center">
            <div class="card-container-popular">

                @foreach ($items as $item)
                    <div class="card card-package">

                        <!-- Custom Carousel -->
                        <div class="custom-carousel">
                            <div class="carousel-container">
                                <div class="carousel-track">
                                    @foreach ($item->galleries as $gallery)
                                        @foreach ($gallery->image as $image)
                                            <div class="carousel-slide">
                                                <img src="{{ Storage::url($image) }}" alt="Image from gallery">
                                            </div>
                                        @endforeach
                                    @endforeach

                                </div>

                                <!-- Navigation Buttons -->
                                <button class="carousel-button prev">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="carousel-button next">
                                    <i class="fas fa-chevron-right"></i>
                                </button>

                                <!-- Dots Navigation -->
                                <div class="carousel-dots"></div>
                            </div>
                        </div>

                        <div class="card-content-popular">
                            <a href="{{ route('details', $item->slug) }}">
                                <h1 class="card-title">{{ ucwords($item->title) }}
                            </a>
                            </h1>
                            <div class="price-container">
                                {{--@if ($item->discount_percentage > 0 && $item->original_price)
                                    <p class="price-discount">Rp {{ number_format($item->original_price, 0, ',', '.') }}
                                    </p>
                                    <p class="card-description">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    <div class="tooltip-icon package">
                                        <span class="icon-img package">?</span>
                                        <span class="tooltip-text package">
                                            <h1 class="tooltip-title">Promo Package</h1>
                                            Promo sedang berlangsung sebesar {{ $item->discount_percentage }}%
                                        </span>
                                    </div>
                                @else
                                    <p class="card-description">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                @endif--}}
                                 {{-- <p class="price-discount">Rp 600.000</p> --}}
                                <p class="card-description">Rp {{ number_format($item->price, 0, ',') }}</p>
                                {{-- <div class="tooltip-icon package">
                                    <span class="icon-img package">?</span>
                                    <span class="tooltip-text package">
                                        <h1 class="tooltip-title">Promo Package</h1>
                                        Biaya untuk fee payment gateway dan
                                        platform service
                                        lainnya!
                                    </span>
                                </div>  --}}
                            </div>
                            <div class="card-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <!-- Example of a half-star -->
                            </div>
                            <button class="view-details" onclick="window.location.href='details.html';">
                                View Details
                            </button>
                        </div>
                    </div>
                @endforeach


                {{-- <div class="card card-package">

                    <!-- Custom Carousel -->
                    <div class="custom-carousel">
                        <div class="carousel-container">
                            <div class="carousel-track">
                                <div class="carousel-slide">
                                    <img src="frontend/images/landing-1.jpg" alt="Image 1">
                                </div>
                                <div class="carousel-slide">
                                    <img src="frontend/images/services.png" alt="Image 2">
                                </div>
                                <div class="carousel-slide">
                                    <img src="frontend/images/landing-1.jpg" alt="Image 3">
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <button class="carousel-button prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-button next">
                                <i class="fas fa-chevron-right"></i>
                            </button>

                            <!-- Dots Navigation -->
                            <div class="carousel-dots"></div>
                        </div>
                    </div>

                    <div class="card-content-popular">
                        <a href="details.html">
                            <h1 class="card-title">Avanza Veloz Toyota Package Pantai Pangadaran</h1>
                        </a>
                        <div class="price-container">
                            <p class="price-discount">Rp 600.000</p>
                            <p class="card-description">Rp 450.000</p>
                            <div class="tooltip-icon package">
                                <span class="icon-img package">?</span>
                                <span class="tooltip-text package">
                                    <h1 class="tooltip-title">Promo Package</h1>
                                    Biaya untuk fee payment gateway dan
                                    platform service
                                    lainnya!
                                </span>
                            </div>
                        </div>


                        <div class="card-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <!-- Example of a half-star -->
                        </div>
                        <button class="view-details" onclick="window.location.href='details.html';">
                            View Details
                        </button>
                    </div>
                </div> --}}

            </div>
        </section>


        <!-- Our Network -->
        <section class="section-networks" id="networks">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Our Networks</h2>
                        <p>
                            Companies are trusted us
                            <br />
                            more than just a trip
                        </p>
                    </div>
                    <div class="col-md-8 text-center">
                        <img src="frontend/images/network.png" alt="Logo Partner" class="img-partner" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonial Section -->
        <section class="testimonial-section">
            <div class="testimonial-content">
                <div class="testimonial-left">
                    <h2>What Our Clients Say</h2>
                    <p>Discover how we have helped our clients achieve their goals.</p>
                    <div class="buttons">
                        <button class="btn-primary" onclick="window.location.href = '{{ route('catalog') }}';">Get
                            Started</button>
                        <button class="btn-secondary"
                            onclick="window.location.href = '{{ route('testimonials') }}';">Learn More</button>
                    </div>
                </div>
                <div class="testimonial-right">
                    @foreach ($testimonies as $testimony)
                        <div class="testimonial-card">
                            <h3>{{ ucwords($testimony->transactionDetail->transaction->travel_package->title) }}</h3>
                            <p>
                                "{{ $testimony->message }}."
                            </p>
                            <div class="author-info">
                                <img src="{{ $testimony->user->photo ? asset('storage/' . $testimony->user->photo) : 'https://ui-avatars.com/api/?name=' . $testimony->user->name }}"
                                    alt="{{ $testimony->user->name }}" alt="Author Photo" style="width: auto;" />
                                <!-- Replace with actual image path -->
                                <div>
                                    <span class="author-name">{{ $testimony->user->name }}</span>
                                    <span class="author-title">{{ $testimony->created_at }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



        <!-- MY SERVICE -->
        <section class="my-service-section">
            <div class="my-service-container">
                <div class="my-service-content">
                    <h2 class="my-service-title">My Services</h2>
                    <p class="my-service-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <ul class="my-service-list">
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Service 1</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Service 2</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Service 3</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Service 3</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Service 3</p>
                        </li>
                        <!-- Add more services as needed -->
                    </ul>
                    <button class="get-started-button" onclick="window.location.href = '{{ route('catalog') }}';">Get
                        Started</button>
                </div>
                <div class="my-service-image">
                    <img src="frontend/images/services-copy.png" alt="Service Image" />
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="faq-section">
            <div class="faq-container">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-description">
                    Find answers to the most commonly asked questions below.
                </p>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>What is your return policy?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            We accept returns within 30 days of purchase. Please ensure the
                            items are in their original condition.
                        </p>
                    </div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>How can I track my order?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            You can track your order using the tracking link provided in
                            your shipping confirmation email.
                        </p>
                    </div>
                </div>
                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>How can I track my order?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            You can track your order using the tracking link provided in
                            your shipping confirmation email.
                        </p>
                    </div>
                </div>
                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>How can I track my order?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            You can track your order using the tracking link provided in
                            your shipping confirmation email.
                        </p>
                    </div>
                </div>

                <!-- Add more FAQ cards as needed -->
            </div>
        </section>


        <!-- QUESTION -->
        <section class="question-section" id="contact">
            <div class="question-card">
                <img src="{{ url('frontend/images/cu.png') }}" alt="Overlay Image" class="overlay-image" />
                <div class="question-content">
                    <h1>Have a Question?</h1>
                    <p>
                        If you have any questions or need further information, <br />feel
                        free to contact us.
                    </p>
                    <button class="btn btn-primary">Contact Us</button>
                </div>
            </div>
        </section>
    </main>
@endsection
