@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Add Gallery</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="travel_packages_id" class="col-sm-2 col-form-label">Travel Package</label>
                                <div class="col-sm-10">
                                    <select name="travel_packages_id" class="form-select"
                                        aria-label="Default select example">
                                        <option selected>Open this select travel package</option>
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
                                Simpan
                            </button>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
