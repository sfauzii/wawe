@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Edit Travel Package {{ $item->title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('travel-package.update', $item->id ) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $item->title }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="location" class="col-sm-2 col-form-label">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="location" placeholder="Location" value="{{ $item->location }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="about" class="col-sm-2 col-form-label">About</label>
                                <div class="col-sm-10">
                                    <textarea  name="about" class="form-control" style="height: 100px">{{ $item->about }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="departure_date" class="col-sm-2 col-form-label">Departure Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="departure_date" placeholder="Departure Date" value="{{ $item->departure_date }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="duration" class="col-sm-2 col-form-label">Duration</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ $item->duration }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="type" placeholder="Type" value="{{ $item->type }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="price" class="form-control" name="price" placeholder="Price" value="{{ $item->price }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                Edit
                            </button>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
