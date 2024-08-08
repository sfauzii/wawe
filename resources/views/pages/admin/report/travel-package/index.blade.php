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
            <label for="startDate" class="col-sm-2 col-form-label">Star Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="startDate" class="form-control" name="start_date" required value="{{ $start_date }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="endDate" class="col-sm-2 col-form-label">End Date <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <input type="date" id="endDate" class="form-control" name="end_date" required value="{{ $end_date }}">
            </div>
        </div>



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
                                <div class="mt-3">
                                    @if ($packages->isNotEmpty())
                                        <form action="{{ route('report-travel-package-download') }}" method="GET"
                                            class="no-print">
                                            <input type="hidden" name="start_date" value="{{ $start_date }}">
                                            <input type="hidden" name="end_date" value="{{ $end_date }}">
                                            <button class="btn btn-danger" type="submit"><i
                                                    class="bi bi-file-earmark-pdf-fill"></i> Download PDF</button>
                                        </form>
                                    @endif
                                </div>
                                <tr>
                                    <th>No</th>
                                    <th>Date and Time</th>
                                    <th>Pakcage</th>
                                    <th>Location</th>
                                    <th>Departure Date</th>
                                    <th>Thumbnail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $package->created_at->format('d F Y, H:i') }} WIB</td>
                                        <td>{{ $package->title }}</td>
                                        <td>{{ $package->location }}</td>
                                        <td>{{ \Carbon\Carbon::parse($package->departure_date)->format('d F Y') }}</td>
                                        <td><img src="{{ $package->galleries->count() ? Storage::url($package->galleries->first()->image) : '' }}"
                                                alt="Package Image" style="width: 100px; height: auto;"></td>
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
