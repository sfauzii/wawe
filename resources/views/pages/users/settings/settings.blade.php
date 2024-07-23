@extends('layouts.users')

@section('content')
    <h1>Settings</h1>

    <p class="desc-title">Pengaturan akun yang mungkin
        dibutuhkan selama <br>proses transaksi</p>

    <!-- <div class="date">
                    <input type="date">
                </div> -->
    <div class="settings">
        <div class="my-profile" onclick="window.location.href='#';">
            <span class="material-icons">account_circle</span>
            <div class="middle">
                <div class="left">
                    <h1>My Profile</h1>
                    <p>Ubah data diri kamu</p>
                </div>
                <div class="right">
                    <button class="edit-profile-button" onclick="window.location.href='#';">Edit
                        Profile</button>
                </div>
            </div>
        </div>
        <div class="my-password" onclick="window.location.href = '#';">
            <span class="material-icons">password</span>
            <div class="middle">
                <div class="left">
                    <h1>My Password</h1>
                    <p>Ganti kata sandimu</p>
                </div>
                <div class="right">
                    <button class="edit-profile-button" onclick="window.location.href = '#';">Edit
                        Password</button>
                </div>
            </div>
        </div>

    </div>
@endsection
