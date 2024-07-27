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
                    <a href="{{ route('ticket-detail', ['id' => $item->id]) }}" target="_blank" class="list-ticket"
                        style="text-decoration: none; display: block; cursor: pointer;">
                        <img src="{{ asset('storage/' . $item->travel_package->galleries[0]->image) }}"
                            alt="{{ $item->travel_package->title }}">
                        <div class="middle">
                            <div class="left">
                                <h2 class="ticket-title">{{ $item->travel_package->title }}</h2>
                                <h3 class="date-ticket">
                                    {{ \Carbon\Carbon::create($item->travel_package->departure_date)->format('d F Y') }}
                                </h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@endsection
