@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
{{-- @section('message', __($exception->getMessage() ?: 'Forbidden')) --}}

@section('message')

    <div class="page-403">
        <div class="container">
            <div class="background-403">403</div>
            <img src="{{ url('frontend/images/403.png') }}" alt="404 Image" class="image-403">
            <div class="message-403">Sorry, you do not have permission to access this page.</div>
            <a href="{{ route('home') }}" class="back-home">
                <i class="ri-arrow-go-back-line icon"></i>
                Go Home
            </a>

        </div>
    </div>

@endsection
