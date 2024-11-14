@extends('layouts.users')

@section('title')
    My Profile
@endsection

@section('content')
    <h1>Edit Profile</h1>
    <p class="desc-title">
        Masukkan informasi yang valid <br />agar proses transaksi lebih mudah
    </p>

    <div class="content">
        <div class="profile-container">
            <form class="edit-profile-form" method="POST" action="{{ route('edit-profile.update', ['id' => $user->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="photo-upload">
                    <label for="profile-pic">
                        @if ($user->photo)
                            <img id="output" src="{{ asset('storage/' . $user->photo) }}" alt="Profile Picture" />
                        @else
                            <img id="output"
                                src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                                alt="Profile Picture" />
                        @endif
                    </label>
                    <input type="file" id="photo" name="photo" accept="image/*" onchange="loadFile(event)" />
                    <div class="file-info" id="file-info">
                        Format file jpg, jpeg, png.
                    </div>
                </div>
                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" name="name" value="{{ old('name', $user->name) }}" required />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" readonly
                        required />
                </div>
                <div class="form-group">
                    <label for="full-name">Username</label>
                    <input type="text" id="full-name" name="username" value="{{ old('username', $user->username) }}"
                        required />
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required />
                </div>
                <button type="submit" class="btn-submit">Save My Profile</button>
            </form>
        </div>

        <!-- New Card Section -->
        <div class="info-card">
            <div class="icon-container">
                <!-- Icon can be replaced with any other relevant icon -->
                <img src="{{ url('frontend/images/wa.png') }}" alt="Icon" class="card-icon" />
                <!-- <div class="icon-container">
                                        <i class="ri-whatsapp-line"></i>
                                    </div> -->
            </div>
            <p class="card-description">Hubungi via WhatsApp</p>
            <button class="card-button" onclick="window.open('https://api.whatsapp.com/send?phone=088229877220&text=Hello%20I%20saya%20butuh%20to%20bantuan%20tentang...', '_blank')">Contact Us</button>
        </div>
    @endsection

    <script>
        function loadFile(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    </script>
