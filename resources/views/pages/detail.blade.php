@extends('layouts.app')


@section('title')
    Detail | {{ $item->title }}
@endsection

@section('content')

    {{-- Login Pop Up --}}
    <x-login-popup />



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
                                    <a href="{{ route('details', $item->slug) }}">Package {{ ucwords($item->title) }}</a>
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
                                    @if ($item->galleries->count() > 0)
                                        <img src="{{ Storage::url($item->galleries->first()->image[0]) }}"
                                            alt="Details gambar" class="xzoom" id="xzoom-default"
                                            xoriginal="{{ Storage::url($item->galleries->first()->image[0]) }}">
                                    @else
                                        <!-- Fallback or placeholder image -->
                                        <img src="{{ asset('path/to/placeholder-image.jpg') }}" alt="No image available"
                                            class="xzoom" id="xzoom-default">
                                    @endif
                                </div>
                            </div>
                            <div class="xzoom-thumbs">
                                @foreach ($item->galleries as $gallery)
                                    @foreach ($gallery->image as $image)
                                        <a href="{{ Storage::url($image) }}">
                                            <img src="{{ Storage::url($image) }}" class="xzoom-gallery" width="128"
                                                xpreview="{{ Storage::url($image) }}" alt="">
                                        </a>
                                    @endforeach
                                @endforeach
                                <!-- Tambahkan gambar thumbnail lainnya di sini -->
                            </div>
                        </div>
                    @endif

                    <div class="product-info">
                        <div class="category-badge">{{ ucwords($item->type) }}</div>
                        <div class="title-and-testimonials">
                            <h1 class="product__title">{{ ucwords($item->title) }}</h1>
                            {{-- <span class="testimonials"><a href="#review">{{ $testimoniesCount }} Testimonials</a></span> --}}
                            <span class="testimonials">Last updated: {{ $item->updated_at->diffForHumans() }}</span>
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
                                <img src="{{ url('frontend/images/icons/people.png') }}" alt="Facebook Icon"
                                    class="icon">
                                <span>{{ $item->kuota }} person</span>
                            </div>
                            <div class="feature">
                                <!-- <ion-icon name="calendar-outline" class="icon"></ion-icon> -->
                                <img src="{{ url('frontend/images/icons/tag.png') }}" alt="Facebook Icon" class="icon">
                                <span>{{ ucwords($item->location) }}</span>
                            </div>
                            <div class="feature">
                                <!-- <ion-icon name="calendar-outline" class="icon"></ion-icon> -->
                                <img src="{{ url('frontend/images/icons/dollar-circle.png') }}" alt="Facebook Icon"
                                    class="icon">
                                <span>{{ number_format($item->price, 0, ',') }}</span>
                            </div>

                            <!-- Tambahkan feature lainnya di sini -->
                        </div>
                        {{-- <div class="seller-card">
                            <img src="{{ url('frontend/images/avatar.png') }}" alt="Seller Image" class="seller-image">
                            <div class="seller-info">
                                {{~~ <h2 class="seller-name">{{ ucwords($item->users->first()->name ?? 'Unknown') }}</h2> ~~}}
                                {{~~ <h2 class="seller-name">Last Updated: {{ $item->updated_at->diffForHumans() }}</h2> ~~}}
                                <p class="seller-description">Last Updated: {{ $item->updated_at->diffForHumans()  }}</p>
                            </div>
                            <button class="contact-seller-btn">Contact Seller</button>
                        </div> --}}
                    </div>
                </section>

                <section class="product-description">
                    <h3>About the Product</h3>
                    <p>{!! ucfirst($item->about) !!}</p>
                    <div class="additional-info">
                        @php
                            $features = explode(',', $item->features);
                        @endphp
                        @foreach (array_chunk($features, 4) as $chunk)
                            @foreach ($chunk as $feature)
                                <div class="info-card">

                                    <div class="icons-details">
                                        <img src="{{ url('frontend/images/icons/tick-circle.png') }}" alt="Check Icon"
                                            class="icon-detail-img">
                                    </div>

                                    <div class="info-content">
                                        <h4>{{ ucwords($feature) }}</h4>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach


                    </div>
                </section>

                <div class="details-container">
                    <!-- Testimonies Section -->
                    <aside class="testimonies-card w-100" id="review">
                        <h3 class="testimonies-header">From Happy Customers ({{ $testimoniesCount }})</h3>
                        @foreach ($testimonies as $testimony)
                            <div class="testimoni-card">
                                <img src="{{ $testimony->user->photo ? asset('storage/' . $testimony->user->photo) : 'https://ui-avatars.com/api/?name=' . $testimony->user->name }}"
                                    alt="User Photo {{ ucfirst($testimony->user->name) }}" class="testimonial-photo">
                                <div>
                                    <p>"{{ $testimony->message }}"</p>
                                    @if (!empty($testimony->photos) && is_array($testimony->photos))
                                        @foreach ($testimony->photos as $photo)
                                            <img src="{{ asset('storage/' . $photo) }}" alt="Photo"
                                                style="width: 80px; height: auto; ">
                                        @endforeach
                                    @else
                                    @endif
                                    <small>- {{ ucfirst($testimony->user->name) }}</small>
                                    <small>, {{ $testimony->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        @endforeach

                        <!-- Tambahkan lebih banyak testimonial cards jika diperlukan -->
                    </aside>

                    <!-- Product Information Section -->
                    <aside class="card-information">
                        <div class="price">
                            <h3>Rp {{ number_format($item->price, 0, ',') }}<span>/person</span></h3>
                        </div>
                        <div>
                            Trip Information
                            <hr>
                        </div>
                        <div class="details">
                            <h4>Date</h4>
                            <p>{{ \Carbon\Carbon::create($item->departure_date)->format('d F Y') }}</p>
                            <h4>Location</h4>
                            <p>{{ ucwords($item->location) }}</p>
                            <h4>Duration</h4>
                            <p>{{ $item->duration }}</p>
                            <h4>Kuota</h4>
                            <p>{{ $item->kuota }} person</p>
                            <h4>Type</h4>
                            <p>{{ ucwords($item->type) }}</p>
                        </div>


                        @auth
                            <form action="{{ route('checkout_process', $item->id) }}" method="POST">
                                @csrf
                                <button class="purchase-btn" type="submit">Join Now</button>
                            </form>
                        @endauth


                        @guest
                            <button id="login-btn" type="button" class="purchase-btn">Login or Register to Join</button>
                        @endguest
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
