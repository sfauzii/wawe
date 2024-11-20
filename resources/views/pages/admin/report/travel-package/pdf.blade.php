<!DOCTYPE html>
<html>

    <head>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                font-size: 12px;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .header img {
                width: 100px;
                /* Sesuaikan dengan ukuran yang diinginkan */
            }

            .header h1 {
                margin: 0;
                font-size: 24px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .total {
                margin-top: 20px;
                font-size: 16px;
                font-weight: bold;
                text-align: right;
            }

            .footer {
                margin-top: 30px;
                text-align: right;
                font-size: 14px;
            }
        </style>
    </head>

    <body>
        <div class="header">
            {{-- <img src="{{ asset('backend/assets/img/wawe.png') }}" alt="Logo Perusahaan"> --}}
            <h1>Laporan Package</h1>
        </div>

        <p class="mt-4">Periode: <strong>{{ \Carbon\Carbon::parse($start_date)->format('d F Y') }}</strong> sampai
            <strong>{{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</strong>
        </p>

        <div class="tab-content pt-2" id="borderedTabContent">
            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                @foreach ($packages as $package)
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>{{ $loop->iteration }}</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <td>{{ $package->id }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ ucwords($package->title) }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ ucwords($package->location) }}</td>
                        </tr>
                        <tr>
                            <th>Tentang</th>
                            <td>{{ $package->about }}</td>
                        </tr>
                        <tr>
                            <th>Fasilitas</th>
                            <td>
                                @php $features = explode(',', $package->features); @endphp
                                <ul>
                                    @foreach ($features as $feature)
                                        <li>{{ ucwords($feature) }}</li>
                                    @endforeach
                                </ul>
                            </td>

                        </tr>
                        <tr>
                            <th>Tanggal Keberangkatan</th>
                            <td>{{ $package->departure_date }}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>{{ $package->duration }}</td>
                        </tr>
                        <tr>
                            <th>Kuota</th>
                            <td>{{ $package->kuota }}</td>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <td>{{ ucwords($package->type) }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ number_format($package->price) }}</td>
                        </tr>
                        <tr>
                            <th>Gallery</th>
                            <td>
                                {{-- @foreach ($package->galleries as $gallery)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="" class="x-zoom" style="width: 200px; height: auto;">
                        @endforeach --}}

                                @if ($package->galleries->count())
                                    <div class="gallery">
                                        <div class="xzoom-container">
                                            {{-- <img src="{{ Storage::url($package->galleries->first()->image) }}" alt="Details gambar"
                                    class="xzoom" style="width: 200px; height: auto;" id="xzoom-default"
                                    xoriginal="{{ Storage::url($package->galleries->first()->image) }}"> --}}
                                        </div>
                                        <div class="xzoom-thumbs">
                                            {{-- @foreach ($package->galleries as $gallery)
                                        <a href="{{ Storage::url($gallery->image) }}">
                                            <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery"
                                                width="128" xpreview="{{ Storage::url($gallery->image) }}"
                                                alt="">
                                        </a>
                                    @endforeach --}}

                                            @foreach ($package->galleries as $gallery)
                                                @foreach ($gallery->image as $image)
                                                    <a href="{{ Storage::url($image) }}">
                                                        <img src="{{ Storage::url($image) }}" class="xzoom-gallery"
                                                            width="128" xpreview="{{ Storage::url($image) }}"
                                                            alt="">
                                                    </a>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <div class="mt-5">
                        <hr>
                    </div>
                @endforeach
            </div>
            {{-- <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
            @if ($testimonies->isEmpty())
                <div class="alert alert-info">Tidak ada testimoni.</div>
            @else
                <div class="testimonial-wrapper">
                    @foreach ($testimonies as $testimony)
                        <div class="testimonial-item">
                            <blockquote class="blockquote">
                                <img src="{{ $testimony->user->photo ? asset('storage/' . $testimony->user->photo) : 'https://ui-avatars.com/api/?name=' . $testimony->user->name }}"
                                    alt="User Photo" class="user-photo">
                                <p class="mb-0">{{ $testimony->message }}</p>
                                <footer class="blockquote-footer">{{ $testimony->user->name }}</footer>
                            </blockquote>
                        </div>
                    @endforeach
                </div>
            @endif
        </div> --}}

        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date and Time</th>
                    <th>Pakcage</th>
                    <th>Location</th>
                    <th>Departure Date</th>
                    <th>Sales</th>
                    <th>Total Sales (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $package->created_at->format('d F Y, H:i') }} WIB</td>
                        <td>{{ ucwords($package->title) }}</td>
                        <td>{{ ucwords($package->location) }}</td>
                        <td>{{ \Carbon\Carbon::parse($package->departure_date)->format('d F Y') }}</td>
                        <td>{{ $package->sales }}</td>
                        <td>Rp {{ number_format($package->total_sales_rupiah, 0, ',', '.') }}</td>
                        <!-- Total penjualan -->
                        {{-- <td><img src="{{ $package->travel_package->galleries->count() ? Storage::url($package->travel_package->galleries->first()->image) : '' }}"
                            alt="Package Image" style="width: 100px; height: auto;"></td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Report By: {{ Auth::user()->name }}
        </div>
    </body>

</html>
