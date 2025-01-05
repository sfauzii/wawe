@extends('layouts.auth')

@section('title', 'Email Verification')


@section('content')
    <section class="question-section">
        <div class="question-card">
            <img src="{{ url('frontend/svg/images/nunjuk.svg') }}" alt="Overlay Image" class="overlay-image" />
            <div class="question-content">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <h1>Hi, {{ ucwords(Auth::user()->name) }}!</h1>
                <h5>Verify your Email</h5>
                <p>
                    Account activation link sent to your email address:<br> <span
                        style="font-weight: bold;">{{ Auth::user()->email }}</span>. Please follow the button inside to
                    continue.
                </p>
                <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-primary">Resend</button>

                </form>
            </div>
        </div>
    </section>
@endsection
