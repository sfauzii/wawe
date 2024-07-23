@extends('layouts.app')

@section('content')
    <!-- Header -->
    <header class="text-center">
        <h1>
            Mulai
            <br />
            Langkahmu!
        </h1>
        <p class="mt-3">
            Beban hidup jadi ringan dan
            <br />
            capai kebahagian bareng Poling
        </p>
        <!-- <a href="#" class="btn btn-get-started px-4 mt-4">
            Get Started
        </a> -->
        <!-- Tombol Search -->
        <div class="search-container">
            <form action="#" method="get" class="search-form">
                <input type="text" name="search" placeholder="Search..." class="search-input" />
                <button type="submit" class="btn-search">Search</button>
            </form>
        </div>
    </header>

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
                            <h2>13</h2>
                            <p>Countries</p>
                        </div>
                    </div>
                    <div class="stats-item border-left">
                        <!-- <i class="fa fa-hotel"></i> -->
                        <div class="stats-icon">
                            <img src="frontend/images/icons/global.png" alt="Members Icon" class="icons-stats" />
                        </div>
                        <div class="stats-content">
                            <h2>3K</h2>
                            <p>Hotel</p>
                        </div>
                    </div>
                    <div class="stats-item border-left">
                        <!-- <i class="material-icons">handshake</i> -->
                        <div class="stats-icon">
                            <img src="frontend/images/icons/heart-tick.png" alt="Members Icon" class="icons-stats" />
                        </div>
                        <div class="stats-content">
                            <h2>72</h2>
                            <p>Partners</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- <section class="section-stats row justify-content-center" id="stats">
                <div class="col-3 col-md-2 stats-detail">
                    <h2>20K</h2>
                    <p>Members</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>13</h2>
                    <p>Countries</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>3K</h2>
                    <p>Hotel</p>
                </div>
                <div class="col-3 col-md-2 stats-detail">
                    <h2>72</h2>
                    <p>Partners</p>
                </div>
            </section> -->
        </div>

        <!-- Popular -->
        <section class="section-popular" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-heading">
                        <h1>Wisata Popular</h1>
                        <p>
                            Something that you never
                            <br />
                            before in this world
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-popular-content" id="popularContent">
            <div class="container">
                <div class="section-popular-travel row justify-content-center">
                    @foreach ($items as $item )
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ route('details', $item->slug) }}" class="card-link">
                            <div class="card-travel text-center d-flex flex-column"
                                style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');">
                                <div class="travel-location">{{ $item->location }}</div>
                                <div class="travel-price">Rp {{ $item->price }}</div>
                                <div class="travel-icons">
                                    <ion-icon name="calendar-outline"></ion-icon>
                                    <span>{{ $item->duration }}</span>
                                    <ion-icon name="people-outline"></ion-icon>
                                    <span>{{ $item->kuota }} Persons</span>
                                    <ion-icon name="star-outline"></ion-icon> <span>129</span>
                                </div>
                            </div>
                        </a>
                    </div>
                        
                    @endforeach

                    
                </div>
            </div>
        </section>

        <!-- <section class="section-popular-content" id="popularContent">
            <div class="container">
                <div class="section-popular-travel row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column"
                            style="background-image: url('frontend/images/header.jpg');">
                            <div class="travel-country">INDONESIA</div>
                            <div class="travel-location">Bali</div>
                            <div class="travel-button mt-auto">
                                <a href="details.html" class="btn btn-travel-details px-4">View details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column"
                            style="background-image: url('frontend/images/header.jpg');">
                            <div class="travel-country">INDONESIA</div>
                            <div class="travel-location">Bali</div>
                            <div class="travel-button mt-auto">
                                <a href="details.html" class="btn btn-travel-details px-4">View details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column"
                            style="background-image: url('frontend/images/header.jpg');">
                            <div class="travel-country">INDONESIA</div>
                            <div class="travel-location">Bali</div>
                            <div class="travel-button mt-auto">
                                <a href="details.html" class="btn btn-travel-details px-4">View details</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-travel text-center d-flex flex-column"
                            style="background-image: url('frontend/images/header.jpg');">
                            <div class="travel-country">INDONESIA</div>
                            <div class="travel-location">Bali</div>
                            <div class="travel-button mt-auto">
                                <a href="details.html" class="btn btn-travel-details px-4">View details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

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
                        <button class="btn-primary">Get Started</button>
                        <button class="btn-secondary">Learn More</button>
                    </div>
                </div>
                <div class="testimonial-right">
                    <div class="testimonial-card">
                        <h3>Curug</h3>
                        <p>
                            "This service has been life-changing! The team is amazing and
                            the support is unparalleled."
                        </p>
                        <div class="author-info">
                            <img src="frontend/images/avatar.png" alt="Author Photo" />
                            <!-- Replace with actual image path -->
                            <div>
                                <span class="author-name">John Doe</span>
                                <span class="author-title">CEO, Company XYZ</span>
                            </div>
                        </div>
                    </div>
                    <!-- Add more cards as needed -->
                    <div class="testimonial-card">
                        <h3>Candi Prambanan</h3>
                        <p>
                            "Absolutely fantastic! They went above and beyond to ensure our
                            success."
                        </p>
                        <div class="author-info">
                            <img src="frontend/images/member.png" alt="Author Photo" />
                            <!-- Replace with actual image path -->
                            <div>
                                <span class="author-name">Jane Smith</span>
                                <span class="author-title">Marketing Head, ABC Corp</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card">
                        <h3>Jogja</h3>
                        <p>
                            "Absolutely fantastic! They went above and beyond to ensure our
                            success."
                        </p>
                        <div class="author-info">
                            <img src="frontend/images/member.png" alt="Author Photo" />
                            <!-- Replace with actual image path -->
                            <div>
                                <span class="author-name">Jane Smith</span>
                                <span class="author-title">Marketing Head, ABC Corp</span>
                            </div>
                        </div>
                    </div>
                    <!-- Add more testimonial cards here -->
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
                    <button class="get-started-button">Get Started</button>
                </div>
                <div class="my-service-image">
                    <img src="frontend/images/services.png"Service Image">
                </div>
            </div>
        </section>
    </main>
@endsection
