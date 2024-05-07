@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Report Transaction</h1>
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
            <label for="startDate" class="col-sm-2 col-form-label">Star Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="startDate" class="form-control" name="start_date" value="{{ $startDate }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="endDate" class="col-sm-2 col-form-label">End Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="endDate" class="form-control" name="end_date" value="{{ $endDate }}">
            </div>
        </div>



        <button type="submit" class="btn btn-primary btn-block w-100">
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
                                <div class="mt-3">
                                    @if ($transactions->isNotEmpty())
                                        <form action="{{ route('report-transaction-download') }}" method="GET"
                                            class="no-print">
                                            <input type="hidden" name="start_date" value="{{ $startDate }}">
                                            <input type="hidden" name="end_date" value="{{ $endDate }}">
                                            <button class="btn btn-danger" type="submit"><i
                                                    class="bi bi-file-earmark-pdf-fill"></i> Download PDF</button>
                                        </form>
                                    @endif
                                </div>
                                <tr>
                                    <th>No</th>
                                    <th>Date and Time</th>
                                    <th>Transaksi</th>
                                    {{-- <th>Jumlah</th> --}}
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
                                        <td>{{ $transaction->transaction_total }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->travel_package->title }}</td>
                                        <td>{{ $transaction->transaction_status }}</td>
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
