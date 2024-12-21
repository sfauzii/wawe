@extends('layouts.success')

@section('title', 'Checkout Failed')

@section('content')
    <main>
        <div class="section-success d-flex align-items-center">
            <div class="col text-center">
                <img src="{{ url('frontend/images/success.png') }}" alt="" style="width: 300px; height: auto;">
                <h1>Oopss!</h1>
                <p>
                    Your transaction is failed
                    <br>
                    Please contact our representative if this problem occurs
                </p>
              
                <button class="get-started-button" onclick="window.location.href = 'https://wa.me/6285786192909?text=Halo%2C+saya+ingin+bantuan+tentang+transaksi+saya.';">Contact Us</button>
            </div>
        </div>
    </main>

@endsection
