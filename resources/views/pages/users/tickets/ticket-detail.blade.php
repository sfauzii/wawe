@extends('layouts.ticket')

@section('title')
    Your Ticket - {{ ucfirst(Auth::user()->name) }}
@endsection

@section('content')
    <main>
        <div class="card-container">
            <div class="custom-card">
                <div class="card-content">
                    <div class="product-info">
                        <div class="product-image">
                            <img src="{{ asset('storage/' . $item->travel_package->galleries[0]->image) }}" alt="{{ $item->travel_package->title }}">
                        </div>
                        <div class="product-details">
                            <h2 class="product-title">{{ $item->travel_package->title }}</h2>
                            <div class="product-status">
                                <p>{{ $item->transaction_status }}</p>
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
                            <p>{{ \Carbon\Carbon::create($item->travel_package->departure_date)->format('d F Y') }}</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="people-outline">Ganti dengan ikon Font Awesome yang sesuai -->
                            <img src="{{ url('frontend/images/icons/people.png') }}" alt="Check Icon" class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>{{ $transactionDetails->count() }} person</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="pricetag-outline"></ion-icon>Ganti dengan ikon Font Awesome yang sesuai -->
                            <img src="{{ url('frontend/images/icons/tag.png') }}" alt="Check Icon" class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>{{ $item->travel_package->type }}</p>
                        </div>
                        <span class="icon">
                            <!-- <ion-icon name="cash-outline"></ion-icon> -->
                            <!-- Ganti dengan ikon Font Awesome yang sesuai -->

                            <img src="{{ url('frontend/images/icons/dollar-circle.png') }}" alt="Check Icon" class="icon-img-succes">
                        </span>
                        <div class="icon-description">
                            <p>IDR {{ number_format($item->transaction_total, 0, ',') }}</p>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="description">
                        <h3>What's Next?</h3>
                        <p>Silahkan untuk bergabung pada <strong class="mt-5"><a href="https://chat.whatsapp.com/KMK91AjwdCfGkaENT4R9xp" target="_blank">Group Whatsapp</a></strong></p>
                    </div>
                    <div class="buttons">
                        <button class="action-button"
                            onclick="window.location.href = '{{ route('testimony.create', $item->id) }}';">Testimonies</button>
                        <button class="action-button-secondary" onclick="window.location.href = '{{ route('ticket-download', $item->id) }}';">Download Ticket</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer>
            <p>&copy; 2024 WaWe Tour and Travel. All rights reserved.</p>
        </footer>
    </main>
@endsection
