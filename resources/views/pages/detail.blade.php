@extends('layouts.app')

@section('content')

    <main>
        <!-- Breadcrumbs -->
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    Paket Healing
                                </li>
                                <li class="breadcrumb-item active">
                                    Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>


                <section class="details-section">
                    @if ($item->galleries->count())
                        <div class="gallery">
                            <div class="xzoom-main">
                                <div class="xzoom-container">
                                    <img src="{{ Storage::url($item->galleries->first()->image) }}" alt="Details gambar"
                                        class="xzoom" id="xzoom-default"
                                        xoriginal="{{ Storage::url($item->galleries->first()->image) }}">
                                </div>
                            </div>
                            <div class="xzoom-thumbs">
                                @foreach ($item->galleries as $gallery)
                                    <a href="{{ Storage::url($gallery->image) }}">
                                        <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery"
                                            xpreview="{{ Storage::url($gallery->image) }}" alt="">
                                    </a>
                                @endforeach
                                <!-- Tambahkan gambar thumbnail lainnya di sini -->
                            </div>
                        </div>
                    @endif

                    <div class="product-info">
                        <div class="category-badge">{{ $item->type }}</div>
                        <div class="title-and-testimonials">
                            <h1 class="product__title">{{ $item->title }}</h1>
                            <span class="testimonials">123 Testimonials</span>
                        </div>
                        <div class="product-features">
                            <div class="feature">
                                <!-- <ion-icon name="calendar-outline" class="icon"></ion-icon> -->
                                <img src="{{ url('frontend/images/icons/calendar.png') }}" alt="Facebook Icon"
                                    class="icon">
                                <span>{{ \Carbon\Carbon::create($item->departure_date)->format('d F Y') }}</span>
                            </div>
                            <div class="feature">
                                <!-- <ion-icon name="calendar-outline" class="icon"></ion-icon> -->
                                <img src="{{ url('frontend/images/icons/people.png') }}" alt="Facebook Icon" class="icon">
                                <span>{{ $item->kuota }}</span>
                            </div>
                            <div class="feature">
                                <!-- <ion-icon name="calendar-outline" class="icon"></ion-icon> -->
                                <img src="{{ url('frontend/images/icons/tag.png') }}" alt="Facebook Icon" class="icon">
                                <span>{{ $item->location }}</span>
                            </div>
                            <div class="feature">
                                <!-- <ion-icon name="calendar-outline" class="icon"></ion-icon> -->
                                <img src="{{ url('frontend/images/icons/dollar-circle.png') }}" alt="Facebook Icon"
                                    class="icon">
                                <span>{{ $item->price }}</span>
                            </div>

                            <!-- Tambahkan feature lainnya di sini -->
                        </div>
                        <div class="seller-card">
                            <img src="{{ url('frontend/images/avatar.png') }}" alt="Seller Image" class="seller-image">
                            <div class="seller-info">
                                <h2 class="seller-name">Seller Name</h2>
                                <p class="seller-description">Brief description of the seller</p>
                            </div>
                            <button class="contact-seller-btn">Contact Seller</button>
                        </div>
                    </div>
                </section>

                <section class="product-description">
                    <h3>About the Product</h3>
                    <p>{!! $item->about !!}</p>
                    <div class="additional-info">
                        @php
                            $features = explode(',', $item->features);
                        @endphp
                        @foreach (array_chunk($features, 4) as $chunk)
                            @foreach($chunk as $feature)
                            <div class="info-card">

                                <div class="icons-details">
                                    <img src="{{ url('frontend/images/icons/tick-circle.png') }}" alt="Check Icon"
                                        class="icon-detail-img">
                                </div>
    
                                <div class="info-content">
                                    <h4>{{ $feature }}</h4>
                                </div>
                            </div>
                                
                            @endforeach
                            
                        @endforeach


                    </div>
                </section>

                <div class="details-container">
                    <!-- Testimonies Section -->
                    <aside class="testimonies-card">
                        <h3 class="testimonies-header">From Happy Customers</h3>
                        <div class="testimoni-card">
                            <img src="{{ url('frontend/images/member.png') }}" alt="User Photo" class="testimonial-photo">
                            <div>
                                <p>"Great experience!"</p>
                                <small>- John Doe</small>
                            </div>
                        </div>
                        <div class="testimoni-card">
                            <img src="{{ url('frontend/images/member.png') }}" alt="User Photo" class="testimonial-photo">
                            <div>
                                <p>"Amazing service!"</p>
                                <small>- Jane Doe</small>
                            </div>
                        </div>
                        <div class="testimoni-card">
                            <img src="{{ url('frontend/images/member.png') }}" alt="User Photo" class="testimonial-photo">
                            <div>
                                <p>"Would definitely recommend!"</p>
                                <small>- Alice Smith</small>
                            </div>
                        </div>
                        <div class="testimoni-card">
                            <img src="{{ url('frontend/images/member.png') }}" alt="User Photo" class="testimonial-photo">
                            <div>
                                <p>"Great value for money!"</p>
                                <small>- Bob Johnson</small>
                            </div>
                        </div>
                        <div class="testimoni-card">
                            <img src="{{ url('frontend/images/member.png') }}" alt="User Photo" class="testimonial-photo">
                            <div>
                                <p>"Very satisfied!"</p>
                                <small>- Emily Brown</small>
                            </div>
                        </div>
                        <!-- Tambahkan lebih banyak testimonial cards jika diperlukan -->
                    </aside>

                    <!-- Product Information Section -->
                    <aside class="card-information">
                        <div class="price">
                            <h3>Rp {{ $item->price }}<span>/day</span></h3>
                        </div>
                        <div>
                            Trip Information
                            <hr>
                        </div>
                        <div class="details">
                            <h4>Date</h4>
                            <p>{{ \Carbon\Carbon::create($item->departure_date)->format('d F Y') }}</p>
                            <h4>Location</h4>
                            <p>{{ $item->location }}</p>
                            <h4>Duration</h4>
                            <p>{{ $item->duration }}</p>
                            <h4>Kuota</h4>
                            <p>{{ $item->kuota }} person</p>
                            <h4>Type</h4>
                            <p>{{ $item->type }}</p>
                        </div>
                        <button class="purchase-btn" onclick="window.location.href = 'checkout.html';">Join Now</button>
                    </aside>
                </div>


            </div>

        </section>


    </main>



@endsection


@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}">
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    </script>
@endpush
