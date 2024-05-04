@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Edit Gallery </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Home</a></li>
                <li class="breadcrumb-item">Gallery</li>
                {{-- <li class="breadcrumb-item active">Elements</li> --}}
            </ol>
        </nav>
    </div>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('gallery.update', $item->id ) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <label for="travel_packages_id" class="col-sm-2 col-form-label">Travel Package</label>
                                <div class="col-sm-10">
                                    <select name="travel_packages_id" class="form-select"
                                        aria-label="Default select example">
                                        <option value="{{ $item->travel_packages_id }}">Jangan Diubah</option>
                                        @foreach ($travel_packages as $travel_package)
                                            <option value="{{ $travel_package->id }}">
                                                {{ $travel_package->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="image" placeholder="Image">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                Edit
                            </button>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Last Information</h5>

                        <!-- Advanced Form Elements -->
                        <form>
                            <!-- Created At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span >Created At: <span style="color: #012970; font-weight: bold   ">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T')  }}</span></span>
                                        <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                    </div>
                                </div>
                            </div>

                            <!-- Updated At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span >Updated At: <span style="color: #012970; font-weight: bold   ">{{ $item->updated_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T')  }}</span></span>
                                        <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End General Form Elements -->

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
