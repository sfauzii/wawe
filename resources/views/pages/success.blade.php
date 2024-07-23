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
                            <img src="{{ asset('storage/' . $items->travel_package->galleries[0]->image) }}" alt="{{ $items->travel_package->title }}">
                        </div>
                        <div class="product-details">
                            <h2 class="product-title">{{ $items->travel_package->title }}</h2>
                            <div class="product-status">
                                <p>{{ $items->transaction_status }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="icon-container">
                        <span class="icon">
                            <!-- <ion-icon name="calendar-outline"></ion-icon> -->
                             <img src="{{ url('frontend/images/icons/calendar.png') }}" alt="Check Icon" class="icon-img-succes">
                            <!-- Ganti dengan ikon Font Awesome yang sesuai -->
                        </span>
                        <div class="icon-description">
                            <p>{{ \Carbon\Carbon::create($items->travel_package->departure_date)->format('d F Y') }}</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="people-outline">Ganti dengan ikon Font Awesome yang sesuai -->
                                <img src="{{ url('frontend/images/icons/people.png') }}" alt="Check Icon" class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>1 person</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="pricetag-outline"></ion-icon>Ganti dengan ikon Font Awesome yang sesuai -->
                            <img src="{{ url('frontend/images/icons/tag.png') }}" alt="Check Icon" class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>{{ $items->travel_package->type }}</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="cash-outline"></ion-icon> -->
                            <!-- Ganti dengan ikon Font Awesome yang sesuai -->

                            <img src="{{ url('frontend/images/icons/dollar-circle.png') }}" alt="Check Icon" class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>{{ $items->transaction_total }}</p>
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
                        <button class="action-button-secondary" onclick="window.location.href='{{ route('home') }}';">Explore Again</button>
                        <button class="action-button-secondary" onclick="window.location.href = 'dashboard.html';">My
                            Dashboard</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="section-success d-flex align-items-center">
            <div class="col text-center">
                <img src="frontend/images/success.png" alt="">
                <h1>Yay! Success</h1>
                <p>
                    We've sent you email for trip instruction
                    <br>
                    please read it as well
                </p>
                <a href="index.html" class="btn btn-home-page mt-3 px-5">
                    Home Page
                </a>
            </div>
        </div> -->

        <!-- Footer -->
        <!-- <footer>
            <p>&copy; 2024 Your Company. All rights reserved.</p>
        </footer> -->

    </main>

{{-- <main>
    <div class="section-success d-flex align-items-center">
        <div class="col text-center">
            <img src="{{ url('frontend/images/success.png') }}" alt="" style="width: 300px; height: auto;">
            <h1>Yay! Success</h1>
            <p>
                We've sent you email for trip instruction
                <br>
                please read it as well
            </p>
            <a href="{{ url('/')}}" class="btn btn-home-page mt-3 px-5">
                Home Page
            </a>
        </div>
    </div>
</main> --}}
    
@endsection