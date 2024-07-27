@extends('layouts.users')

@section('title')
    Testimonies in {{ $transactionDetail->transaction->travel_package->title }}
@endsection

@section('content')
    <h1>Testimoni {{ $transactionDetail->transaction->travel_package->title }}</h1>
    <p class="desc-title">
        Masukkan informasi yang valid <br>agar proses transaksi lebih mudah
    </p>

    <div class="content">
        <div class="profile-container">
            <form class="edit-profile-form" action="{{ route('testimony.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" name="full-name"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" required readonly>
                </div>
                <div class="form-group">
                    <label for="full-name">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="3" required></textarea>
                </div>
                <div class="photo-upload">

                    <input type="file" id="photos" name="photos[]" multiple accept="image/*"
                        onchange="loadFile(event)" />
                    <div class="file-info" id="file-info">Format file jpg, jpeg, png.</div>
                </div>

                {{-- Menyimpan ID Detail Transaksi untuk mengaitkan testimoni dengan transaksi --}}
                <input type="hidden" name="transaction_detail_id" value="{{ $transactionDetail->id }}">

                {{-- Menyimpan ID User --}}
                <input type="hidden" name="users_id" value="{{ $user->id }}">
                <button type="submit" class="btn-submit">Send</button>
            </form>
        </div>


    </div>
@endsection
