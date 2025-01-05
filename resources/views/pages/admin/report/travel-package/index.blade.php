@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Report Travel Packages</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('report-travel-package') }}">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <form action="{{ route('report-travel-package') }}" method="GET" class="my-5">
        @csrf

        <div class="row mb-3">
            <label for="startDate" class="col-sm-2 col-form-label">Start Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="startDate" class="form-control @error('start_date') is-invalid @enderror"
                    name="start_date" required value="{{ old('start_date', $start_date) }}">
                @error('start_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="endDate" class="col-sm-2 col-form-label">End Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="endDate" class="form-control @error('end_date') is-invalid @enderror"
                    name="end_date" required value="{{ old('end_date', $end_date) }}">
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
                <p class="mt-4">Periode: <strong>{{ \Carbon\Carbon::parse($start_date)->format('d F Y') }}</strong> sampai
                    <strong>{{ \Carbon\Carbon::parse($end_date)->format('d F Y') }}</strong> Last Report
                </p>
                <div class="card">
                    <div class="card-body">

                        <!-- Table with stripped rows -->
                        <table class="table datatable">

                            <thead>
                                <div class="mt-3 d-flex align-items-center gap-0">
                                    @if ($packages->isNotEmpty())
                                        @can('create report package')
                                            <form action="{{ route('report-travel-package-download') }}" method="GET"
                                                class="no-print">
                                                <input type="hidden" name="start_date" value="{{ $start_date }}">
                                                <input type="hidden" name="end_date" value="{{ $end_date }}">
                                                <button class="btn btn-danger" type="submit"
                                                    style="margin: 30px 0 30px 10px;"><i
                                                        class="bi bi-file-earmark-pdf-fill"></i> Download PDF</button>
                                            </form>
                                            <form action="{{ route('report-travel-package-excel') }}" method="GET"
                                                class="no-print">
                                                <input type="hidden" name="start_date" value="{{ $start_date }}">
                                                <input type="hidden" name="end_date" value="{{ $end_date }}">
                                                <button class="btn btn-success" type="submit"
                                                    style="margin: 30px 0 30px 10px;">
                                                    <i class="bi bi-file-earmark-excel-fill"></i> Download Excel
                                                </button>
                                            </form>
                                        @endcan
                                    @endif
                                </div>
                                <tr>
                                    <th>No</th>
                                    <th>Package Title</th>
                                    <th>Grand Total (Sum)</th>
                                    <th>Average</th>
                                    <th>Maximum</th>
                                    <th>Minimum</th>
                                    <th>Total Transactions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $index => $package)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $package->title }}</td>
                                        <td>{{ number_format($package->total_grand_total, 2) }}</td>
                                        <td>{{ number_format($package->avg_grand_total, 2) }}</td>
                                        <td>{{ number_format($package->max_grand_total, 2) }}</td>
                                        <td>{{ number_format($package->min_grand_total, 2) }}</td>
                                        <td>{{ $package->total_transaction }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm text-white" data-bs-toggle="collapse"
                                                data-bs-target="#details-{{ $package->id }}">
                                                View Details
                                            </button>
                                        </td>

                                    </tr>

                                    <tr class="collapse" id="details-{{ $package->id }}">
                                        <td colspan="9">
                                            <h5>Transaction Details</h5>
                                            @php
                                                $successfulTransactions = $package->transactions->filter(function (
                                                    $transaction,
                                                ) {
                                                    return $transaction->transaction_status === 'SUCCESS';
                                                });
                                            @endphp

                                            @if ($successfulTransactions->isNotEmpty())
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Customer Name</th>
                                                            <th>Status</th>
                                                            <th>Price Package</th>
                                                            <th>Grand Total</th>
                                                            <th>Profit/Loss</th>
                                                            <th>Payment Method</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($successfulTransactions as $transactionIndex => $transaction)
                                                            <tr>
                                                                <td>{{ $transactionIndex + 1 }}</td>
                                                                <td>{{ $transaction->user->name ?? 'Unknown' }}</td>
                                                                <td>{{ $transaction->transaction_status }}</td>
                                                                <td>{{ number_format($transaction->travel_package->price, 0, ' ') }}
                                                                </td>
                                                                <td>{{ number_format($transaction->grand_total, 2) }}
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $costPrice = $package->price; // Example base cost per package
                                                                        $profitOrLoss =
                                                                            $transaction->grand_total - $costPrice;
                                                                    @endphp
                                                                    {{ $profitOrLoss >= 0 ? '+' : '-' }}{{ number_format(abs($profitOrLoss), 2) }}
                                                                </td>
                                                                <td>{{ $transaction->payment_method }}</td>
                                                                <td>
                                                                <td>


                                                                    <a href="{{ route('report.transaction.details.pdf', ['transaction_id' => $transaction->id]) }}"
                                                                        class="btn btn-danger" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="Download PDF"
                                                                        style="margin-bottom: 10px;">
                                                                        <i class="ri-file-pdf-2-line"></i>
                                                                    </a>

                                                                    {{-- <a href="{{ route('report.package.details.customer.excel', ['package_id' => $package->id, 'user_id' => $transaction->user->id]) }}"
                                                                        class="btn btn-success" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="Download Excel"
                                                                        style="margin-bottom: 10px;">
                                                                        <i class="bi bi-file-earmark-excel-fill"></i>
                                                                    </a> --}}

                                                                    <a href="{{ route('report-package-details-excel', $transaction->id) }}"
                                                                        class="btn btn-success" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top" title="Download Excel"
                                                                        style="margin-bottom: 10px;">
                                                                        <i class="bi bi-file-earmark-excel-fill"></i>
                                                                    </a>
                                                                </td>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-warning">No successful transactions available
                            for this package.</div>
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
