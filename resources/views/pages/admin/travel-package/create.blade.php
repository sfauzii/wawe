@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Add Travel Package</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item">Create</li>
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
                            <form action="{{ route('travel-package.store') }}" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" placeholder="Title"
                                            value="{{ old('title') }}">
                                        <small class="form-text text-muted">Nama package. Contoh: Package 1. Wajib
                                            diisi</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="location" class="col-sm-2 col-form-label">Location <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="location" placeholder="Location"
                                            value="{{ old('location') }}">
                                        <small class="form-text text-muted">Lokasi package. Contoh: Lokasi 1. Wajib
                                            diisi</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="about" class="col-sm-2 col-form-label">About <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        {{-- <textarea name="about" class="form-control quill-editor-full" style="height: 100px">{{ old('about') }}</textarea> --}}
                                        <!-- TinyMCE Editor -->
                                        <textarea name="about" class="form-control tinymce-editor" style="background: white">{{ old('about') }}</textarea><!-- End TinyMCE Editor -->

                                        {{-- <div class="quill-editor-full mb-lg-auto" style="margin-bottom: 100px;">
                                            <!-- Input hidden untuk menyimpan konten dari Quill -->
                                            <input type="hidden" name="about" id="about" value="{{ old('about') }}">

                                        </div> --}}

                                        <small class="form-text text-muted">Keterangan package. Contoh: Deskripsi dari
                                            tempat
                                            package</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="features" class="col-sm-2 col-form-label">Features <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea name="features" class="form-control" style="height: 80px">{{ old('features') }}</textarea>
                                        <small class="form-text text-muted">Fasilitas package. Contoh: Fasilitas 1,
                                            Fasilitas 2,
                                            dst. Dipisahkan dengan koma (,). Wajib diisi</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="departure_date" class="col-sm-2 col-form-label">Departure Date <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="departure_date"
                                            placeholder="Departure Date" value="{{ old('departure_date') }}">
                                        <small class="form-text text-muted">Tanggal keberangkatan package. Contoh: 15 Juni
                                            2017.
                                            Wajib diisi</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="duration" class="col-sm-2 col-form-label">Duration <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="duration" placeholder="Duration"
                                            value="{{ old('duration') }}">
                                        <small class="form-text text-muted">Durasi. Contoh: 1 Hari. Wajib diisi</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="kuota" class="col-sm-2 col-form-label">Kuota <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="kuota" name="kuota"
                                            placeholder="Kuota" value="{{ old('kuota') }}" min="0"
                                            oninput="validateKuota(this)">
                                        <small class="form-text text-muted">Kuota. Contoh: 10. Wajib diisi</small>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="type" class="col-sm-2 col-form-label">Type <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="type" placeholder="Type"
                                            value="{{ old('type') }}">
                                        <small class="form-text text-muted">Tipe. Contoh: Wisata Ibu dan Anak. Wajib
                                            diisi</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="price" class="col-sm-2 col-form-label">Price <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="price" class="form-control" name="price" placeholder="Price"
                                            value="{{ old('price') }}">
                                        <small class="form-text text-muted">Harga. Contoh: 1000000. Wajib diisi</small>
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
{{-- 
<script>
    function validateKuota(input) {
        if (input.value < 0) {
            input.value = 0;
        }
    }
</script> --}}
