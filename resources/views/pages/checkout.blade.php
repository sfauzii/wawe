@extends('layouts.app')

@section('title', 'Checkout')

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
                                <li class="breadcrumb-item">
                                    Details
                                </li>
                                <li class="breadcrumb-item active">
                                    Checkout
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Detail Content -->
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1>Who is going?</h1>
                            <p>
                                Trip to {{ $item->travel_package->title }}, {{ $item->travel_package->location }}
                            </p>
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Name</td>
                                            <td>Phone</td>

                                            {{-- <td>Nationality</td>
                                            <td>VISA</td>
                                            <td>Pasport</td> --}}
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item->details as $detail)
                                            <tr>
                                                <td>
                                                    <img src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                                                        height="60" class="rounded-circle" alt="">
                                                </td>
                                                <td class="align-middle">
                                                    {{ $detail->username }}
                                                </td>
                                                <td class="align-middle">
                                                    @if ($detail->phone)
                                                        {{ $detail->phone }} <!-- Nomor telepon dari TransactionDetail -->
                                                    @else
                                                        {{ $detail->transaction->user->phone }}
                                                        <!-- Jika tidak ada, tampilkan phone dari user yang login -->
                                                    @endif
                                                    <!-- Menampilkan nomor telepon pengguna -->
                                                </td>

                                                <td class="align-middle">
                                                    <a href="{{ route('checkout-remove', $detail->id) }}">
                                                        <img src="{{ url('frontend/images/ic_remove.png') }}"
                                                            alt="">
                                                    </a>
                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No Visitors
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form class="form-inline" method="post" action="{{ route('checkout-create', $item->id) }}">
                                    @csrf
                                    <label for="username" class="sr-only">Userame</label>
                                    <input type="text" name="username" required class="form-control mb-2 mr-sm-2"
                                        id="username" placeholder="Username">

                                    <label for="phone" class="sr-only">Phone</label>
                                    <input type="number" name="phone" required class="form-control mb-2 mr-sm-2"
                                        id="phone" placeholder="Phone">

                                    {{-- <label for="nationality" class="sr-only">Nationality</label>
                                    <input type="text" name="nationality" style="width: 50px" required
                                        class="form-control mb-2 mr-sm-2" id="nationality" placeholder="Nationality">

                                    <label for="is_visa" class="sr-only">Visa</label>
                                    <select name="is_visa" id="is_visa" required class="custom-select mb-2 mr-sm-2">
                                        <option value="" selected>VISA</option>
                                        <option value="1">30 Days</option>
                                        <option value="0">N/A</option>
                                    </select>

                                    <label for="doe_passport" class="sr-only">DOE Passport</label>
                                    <div class="input-group mb-2 mr-sm-2">
                                        <input type="text" class="form-control datepicker" name="doe_passport"
                                            id="doe_passport" placeholder="DOE Passport">
                                    </div> --}}

                                    {{--  --}}

                                    <button type="submit" class="btn btn-add-now mb-2 px-4">
                                        Add Now
                                    </button>
                                </form>
                                {{-- <h3 class="mt-2 mb-0">Note</h3>
                                <p class="disclaimer mb-0">You are only able invite member that has registered in Poling</p> --}}
                            </div>

                        </div>
                    </div>


                    <!-- Card Kanan -->
                    <div class="pl-2 col-lg-4 mt-0">
                        <div class="card card-details card-right">
                            @livewire('checkout-calculator', ['transactionId' => $item->id])

                            {{-- <hr> --}}
                            <p style="font-size: 14px;"></p>
                            Presented By
                            </p>

                            <div class="bank">
                                <div class="bank-item pb-3">
                                    <img src="{{ url('frontend/svg/images/midtrans-logo.svg') }}" alt=""
                                        class="bank-image">
                                    <div class="description"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                        </div>
                        <div class="join-container">
                            <a href="{{ route('checkout-success', $item->id) }}"
                                class="btn btn-block btn-join-now mt-3 py-2">Process Payment</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('cancel-booking', $item->id) }}" class="text-muted">Cancel Booking</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

@endsection

{{-- @section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            event.preventDefault();
            var snapToken = "{{ session('snapToken') }}";
            if (snapToken) {
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        // console.log(result);
                        window.location.href = "{{ route('checkout-success', $item->id) }}";
                    },
                    onPending: function(result) {
                        // console.log(result);
                    },
                    onError: function(result) {
                        // console.log(result);
                    }
                });
            } else {
                console.log('Snap token tidak tersedia.');
            }
        };
    </script>

@endsection --}}
