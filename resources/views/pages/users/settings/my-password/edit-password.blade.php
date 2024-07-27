@extends('layouts.users')

@section('title')
    My Password
@endsection

@section('content')
    <h1>Edit Password</h1>
    <p class="desc-title">
        Amankan akun Anda dengan <br>kombinasi password yang baik
    </p>

    <div class="content">
        <div class="profile-container">
            <form class="edit-profile-form" action="{{ route('edit-password.update') }}" method="POST">
                @csrf


                <div class="form-group">
                    <label for="password">Old Password</label>
                    <input type="password" id="old_password" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <button type="submit" class="btn-submit">Update Now</button>
            </form>
        </div>

    </div>
@endsection
