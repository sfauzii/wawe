@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Report Transactions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('report-transaction') }}">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <form action="{{ route('report-transaction') }}" method="GET" class="my-5">
        @csrf

        <div class="row mb-3">
            <label for="startDate" class="col-sm-2 col-form-label">Start Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="startDate" class="form-control @error('start_date') is-invalid @enderror"
                    name="start_date" required value="{{ old('start_date', $startDate) }}">
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="endDate" class="col-sm-2 col-form-label">End Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="endDate" class="form-control @error('end_date') is-invalid @enderror"
                    name="end_date" required value="{{ old('end_date', $endDate) }}">
                @error('end_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Tampilkan error umum jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-primary btn-block w-100" style="background-color: #012970">
            Tampilkan Laporan
        </button>
    </form>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <p class="mt-4">Periode: <strong>{{ \Carbon\Carbon::parse($startDate)->format('d F Y') }}</strong> sampai
                    <strong>{{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</strong> Last Report
                </p>
                <div class="card">
                    <div class="card-body">

                        <!-- Table with stripped rows -->
                        <table class="table datatable">

                            <thead>
                                <div class="mt-3 d-flex align-items-center gap-0">
                                    @if ($transactions->isNotEmpty())
                                        @can('create report transaction')
                                            <form action="{{ route('report-transaction-download') }}" method="GET"
                                                class="no-print">
                                                <input type="hidden" name="start_date" value="{{ $startDate }}">
                                                <input type="hidden" name="end_date" value="{{ $endDate }}">
                                                <button class="btn btn-danger" type="submit"
                                                    style="margin: 30px 0 30px 10px;"><i
                                                        class="bi bi-file-earmark-pdf-fill"></i> Download PDF</button>
                                            </form>
                                            <form action="{{ route('report-transaction-excel') }}" method="GET"
                                                class="no-print">
                                                <input type="hidden" name="start_date" value="{{ $startDate }}">
                                                <input type="hidden" name="end_date" value="{{ $endDate }}">
                                                <button class="btn btn-success" type="submit"
                                                    style="margin: 30px 0 30px 10px;"><i
                                                        class="bi bi-file-earmark-excel-fill"></i> Download Excel</button>
                                            </form>
                                        @endcan
                                    @endif
                                </div>
                                <tr>
                                    <th>No</th>
                                    <th>Date and Time</th>
                                    <th>Transaksi</th>
                                    <th>Pengguna</th>
                                    <th>Paket</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->created_at->format('d F Y, H:i') }} WIB</td>
                                        <td>{{ number_format($transaction->grand_total) }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ ucwords($transaction->travel_package->title) }}</td>
                                        <td>
                                            @if ($transaction->transaction_status === 'SUCCESS')
                                                <span
                                                    class="badge rounded-pill text-bg-success">{{ $transaction->transaction_status }}</span>
                                            @elseif($transaction->transaction_status === 'IN_CART')
                                                <span
                                                    class="badge rounded-pill text-bg-primary">{{ $transaction->transaction_status }}</span>
                                            @elseif($transaction->transaction_status === 'PENDING')
                                                <span
                                                    class="badge rounded-pill text-bg-warning">{{ $transaction->transaction_status }}</span>
                                            @elseif($transaction->transaction_status === 'CANCEL')
                                                <span
                                                    class="badge rounded-pill text-bg-secondary">{{ $transaction->transaction_status }}</span>
                                            @elseif($transaction->transaction_status === 'FAILED')
                                                <span
                                                    class="badge rounded-pill text-bg-danger">{{ $transaction->transaction_status }}</span>
                                            @else
                                                <span
                                                    class="badge rounded-pill text-bg-dark">{{ $transaction->transaction_status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
