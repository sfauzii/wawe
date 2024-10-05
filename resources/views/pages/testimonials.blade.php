@extends('layouts.app')

@section('title', 'WaWe | Testimonials')

@section('content')
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
                <div class="review-card">
                    <h3>Excellent Service!</h3>
                    <p class="review-message">
                        The team was professional and delivered the project on time. Highly recommended!
                        <span class="more" style="display:none;">
                            They went above and beyond to ensure that everything was perfect. I can't thank them
                            enough for their hard work and dedication!
                        </span>
                        <span class="read-more">...more</span> <!-- Pindah ...more ke sini -->
                    </p>
                    <div class="review-footer">
                        <img src="profile.jpg" alt="user" class="review-image">
                        <div class="review-details">
                            <p class="name-user-review">John Doe</p>
                            <p class="created_at">Reviewed on September 28, 2024</p>
                        </div>
                    </div>
                </div>

                <div class="review-card">
                    <h3>Fantastic Experience!</h3>
                    <p class="review-message">Amazing support and the results exceeded my expectations!</p>
                    <div class="review-footer">
                        <img src="frontend/images/avatar.png" alt="user" class="review-image">
                        <div class="review-details">
                            <p class="name-user-review">Jane Smith</p>
                            <p class="created_at">Reviewed on September 29, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <h3>Fantastic Experience!</h3>
                    <p class="review-message">Amazing support and the results exceeded my expectations!</p>
                    <div class="review-footer">
                        <img src="frontend/images/avatar.png" alt="user" class="review-image">
                        <div class="review-details">
                            <p class="name-user-review">Jane Smith</p>
                            <p class="created_at">Reviewed on September 29, 2024</p>
                        </div>
                    </div>
                </div>
                <!-- Tambahkan lebih banyak review-card sesuai kebutuhan -->
            </div>
        </div>
    </section>


    <!-- Section About Us -->
    <section class="section-about-us">
        <div class="container-about">
            <img src="frontend/svg/images/about.svg" alt="About Us" class="about-image">
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
                <button class="learn-more-btn">Learn More</button>
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
