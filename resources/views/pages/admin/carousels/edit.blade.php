@extends('layouts.admin')

@section('content')


    <div class="pagetitle">
        <h1>Edit Carousel </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('carousels.index') }}">Home</a></li>
                <li class="breadcrumb-item">{{ $carousel->title_carousel }}</li>
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

                        <div class="my-4 p-4">
                            <form action="{{ route('carousels.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                        
                                <div class="mb-3">
                                    <div class="form-group">
                                        {{-- <label for="image_carousel">Current Image</label>
                                        <br>
                                        <img src="{{ Storage::url($carousel->image_carousel) }}" alt="{{ $carousel->title_carousel }}" width="150">
                                        <br><br> --}}
                                        <label for="image_carousel">Upload New Image (optional)</label>
                                        <input type="file" name="image_carousel" class="form-control @error('image_carousel') is-invalid @enderror">
                                        @error('image_carousel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="title_carousel">Title</label>
                                        <input type="text" name="title_carousel" value="{{ old('title_carousel', $carousel->title_carousel) }}"
                                            class="form-control @error('title_carousel') is-invalid @enderror" required>
                                        @error('title_carousel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="description_carousel">Description</label>
                                        <textarea name="description_carousel" class="form-control @error('description_carousel') is-invalid @enderror" required>{{ old('description_carousel', $carousel->description_carousel) }}</textarea>
                                        @error('description_carousel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    

                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Current Image</h5>

                        <!-- Advanced Form Elements -->
                        <form>
                            <!-- Created At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url($carousel->image_carousel) }}" alt="{{ $carousel->title_carousel }}" width="390">
                                    </div>
                                </div>
                            </div>

                            <!-- Updated At -->
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span style="font-weight: bold; color: #012970;"><i
                                                class="ri-calendar-schedule-line"></i> Created At: <span
                                                style="color: #000000; font-weight: 400   ">{{ $carousel->created_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                        <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span style="font-weight: bold; color: #012970;"><i
                                                class="ri-calendar-schedule-line"></i> Updated At: <span
                                                style="color: #000000; font-weight: 400   ">{{ $carousel->updated_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
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
