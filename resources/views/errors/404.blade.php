@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
{{-- @section('message', __('Not Found')) --}}

@section('message')
    <div class="page-404">
        <div class="container">
            <div class="background-404">404</div>
            <img src="{{ url('frontend/images/404.png') }}" alt="404 Image" class="image-404">
            <div class="message-404">Oops! The page you're looking for doesn't exist.</div>
            <a href="{{ route('home') }}" class="back-home">
                <i class="ri-arrow-go-back-line icon"></i>
                Go Home
            </a>

        </div>
    </div>
@endsection
