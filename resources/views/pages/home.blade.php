@extends('layouts.app')


@section('title')
    WaWe | Purbalingga, Jawa Tengah
@endsection

@section('content')
    {{-- Login Pop Up --}}
    <x-login-popup />

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
                                    @if ($item->galleries->isNotEmpty())
                                        @foreach ($item->galleries as $gallery)
                                            @if (!empty($gallery->image) && count($gallery->image) > 0)
                                                @foreach ($gallery->image as $image)
                                                    <div class="carousel-slide">
                                                        <img src="{{ Storage::url($image) }}" alt="Image from gallery">
                                                    </div>
                                                @endforeach
                                            @else
                                                <!-- Jika gallery kosong atau tidak ada gambar -->
                                                <div class="carousel-slide">
                                                    <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <!-- Jika tidak ada gallery sama sekali -->
                                        <div class="carousel-slide">
                                            <img src="https://via.placeholder.com/150" alt="Placeholder Image">
                                        </div>
                                    @endif
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

                                <p class="card-description">Rp {{ number_format($item->price, 0, ',') }}</p>

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
                    {{-- <div class="col-md-4">
                        <h2>Our Networks</h2>
                        <p>
                            Companies are trusted us
                            <br />
                            more than just a trip
                        </p>
                    </div>
                    <div class="col-md-8 text-center">
                        <img src="frontend/images/network.png" alt="Logo Partner" class="img-partner" />
                    </div> --}}
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
                        Nikmati pengalaman wisata terbaik dengan layanan lengkap dan kenyamanan maksimal, dirancang khusus
                        untuk menciptakan momen tak terlupakan di setiap destinasi. 🌍✨.
                    </p>
                    <ul class="my-service-list">
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Destinasi Terbaik</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Harga Terjangkau</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Berpengalaman</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Terpercaya</p>
                        </li>
                        <li>
                            <div class="my-service-icon">
                                <i class="material-icons">check</i>
                            </div>
                            <p>Layanan pelanggan 24/7</p>
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
                        <span>Apakah saya bisa melakukan pembayaran dengan DP atau langsung full payment?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Anda memiliki dua pilihan dalam melakukan pembayaran:
                            <br><br>
                            <strong>1. Uang Muka (DP) 25%:</strong> Anda dapat membayar uang muka sebesar 25% dari total
                            biaya paket
                            wisata, dan sisa pembayaran dapat dilunasi sebelum tanggal keberangkatan.
                            <br><br>
                            <strong>2. Pembayaran Penuh (Full Payment):</strong> Anda juga bisa memilih untuk membayar
                            seluruh biaya
                            paket wisata langsung di awal.
                        </p>
                    </div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Bagaimana cara memesan paket wisata?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Cukup kunjungi website kami dan pilih paket wisata yang Anda minati. Ikuti proses pemesanan
                            untuk mengonfirmasi reservasi Anda.
                        </p>
                    </div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Apa saja yang termasuk dalam paket wisata?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Paket wisata kami mencakup akomodasi, makanan, transportasi, dan tur berpemandu. Beberapa paket
                            juga termasuk aktivitas tambahan.
                        </p>
                    </div>
                </div>

                <div class="faq-card" onclick="toggleFaq(this)">
                    <div class="faq-question">
                        <span>Apakah saya bisa menyesuaikan paket wisata?</span>
                        <i class="faq-icon">+</i>
                    </div>
                    <div class="faq-answer">
                        <p>
                            Tentu, kami menyediakan paket wisata yang dapat disesuaikan. Anda bisa menghubungi kami untuk
                            mendiskusikan preferensi Anda, dan kami akan menyesuaikan paket khusus untuk Anda.
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
                    <button class="btn btn-primary"
                        onclick="window.open('https://wa.me/6285786192909?text=Halo%2C+saya+ingin+bertanya+tentang+paket+wisata.+Bisakah+Anda+memberikan+informasi+lebih+lanjut%3F', '_blank')">Contact
                        Us</button>
                </div>
            </div>
        </section>
    </main>
@endsection
