@extends('layouts.users')

@section('title')
    My Ticket - {{ ucfirst(Auth::user()->name) }}
@endsection

@section('content')
    <h1>My Ticket</h1>
    <p class="desc-title">Daftar tiket paket perjalanan anda</p>
    <!-- start list ticket -->
    <div class="ticket">
        @foreach ($items as $item)
            @if ($item->user->id === Auth::id())
                <div class="list-ticket">
                    @if ($item->travel_package->galleries->isNotEmpty())
                        @php
                            $firstImage = $item->travel_package->galleries->first()->image; // Get the first image array
                            $firstImagePath = is_array($firstImage) ? $firstImage[0] : ''; // Get the first image from the array
                        @endphp
                        @if ($firstImagePath)
                            <img src="{{ asset('storage/' . $firstImagePath) }}"
                                alt="{{ ucwords($item->travel_package->title) }}">
                        @else
                            <!-- Fallback content if there is no image -->
                            <p>No image available.</p>
                        @endif
                    @else
                        <!-- Fallback content if there are no galleries -->
                        <p>No galleries available.</p>
                    @endif
                    <div class="middle">
                        <div class="left">
                            <h2 class="ticket-title"
                                onclick="window.open('{{ route('ticket-detail', ['id' => $item->id]) }}', '_blank')">
                                Pantai
                                {{ ucwords($item->travel_package->title) }}</h2>
                            <div class="date-tooltip-container">
                                <h3 class="date-ticket">
                                    {{ \Carbon\Carbon::create($item->travel_package->departure_date)->format('d F Y') }}
                                </h3>
                                <div class="tooltip-icon package">
                                    <span class="icon-img package">?</span>
                                    <span class="tooltip-text package">
                                        <h1 class="tooltip-title">Info Ticket</h1>
                                        Jangan lupa untuk mendowload ticket sebelum keberangkatan
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
