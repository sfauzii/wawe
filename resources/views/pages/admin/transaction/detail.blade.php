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
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">

                        <table class="table table-bordered">
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
                                <td>IDR{{ $item->transaction_total }}</td>
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
    </section>
@endsection
