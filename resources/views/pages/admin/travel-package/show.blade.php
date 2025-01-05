@extends('layouts.admin')

@section('title', 'Show Travel Package')


@section('content')

    <div class="pagetitle">
        <h1>Detail Travel Package</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('travel-package.index') }}">Home</a></li>
                <li class="breadcrumb-item">Travel Package</li>
                <li class="breadcrumb-item active">Detail {{ ucwords($travelPackage->title) }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Bordered Tabs</h5>

            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Testimonies
                        User</button>
                </li>

            </ul>
            <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table">
                        <tr>
                            <th>Judul</th>
                            <td>{{ ucwords($travelPackage->title) }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ ucwords($travelPackage->location) }}</td>
                        </tr>
                        <tr>
                            <th>Tentang</th>
                            <td>{!! ucfirst($travelPackage->about) !!}</td>
                        </tr>
                        <tr>
                            <th>Fasilitas</th>
                            <td>
                                @php $features = explode(',', $travelPackage->features); @endphp
                                <ul>
                                    @foreach ($features as $feature)
                                        <li>{{ ucwords($feature) }}</li>
                                    @endforeach
                                </ul>
                            </td>

                        </tr>
                        <tr>
                            <th>Tanggal Keberangkatan</th>
                            <td>{{ $travelPackage->departure_date }}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>{{ $travelPackage->duration }}</td>
                        </tr>
                        <tr>
                            <th>Kuota</th>
                            <td>{{ $travelPackage->kuota }}</td>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <td>{{ ucwords($travelPackage->type) }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ number_format($travelPackage->price) }}</td>
                        </tr>
                        <tr>
                            <th>Gallery</th>
                            <td>
                                {{-- @foreach ($travelPackage->galleries as $gallery)
                                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="" class="x-zoom" style="width: 200px; height: auto;">
                                @endforeach --}}

                                @if ($travelPackage->galleries->count())
                                    <div class="gallery">
                                        <div class="xzoom-container">
                                            {{-- <img src="{{ Storage::url($travelPackage->galleries->first()->image) }}" alt="Details gambar"
                                            class="xzoom" style="width: 200px; height: auto;" id="xzoom-default"
                                            xoriginal="{{ Storage::url($travelPackage->galleries->first()->image) }}"> --}}
                                        </div>
                                        <div class="xzoom-thumbs">
                                            @forelse ($travelPackage->galleries as $gallery)
                                                @foreach ($gallery->image as $image)
                                                    <a href="{{ Storage::url($image) }}">
                                                        <img src="{{ Storage::url($image) }}" alt="Image"
                                                            style="width: 100px; margin-right: 5px;" class="img-thumbnail"
                                                            class="xzoom-gallery" xpreview="{{ Storage::url($image) }}" />
                                                    </a>
                                                @endforeach
                                            @empty
                                                <p>No images</p>
                                            @endforelse
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                    @if ($testimonies->isEmpty())
                        <div class="alert alert-info">Tidak ada testimoni.</div>
                    @else
                        <div class="testimonial-wrapper">
                            @foreach ($testimonies as $testimony)
                                <div class="testimonial-item">
                                    <blockquote class="blockquote">
                                        <img src="{{ $testimony->user->photo ? asset('storage/' . $testimony->user->photo) : 'https://ui-avatars.com/api/?name=' . $testimony->user->name }} "
                                            alt="User Photo" class="user-photo"
                                            style="height: 50px; width: auto;>
                                        <p class="mb-0">{{ $testimony->message }}
                                        @if (!empty($testimony->photos) && is_array($testimony->photos))
                                            @foreach ($testimony->photos as $photo)
                                                <img src="{{ asset('storage/' . $photo) }}" alt="Photo"
                                                    style="width: 150px; height: auto;">
                                            @endforeach
                                        @else
                                            <p>No photos available.</p>
                                        @endif
                                        </p>
                                        <footer class="blockquote-footer">{{ ucwords($testimony->user->name) }}</footer>
                                    </blockquote>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div><!-- End Bordered Tabs -->

        </div>
    </div>
@endsection
