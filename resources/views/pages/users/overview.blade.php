@extends('layouts.users')

@section('title')
    Overview - {{ ucfirst(Auth::user()->name) }}
@endsection

@section('content')
    <h1>Overview</h1>
    <p class="desc-title">Anda telah membuat kemajuan besar</p>


    <div class="insights">
        <div class="sales">
            <!-- <span class="material-icons">trending_up</span> -->
            <div class="stats-icon">
                <img src="{{ url('frontend/images/icons/home-trend-up.png') }}" alt="Members Icon" class="icons-stats">
            </div>
            <div class="middle">
                <div class="left">
                    <h1>{{ number_format($incomeChange, 2) }}%</h1>
                    <p>
                        @if ($incomeChange > 0)
                            (Increase)
                        @elseif ($incomeChange < 0)
                            (Decrease)
                        @else
                            (No Change)
                        @endif
                    </p>
                </div>

            </div>
        </div>
        <div class="expenses">
            <!-- <span class="material-icons">local_mall</span> -->
            <div class="stats-icon">
                <img src="{{ url('frontend/images/icons/bag-tick-2.png') }}" alt="Members Icon" class="icons-stats">
            </div>
            <div class="middle">
                <div class="left">
                    <h1>{{ $totalTickets }}</h1>
                    <p>Your Tickets</p>
                </div>

            </div>
        </div>
        <div class="income">
            <!-- <span class="material-icons">stacked_line_chart</span> -->
            <div class="stats-icon">
                <img src="{{ url('frontend/images/icons/ticket-discount-white.png') }}" alt="Members Icon"
                    class="icons-stats">
            </div>
            <div class="middle">
                <div class="left">
                    <h1>Rp {{ number_format($totalIncome, 0, ',') }}</h1>
                    <p>Has been used</p>
                </div>

            </div>
        </div>

    </div>
@endsection
