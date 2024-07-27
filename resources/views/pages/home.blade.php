@extends('layouts.app')


@section('title')

WaWe | Purbalingga, Jawa Tengah
    
@endsection

@section('content')
    <!-- Header -->

    <section class="curved-header">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
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
                </div>
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
                    @foreach ($items as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('details', $item->slug) }}" class="card-link">
                                <div class="card-travel text-center d-flex flex-column"
                                    style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');">
                                    <div class="overlay"></div>
                                    <div class="card-travel-content">
                                        <div class="travel-location">{{ $item->title }}</div>
                                        <div class="travel-price">Rp {{ number_format($item->price, 0, ',') }}</div>
                                        <div class="travel-icons">
                                            <ion-icon name="calendar-outline"></ion-icon>
                                            <span>{{ $item->duration }}</span>
                                            <ion-icon name="people-outline"></ion-icon>
                                            <span>{{ $item->kuota }} Persons</span>
                                            <ion-icon name="star-outline"></ion-icon> <span>{{ $item->testimonies_count }}</span>
                                        </div>
                                    </div>  
                                </div>
                            </a>
                        </div>
                    @endforeach


                </div>
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
                        <button class="btn-primary">Get Started</button>
                        <button class="btn-secondary">Learn More</button>
                    </div>
                </div>
                <div class="testimonial-right">
                    @foreach ($testimonies as  $testimony)

                    <div class="testimonial-card">
                        <h3>{{ $testimony->transactionDetail->transaction->travel_package->title }}</h3>
                        <p>
                            "{{ $testimony->message }}."
                        </p>
                        <div class="author-info">
                            <img src="{{ $testimony->user->photo ? asset('storage/' . $testimony->user->photo) : 'https://ui-avatars.com/api/?name=' . $testimony->user->name }}" alt="{{ $testimony->user->name }}" alt="Author Photo" style="width: auto;" />
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
                    <button class="get-started-button">Get Started</button>
                </div>
                <div class="my-service-image">
                    <img src="frontend/images/services-copy.png" alt="Service Image"/>
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
        <section class="question-section">
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
