@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{ route('dashboard', ['role' => Auth::user()->getRoleNames()->first()]) }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter=today') }}">Today</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter=this_month') }}">This Month</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('/dashboard/{role}?filter=this_year') }}">This
                                            Year</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Sales <span>| {{ ucfirst(str_replace('_', ' ', $filter)) }}</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $transactionCount }}</h6>
                                        <span class="text-success small pt-1 fw-bold">
                                            {{ $transactionCount }} orders
                                        </span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter_revenue=today') }}">Today</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter_revenue=this_month') }}">This
                                            Month</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter_revenue=this_year') }}">This
                                            Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>|
                                        {{ ucfirst(str_replace('_', ' ', $filter_revenue)) }}</span></h5>
                                </span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>Rp {{ number_format($salesData['totalSales'], 0, ',', '.') }}</h6>
                                        <span
                                            class="{{ $salesData['increaseDecrease'] >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
                                            {{ $salesData['increaseDecrease'] >= 0 ? '+' : '-' }} Rp
                                            {{ number_format(abs($salesData['increaseDecrease']), 0, ',', '.') }}
                                            ({{ number_format(abs($salesData['percentageChange']), 2) }}%)
                                        </span>
                                        <span class="text-muted small pt-2 ps-1">
                                            {{ $salesData['increaseDecrease'] >= 0 ? 'increase' : 'decrease' }} over the
                                            past 30 days
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <!-- Filter section for Customers Card -->
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter_customers=today') }}">Today</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter_customers=this_month') }}">This
                                            Month</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter_customers=this_year') }}">This
                                            Year</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Card body for Customers Card -->
                            <div class="card-body">
                                <!-- Title and filter information for Customers Card -->
                                <h5 class="card-title">Customers <span>|
                                        {{ ucfirst(str_replace('_', ' ', $filter_customers)) }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $customerData['currentCustomerCount'] }}</h6>
                                        <span
                                            class="{{ $customerData['increaseDecrease'] >= 0 ? 'text-success' : 'text-danger' }} small pt-1 fw-bold">
                                            {{ $customerData['increaseDecrease'] >= 0 ? '+' : '-' }}
                                            {{ number_format(abs($customerData['increaseDecrease'])) }}
                                            ({{ number_format(abs($customerData['percentageChange']), 2) }}%)
                                        </span>
                                        <span class="text-muted small pt-2 ps-1">
                                            {{ $customerData['increaseDecrease'] >= 0 ? 'increase' : 'decrease' }} over the
                                            past month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter=today') }}">Today</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter=this_month') }}">This
                                            Month</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ url('/dashboard/{role}?filter=this_year') }}">This Year</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/{{ ucfirst(str_replace('_', ' ', $filter)) }}</span>
                                </h5>

                                <!-- Line Chart -->

                                <div style="width: 800px; margin: auto;">
                                    <canvas id="chart"></canvas>

                                </div>


                                <script>
                                    function applyFilter() {
                                        var filter = document.getElementById('filter').value;
                                        window.location.href = '/dashboard/{role}?filter=' + filter;
                                    }

                                    document.addEventListener('DOMContentLoaded', function() {
                                        var ctx = document.getElementById('chart').getContext('2d');
                                        var chartUsers = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: {!! json_encode($labels) !!},
                                                datasets: {!! json_encode($datasets) !!}
                                            },
                                        });
                                    });
                                </script>


                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Recent Sales</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_sales as $sale)
                                            <tr>
                                                @php
                                                    $uuidParts = explode('-', $sale->order_id);
                                                    $shortUuid = $uuidParts[0];
                                                @endphp
                                                <th scope="row" style="font-weight: bold;"><a
                                                        href="#">{{ $shortUuid }}</a></th>
                                                <td>{{ ucwords($sale->user->name) }}</td>
                                                <td><a href="#"
                                                        class="text-primary">{{ ucwords($sale->travel_package->title) }}</a>
                                                </td>
                                                <td>IDR {{ number_format($sale->grand_total, 0, ',') }}</td>
                                                <td>
                                                    @if ($sale->transaction_status === 'SUCCESS')
                                                        <span
                                                            class="badge bg-success">{{ $sale->transaction_status }}</span>
                                                    @elseif($sale->transaction_status === 'IN_CART')
                                                        <span
                                                            class="badge bg-primary">{{ $sale->transaction_status }}</span>
                                                    @elseif($sale->transaction_status === 'PENDING')
                                                        <span
                                                            class="badge bg-warning">{{ $sale->transaction_status }}</span>
                                                    @elseif($sale->transaction_status === 'CANCEL')
                                                        <span
                                                            class="badge bg-secondary">{{ $sale->transaction_status }}</span>
                                                    @elseif($sale->transaction_status === 'FAILED')
                                                        <span
                                                            class="badge bg-danger">{{ $sale->transaction_status }}</span>
                                                    @else
                                                        <span class="badge bg-dark">{{ $sale->transaction_status }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                        <div class="activity">
                            @foreach ($notif as $notification)
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{ $notification->created_at->diffForHumans() }}</div>
                                    <i
                                        class='bi bi-circle-fill activity-badge {{ $notification->read_at ? 'text-muted' : 'text-primary' }} align-self-start'></i>
                                    <div class="activity-content">
                                        @if (isset($notification->data['name']))
                                            <!-- Menampilkan detail testimoni -->
                                            <strong>{{ $notification->data['name'] }}</strong> memberikan testimoni: <br>
                                            "{{ $notification->data['message'] }}" <br>
                                            Pada: {{ $notification->data['created_at'] }}
                                        @elseif (isset($notification->data['transaction_id']))
                                            <!-- Menampilkan detail transaksi -->
                                            <strong>{{ $notification->data['user_name'] }}</strong> made a transaction:
                                            <br>
                                            Amount: <strong>Rp
                                                {{ number_format($notification->data['amount'], 0, ',') }}</strong> <br>
                                            Status:
                                            @if ($notification->data['status'] === 'SUCCESS')
                                                <span class="badge bg-success">{{ $notification->data['status'] }}</span>
                                            @elseif($notification->data['status'] === 'IN_CART')
                                                <span class="badge bg-primary">{{ $notification->data['status'] }}</span>
                                            @elseif($notification->data['status'] === 'PENDING')
                                                <span class="badge bg-warning">{{ $notification->data['status'] }}</span>
                                            @elseif($notification->data['status'] === 'CANCEL')
                                                <span
                                                    class="badge bg-secondary">{{ $notification->data['status'] }}</span>
                                            @elseif($notification->data['status'] === 'FAILED')
                                                <span class="badge bg-danger">{{ $notification->data['status'] }}</span>
                                            @else
                                                <span class="badge bg-dark">{{ $notification->data['status'] }}</span>
                                            @endif <br>
                                            {{ $notification->data['message'] }}
                                        @else
                                            <!-- Tampilkan data notifikasi lainnya jika ada -->
                                            {!! $notification->data['message'] !!}
                                        @endif
                                    </div>
                                </div><!-- End activity item-->
                            @endforeach
                        </div>

                    </div>
                </div><!-- End Recent Activity -->

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
