@extends('layouts.success')

@section('title', 'Checkout Success')

@section('content')

    <main>

        <div class="success-message">
            <h1>Booking Successfully <br>Congratulations🎉</h1>
        </div>

        <section class="section-scs-header"></section>
        <div class="card-container">
            <div class="custom-card">
                <div class="card-content">
                    <div class="product__info">
                        <div class="product-image" style="width: 100px; height: auto">
                            @if ($items->travel_package->galleries->isNotEmpty())
                                @php
                                    $firstImage = $items->travel_package->galleries->first()->image; // Get the first image array
                                    $firstImagePath = is_array($firstImage) ? $firstImage[0] : ''; // Get the first image from the array
                                @endphp
                                @if ($firstImagePath)
                                    <img src="{{ asset('storage/' . $firstImagePath) }}"
                                        alt="{{ ucwords($items->travel_package->title) }}">
                                @else
                                    <!-- Fallback content if there is no image -->
                                    <p>No image available.</p>
                                @endif
                            @else
                                <!-- Fallback content if there are no galleries -->
                                <p>No galleries available.</p>
                            @endif
                        </div>
                        <div class="product-details">
                            <h2 class="product-title">{{ ucwords($items->travel_package->title) }}</h2>
                            <div class="product-status">
                                <p>{{ $items->transaction_status }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="icon-container">
                        <span class="icon">
                            <!-- <ion-icon name="calendar-outline"></ion-icon> -->
                            <img src="{{ url('frontend/images/icons/calendar.png') }}" alt="Check Icon"
                                class="icon-img-succes">
                            <!-- Ganti dengan ikon Font Awesome yang sesuai -->
                        </span>
                        <div class="icon-description">
                            <p>{{ \Carbon\Carbon::create($items->travel_package->departure_date)->format('d F Y') }}</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="people-outline">Ganti dengan ikon Font Awesome yang sesuai -->
                            <img src="{{ url('frontend/images/icons/people.png') }}" alt="Check Icon"
                                class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>{{ $transactionDetails->count() }} person</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="pricetag-outline"></ion-icon>Ganti dengan ikon Font Awesome yang sesuai -->
                            <img src="{{ url('frontend/images/icons/tag.png') }}" alt="Check Icon" class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>{{ ucfirst($items->travel_package->type) }}</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="cash-outline"></ion-icon> -->
                            <!-- Ganti dengan ikon Font Awesome yang sesuai -->

                            <img src="{{ url('frontend/images/icons/dollar-circle.png') }}" alt="Check Icon"
                                class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>{{ number_format($items->grand_total, 0, ',') }}</p>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="description">
                        <h3>What's Next?</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero et
                            fringilla.</p>
                    </div>
                    <div class="buttons">
                        <button class="action-button">Message Owner</button>
                        <button class="action-button-secondary"
                            onclick="window.location.href='{{ route('home') }}';">Explore Again</button>
                        {{-- <button class="action-button-secondary" onclick="window.location.href = '{{ route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}';">My
                            Dashboard</button> --}}
                        @if (Auth::check())
                            <button class="action-button-secondary"
                                onclick="window.location.href = '{{ route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}';">
                                My Profile
                            </button>
                        @else
                            <script>
                                window.location.href = '/';
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="container container-footer">
                <div class="row row-footer">
                    <div class="col col-footer" id="company">
                        <img src="{{ url('frontend/images/logo.png') }}" alt="" class="logo-footer" />
                        <p>
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos,
                            ullam.
                        </p>
                        <div class="social">
                            <!-- <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                            <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                            <a href="#"><ion-icon name="logo-whatsapp"></ion-icon></a> -->
                            <a href="#"><img src="{{ url('frontend/images/icons/facebook-white.png') }}" alt="Facebook Icon"
                                    class="social-icon" /></a>
                            <a href="#"><img src="{{ url('frontend/images/icons/instagram-white.png') }}" alt="Instagram Icon"
                                    class="social-icon" /></a>
                            <a href="#"><img src="{{ url('frontend/images/icons/whatsapp-white.png') }}" alt="WhatsApp Icon"
                                    class="social-icon" /></a>
                        </div>
                    </div>
                    <div class="col col-footer" id="services">
                        <h3>Services</h3>
                        <div class="links">
                            <a href="#">Overview</a>
                            <a href="#">My Booking</a>
                            <a href="#">Contact Us</a>
                            <a href="#">Settings</a>
                        </div>
                    </div>
                    <div class="col col-footer" id="useful-link">
                        <h3>Links</h3>
                        <div class="links">
                            <a href="#">Home</a>
                            <a href="#">Destinations</a>
                            <a href="#">Booking</a>
                            <a href="#">Testimonials</a>
                        </div>
                    </div>
        
                    <div class="col col-footer" id="contact">
                        <h3>Contact</h3>
                        <div class="contact-details-footer">
                            <!-- <ion-icon name="location-outline"></ion-icon> -->
                            <img src="{{ url('frontend/images/icons/location-white.png') }}" alt="" />
                            <p>Lorem ipsum dolor sit amet consectetur.</p>
                        </div>
                        <div class="contact-details-footer">
                            <!-- <ion-icon name="call-outline"></ion-icon> -->
                            <img src="{{ url('frontend/images/icons/call-white.png') }}" alt="" />
                            <p>+62 123 456 7890</p>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="container-fluid">
                <div class="row border-top justify-content-center align-items-center pt-4">
                    <div class="col-auto text-gray-500 font-weight-light">
                        2024 Copyright Poling ❤️ All rights reserved
                    </div>
                </div>
            </div>
        </footer>

    </main>


@endsection
