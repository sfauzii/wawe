@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Add Gallery</h1>
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
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <!-- General Form Elements -->
                        <div class="my-4 p-4 pb-0">
                            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="travel_packages_id" class="col-sm-2 col-form-label">Travel Package <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select name="travel_packages_id" class="form-select"
                                            aria-label="Default select example">

                                            <option selected>Open this select travel package</option>
                                            @forelse ($travel_packages as $travel_package)
                                                <option value="{{ $travel_package->id }}">
                                                    {{ $travel_package->title }}
                                                </option>
                                            @empty
                                                <option value="" disabled>Tidak ada paket travel tersedia</option>
                                            @endforelse
                                        </select>
                                        <small class="form-text text-muted">Package. Contoh: Candi Borobuddur. Wajib
                                            diisi</small>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">Image <span
                                            class="text-danger">*</span></label>
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
                                        <small class="form-text text-muted">Foto. img, jpg, jpeg, png. Wajib diisi</small>


                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block w-100">
                                    Simpan
                                </button>
                            </form>
                        </div>
                        <!-- End General Form Elements -->

                    </div>
                </div>

            </div>


        </div>
    </section>
@endsection
