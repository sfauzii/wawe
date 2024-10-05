<!-- Footer -->

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
                    <a href="#"><img src="{{ url('frontend/images/icons/facebook-white.png') }}"
                            alt="Facebook Icon" class="social-icon" /></a>
                    <a href="#"><img src="{{ url('frontend/images/icons/instagram-white.png') }}"
                            alt="Instagram Icon" class="social-icon" /></a>
                    <a href="#"><img src="{{ url('frontend/images/icons/whatsapp-white.png') }}"
                            alt="WhatsApp Icon" class="social-icon" /></a>
                </div>
            </div>
            <div class="col col-footer" id="services">
                <h3>Services</h3>
                <div class="links">
                    @auth
                        <a href="{{ route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Overview
                        </a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}">Overview
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('my-transaction', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">My
                            Booking
                        </a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}">My
                            Booking
                        </a>
                    @endguest

                    <a href="{{ route('home') }}#contact">Contact Us</a>


                    @auth
                        <a
                            href="{{ route('settings', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Settings</a>

                    @endauth

                    @guest
                        <a href="{{ route('login') }}">Settings</a>

                    @endguest
                </div>
            </div>
            <div class="col col-footer" id="useful-link">
                <h3>Links</h3>
                <div class="links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('catalog') }}">Destinations</a>

                    @auth
                        <a
                            href="{{ route('my-transaction', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Booking
                        </a>

                    @endauth

                    @guest
                        <a href="{{ route('login') }}">Booking
                        </a>

                    @endguest


                    <a href="{{ route('testimonials') }}">Testimonials</a>
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
