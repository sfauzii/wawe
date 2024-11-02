@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Edit {{ $item->title }} </h1>
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

                        <!-- General Form Elements -->
                        <div class="my-4 p-4 pb-0">
                            <form action="{{ route('gallery.update', encrypt($item->id)) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <div class="row mb-3">
                                    <label for="travel_packages_id" class="col-sm-2 col-form-label"
                                        style="font-weight: bold; color: #012970;">Travel Package</label>
                                    <div class="col-sm-10">
                                        <select name="travel_packages_id" class="form-select"
                                            aria-label="Default select example">
                                            <option value="{{ $item->travel_packages_id }}">Jangan Diubah</option>
                                            @foreach ($travel_packages as $travel_package)
                                                <option value="{{ $travel_package->id }}">
                                                    {{ ucwords($travel_package->title) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        {{-- <input class="form-control" type="file" name="images[]" multiple
                                            placeholder="Image"> --}}

                                        <!-- File uploader with multiple files upload -->
                                        <input type="file" name="images[]" class="image-preview-filepond"
                                            accept="image/png,image/jpeg,image/jpg,image/webp" multiple>
                                        @error('images')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('images.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">You can select multiple images. Existing images will be
                                            preserved unless removed.</small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block w-100"
                                    style="background-color: #012970;">
                                    Edit
                                </button>
                            </form>
                        </div>
                        <!-- End General Form Elements -->

                        <div class="my-4 px-4 pb-0">
                            <div class="row mt-5 mb-3">
                                <label for="existing_images" class="col-sm-2 col-form-label">Existing Images</label>
                                <div class="col-sm-10">
                                    @if ($item->image)
                                        @foreach ($item->image as $index => $image)
                                            <div class="mb-2 d-inline-block position-relative">
                                                <img src="{{ Storage::url($image) }}" alt="Image"
                                                    style="width: 150px; height: auto;" class="img-thumbnail">
                                                <form
                                                    action="{{ route('gallery.delete_image', ['id' => encrypt($item->id), 'index' => $index]) }}"
                                                    method="POST" class="position-absolute top-0 end-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="ri-delete-bin-6-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No existing images.</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Last Information</h5>

                        <!-- Advanced Form Elements -->

                        <div class="my-2 p-2 pb-0">
                            <form>
                                <!-- Created At -->
                                <div class="row mb-4">
                                    <div class="col-sm-10">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt mr-2"></i> <!-- Icon untuk tanggal -->
                                            <span style="font-weight: bold; color: #012970;"><i
                                                    class="ri-calendar-schedule-line"></i> Created At: <span
                                                    style="color: #000000; font-weight: 400   ">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                            <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Updated At -->
                                <div class="row mb-2">
                                    <div class="col-sm-10">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                            <span style="font-weight: bold; color: #012970;"><i
                                                    class="ri-calendar-schedule-line"></i> Last Update: <span
                                                    style="color: #000000; font-weight: 400   ">{{ $item->updated_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                            <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- End General Form Elements -->

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
