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
                <button class="get-started-button"
                    onclick="window.location.href = 'https://wa.me/6285786192909?text=Halo%2C+saya+ingin+bantuan+tentang+transaksi+saya.';">Contact
                    Us</button>
            </div>
        </div>
    </main>

@endsection
