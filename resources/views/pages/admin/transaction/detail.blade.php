@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Detail Transaction {{ $item->user->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Home</a></li>
                <li class="breadcrumb-item">Transaction</li>
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

                        <div style="overflow-x: auto;">
                            <table class="table table-bordered mt-4" style="width:100%; min-width: 100%;">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $item->id }}</td>
                                </tr>
                                <tr>
                                    <th>Paket Travel</th>
                                    <td>{{ $item->travel_package->title }}</td>
                                </tr>
                                <tr>
                                    <th>Pembeli</th>
                                    <td>{{ $item->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Additional Visa</th>
                                    <td>IDR{{ $item->additional_visa }}</td>
                                </tr>
                                <tr>
                                    <th>Total Transaksi</th>
                                    <td>IDR {{ number_format($item->transaction_total) }}</td>
                                </tr>
                                <tr>
                                    <th>Status Transaksi</th>
                                    <td>{{ $item->transaction_status }}</td>
                                </tr>
                                <tr>
                                    <th>Pembelian</th>
                                    <td>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Nationality</th>
                                                <th>Visa</th>
                                                <th>DOE Passport</th>
                                            </tr>
                                            @foreach ($item->details as $detail)
                                                <tr>
                                                    <td>{{ $detail->id }}</td>
                                                    <td>{{ $detail->username }}</td>
                                                    <td>{{ $detail->nationality }}</td>
                                                    <td>{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                                    <td>{{ $detail->doe_passport }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>


                    </div>
                </div>

            </div>


            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Last Information</h5>

                        <!-- Advanced Form Elements -->
                        <form>
                            <!-- Created At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span style="font-weight: bold"><i class="ri-calendar-schedule-line"></i> Created At: <span
                                                style="color: #000000; font-weight: 400   ">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
                                        <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                    </div>
                                </div>
                            </div>

                            <!-- Updated At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span style="font-weight: bold"><i class="ri-calendar-schedule-line"></i> Updated At: <span
                                                style="color: #000000; font-weight: 400   ">{{ $item->updated_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T') }}</span></span>
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
