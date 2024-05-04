@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Edit Travel Package {{ $item->title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item">Travel Package</li>
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
                        <form action="{{ route('travel-package.update', $item->id ) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $item->title }}">
                                    <small class="form-text text-muted">Nama package. Contoh: Package 1. Wajib diisi</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="location" class="col-sm-2 col-form-label">Location <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="location" placeholder="Location" value="{{ $item->location }}">
                                    <small class="form-text text-muted">Lokasi package. Contoh: Lokasi 1. Wajib diisi</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="about" class="col-sm-2 col-form-label">About <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea  name="about" class="form-control" style="height: 100px">{{ $item->about }}</textarea>
                                    <small class="form-text text-muted">Keterangan package. Contoh: Deskripsi dari tempat package</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="features" class="col-sm-2 col-form-label">Features <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea  name="features" class="form-control" style="height: 80px">{{ $item->features }}</textarea>
                                    <small class="form-text text-muted">Fasilitas package. Contoh: Fasilitas 1, Fasilitas 2, dst. Dipisahkan dengan koma (,). Wajib diisi</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="departure_date" class="col-sm-2 col-form-label">Departure Date <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="departure_date" placeholder="Departure Date" value="{{ $item->departure_date }}">
                                    <small class="form-text text-muted">Tanggal keberangkatan package. Contoh: 15 Juni 2017. Wajib diisi</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="duration" class="col-sm-2 col-form-label">Duration <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ $item->duration }}">
                                    <small class="form-text text-muted">Durasi. Contoh: 1 Hari. Wajib diisi</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type" class="col-sm-2 col-form-label">Type <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="type" placeholder="Type" value="{{ $item->type }}">
                                    <small class="form-text text-muted">Tipe. Contoh: Wisata Ibu dan Anak. Wajib diisi</small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Price <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="price" class="form-control" name="price" placeholder="Price" value="{{ $item->price }}">
                                    <small class="form-text text-muted">Harga. Contoh: 1000000. Wajib diisi</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block w-100">
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
