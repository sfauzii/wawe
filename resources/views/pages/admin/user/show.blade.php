@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Profile {{ ucwords($user->name) }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ $user->photo ? Storage::url($user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                            alt="{{ $user->name }}" alt="Profile" class="rounded-circle">
                        <h2>{{ ucwords($user->name) }}</h2>
                        <h3>{{ $user->email }}</h3>

                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body profile-card pt-4 flex flex-column align-items center">

                            <div class="my-3 p-3 pb-0">
                                <form>
                                    <!-- Created At -->
                                    <div class="row mb-4">
                                        <div class="col-sm-10">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar-alt mr-2"></i> <!-- Icon untuk tanggal -->
                                                <span style="font-weight: bold"><i class="ri-calendar-schedule-line"></i>
                                                    Created At: <span
                                                        style="color: #000000; font-weight: 400   ">{{ $user->created_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                                <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Updated At -->
                                    <div class="row mb-0">
                                        <div class="col-sm-10">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                                <span style="font-weight: bold"><i class="ri-calendar-schedule-line"></i>
                                                    Last Update: <span
                                                        style="color: #000000; font-weight: 400   ">{{ $user->updated_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                                <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                            </div>
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">


                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label " style="color: #000000; font-weight: bold; ">ID
                                    </div>
                                    <div class="col-lg-9 col-md-8">{{ $user->id }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label " style="color: #000000; font-weight: bold; ">Full
                                        Name</div>
                                    <div class="col-lg-9 col-md-8">{{ ucwords($user->name) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label " style="color: #000000; font-weight: bold; ">
                                        Username</div>
                                    <div class="col-lg-9 col-md-8">{{ '@' . $user->username }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label" style="color: #000000; font-weight: bold; ">Email
                                    </div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label" style="color: #000000; font-weight: bold;">Phone
                                    </div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($user->phone))
                                            {{ $user->phone }}
                                        @else
                                            <span style="color: red;">Pengguna belum melengkapi</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label" style="color: #000000; font-weight: bold;">Email
                                        Verified</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($user->email_verified_at))
                                            <span
                                                style="color: #000000; font-weight: 400">{{ $user->email_verified_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span>
                                        @else
                                            <span style="color: red;">Not Verified</span>
                                        @endif
                                    </div>
                                </div>


                            </div>



                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
