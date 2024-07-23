@extends('layouts.success')

@section('title', 'Checkout Success')

@section('content')
<main>
    <div class="section-success d-flex align-items-center">
        <div class="col text-center">
            <img src="{{ url('frontend/images/success.png') }}" alt="" style="width: 300px; height: auto;">
            <h1>Oops!</h1>
            <p>
                Your transaction is unfinished.
                <br>
                please read it as well
            </p>
            <a href="{{ url('/')}}" class="btn btn-home-page mt-3 px-5">
                Home Page
            </a>
        </div>
    </div>
</main>
    
@endsection