@extends('layouts.ticket')

@section('title')
    Your Ticket - {{ ucfirst(Auth::user()->name) }}
@endsection

@section('content')

    <main>
        <div class="container">
            <div class="title-section">
                <h1>Your Tickets</h1>
                <p>Unduh tiket Anda di sini untuk ditukarkan dengan tiket fisik saat acara berlangsung.</p>
            </div>

            <div class="card-container">
                <div class="card-header">
                    @if ($item->travel_package->galleries->isNotEmpty())
                        @php
                            $firstGallery = $item->travel_package->galleries->first();

                            $firstImagePath = is_array($firstGallery->image)
                                ? $firstGallery->image[0]
                                : $firstGallery->image;
                        @endphp

                        @if ($firstImagePath)
                            <img src="{{ asset('storage/' . $firstImagePath) }}"
                                alt="{{ ucwords($item->travel_package->title) }}" class="profile-img">
                        @else
                            <p>No image available.</p>
                        @endif
                    @else
                        <p>No galleries available.</p>
                    @endif
                    <div class="header-info">
                        <h2>{{ ucwords($item->travel_package->title) }}</h2>
                        <span class="badge">{{ $item->transaction_status }}</span>
                    </div>
                </div>

                <div class="icon-list">
                    <div class="icon-item">
                        <img src="{{ url('frontend/images/icons/calendar.png') }}" alt="Calendar Icon" class="icon">
                        <p>{{ \Carbon\Carbon::create($item->travel_package->departure_date)->format('d F Y') }}</p>
                    </div>
                    <div class="icon-item">
                        <img src="{{ url('frontend/images/icons/people.png') }}" alt="People Icon" class="icon">
                        <p>{{ $transactionDetails->count() }} person</p>
                    </div>
                    <div class="icon-item">
                        <img src="{{ url('frontend/images/icons/tag.png') }}" alt="Tag Icon" class="icon">
                        <p>{{ ucwords($item->travel_package->type) }}</p>
                    </div>
                    <div class="icon-item">
                        <img src="{{ url('frontend/images/icons/dollar-circle.png') }}" alt="Price Icon" class="icon">
                        <p>Rp {{ number_format($item->grand_total, 0, ' ') }}</p>
                    </div>
                </div>

                <hr class="divider">

                <div class="description">
                    <h3>What's Next?</h3>
                    <p>Silahkan untuk bergabung pada <strong class="mt-5"><a
                                href="https://chat.whatsapp.com/KMK91AjwdCfGkaENT4R9xp" target="_blank">Group
                                Whatsapp</a></strong></p>
                    </p>
                </div>

                <div class="button-container">
                    <button class="action-button"
                        onclick="window.location.href = '{{ route('testimony.create', $item->id) }}';">Testimonies</button>
                    <button class="action-button-secondary"
                        onclick="window.location.href = '{{ route('ticket-download', $item->id) }}';">Download
                        Ticket</button>
                </div>
            </div>

            <footer>
                <p>&copy; 2024 WaWe Tour and Travel. All rights reserved.</p>
            </footer>
        </div>
    </main>
@endsection
