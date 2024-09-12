@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Transactions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('transaction.index') }}">Home</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="card info-card sales-card h-100">
                <div class="card-body d-flex">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                        <!-- Icon can be added here -->
                    </div>
                    <div>
                        <h5 class="card-title">Transactions</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h1 style="font-weight: bold; color: #012970">{{ $countPending }}</h1>
                                <span class="text-success large  fw-bold"
                                    style="font-size: 14px; font-weight: 500;">Pending</span>
                                <span class="text-muted large pt-2"
                                    style="font-size: 14px; font-weight: 500;">Transactions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="card info-card sales-card h-100">
                <div class="card-body d-flex">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                        <!-- Icon can be added here -->
                    </div>
                    <div>
                        <h5 class="card-title">Transactions</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h1 style="font-weight: bold; color: #012970">{{ $countSuccess }}</h1>
                                <span class="text-success large  fw-bold"
                                    style="font-size: 14px; font-weight: 500;">Success</span>
                                <span class="text-muted large pt-2"
                                    style="font-size: 14px; font-weight: 500;">Transactions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="card info-card sales-card h-100">
                <div class="card-body d-flex">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                        <!-- Icon can be added here -->
                    </div>
                    <div>
                        <h5 class="card-title">Transactions</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h1 style="font-weight: bold; color: #012970">{{ $countFailed }}</h1>
                                <span class="text-success large  fw-bold"
                                    style="font-size: 14px; font-weight: 500;">Expired</span>
                                <span class="text-muted large pt-2"
                                    style="font-size: 14px; font-weight: 500;">Transactions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="card info-card sales-card h-100">
                <div class="card-body d-flex">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                        <!-- Icon can be added here -->
                    </div>
                    <div>
                        <h5 class="card-title">Transactions</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h1 style="font-weight: bold; color: #012970">{{ $countInCart }}</h1>
                                <span class="text-success large  fw-bold" style="font-size: 14px; font-weight: 500;">In
                                    Cart</span>
                                <span class="text-muted large pt-2"
                                    style="font-size: 14px; font-weight: 500;">Transactions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-4 col-md-6 mb-4">
            <div class="card info-card sales-card h-100">
                <div class="card-body d-flex">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center me-3">
                        <!-- Icon can be added here -->
                    </div>
                    <div>
                        <h5 class="card-title">Transactions</h5>
                        <div class="d-flex align-items-center">
                            <div class="ps-3">
                                <h1 style="font-weight: bold; color: #012970">{{ $countCancelled }}</h1>
                                <span class="text-success large  fw-bold"
                                    style="font-size: 14px; font-weight: 500;">Canceled</span>
                                <span class="text-muted large pt-2"
                                    style="font-size: 14px; font-weight: 500;">Transactions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                    <a class="nav-link {{ $selectedStatus === 'ALL' ? 'active' : '' }}"
                        href="{{ route('transaction.index', ['status' => 'ALL']) }}">All</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $selectedStatus === 'IN_CART' ? 'active' : '' }}"
                        href="{{ route('transaction.index', ['status' => 'IN_CART']) }}">IN CART</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $selectedStatus === 'PENDING' ? 'active' : '' }}"
                        href="{{ route('transaction.index', ['status' => 'PENDING']) }}">PENDING</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $selectedStatus === 'SUCCESS' ? 'active' : '' }}"
                        href="{{ route('transaction.index', ['status' => 'SUCCESS']) }}">SUCCESS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $selectedStatus === 'CANCEL' ? 'active' : '' }}"
                        href="{{ route('transaction.index', ['status' => 'CANCEL']) }}">CANCEL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $selectedStatus === 'EXPIRED' ? 'active' : '' }}"
                        href="{{ route('transaction.index', ['status' => 'EXPIRED']) }}">EXPIRED</a>
                </li>

            </ul>
            <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                    <h5 class="card-title"></h5>
                    <h5 class="card-title"></h5>

                    <a href="{{ route('transaction.create') }}" class="btn btn-primary btn-right"
                        style="float: right; margin-top: -40px; margin-right: 10px">Create Transaction</a>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Travel</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    {{-- <td>{{ $item->id }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->travel_package->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y H:i') }}</td>
                                    <td>IDR {{ number_format($item->transaction_total, 0, ',') }}</td>
                                    <td>
                                        @if ($item->transaction_status === 'SUCCESS')
                                            <span
                                                class="badge rounded-pill text-bg-success">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'IN_CART')
                                            <span
                                                class="badge rounded-pill text-bg-primary">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'PENDING')
                                            <span
                                                class="badge rounded-pill text-bg-warning">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'CANCEL')
                                            <span
                                                class="badge rounded-pill text-bg-secondary">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'FAILED')
                                            <span
                                                class="badge rounded-pill text-bg-danger">{{ $item->transaction_status }}</span>
                                        @else
                                            <span
                                                class="badge rounded-pill text-bg-dark">{{ $item->transaction_status }}</span>
                                        @endif
                                    </td>
                                    <td>

                                        @if ($item->transaction_status === 'PENDING')
                                            @if (!empty($item->payment_url))
                                                <a href="{{ $item->payment_url }}" class="btn btn-primary">
                                                    <i class="ri-bank-card-line"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('transaction.payment', ['transaction' => $item->id]) }}"
                                                    class="btn btn-primary">
                                                    <i class="ri-bank-card-line"></i>
                                                </a>
                                            @endif
                                        @endif

                                        <a href="{{ route('transaction_print', ['id' => $item->id]) }}"
                                            class="btn btn-secondary">
                                            <i class="ri-file-pdf-2-line"></i>
                                        </a>
                                        <a href="{{ route('transaction.show', $item->id) }}" class="btn btn-success">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a href="{{ route('transaction.edit', $item->id) }}" class="btn btn-info">
                                            <i class="ri-edit-line" style="color: white;"></i>
                                        </a>
                                        <form action="{{ route('transaction.destroy', $item->id) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $item->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger"
                                                onclick="confirmDeletion('{{ $item->id }}', 'delete-form-{{ $item->id }}')">
                                                <i class="ri-delete-bin-6-line"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Data kosong
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->


                </div>

                <div class="tab-pane fade {{ $selectedStatus === 'IN_CART' ? 'show active' : '' }}"
                    id="transaction-in-cart">
                    <!-- Filtered content for IN_CART -->
                </div>

                <div class="tab-pane fade {{ $selectedStatus === 'PENDING' ? 'show active' : '' }}"
                    id="transaction-pending">
                    <!-- Filtered content for PENDING -->
                </div>

                <div class="tab-pane fade {{ $selectedStatus === 'SUCCESS' ? 'show active' : '' }}"
                    id="transaction-success">
                    <!-- Filtered content for SUCCESS -->
                </div>

                <div class="tab-pane fade {{ $selectedStatus === 'CANCEL' ? 'show active' : '' }}"
                    id="transaction-cancel">
                    <!-- Filtered content for CANCEL -->
                </div>

                <div class="tab-pane fade {{ $selectedStatus === 'FAILED' ? 'show active' : '' }}"
                    id="transaction-expired">
                    <!-- Filtered content for EXPIRED / FAILED -->
                </div>

            </div><!-- End Bordered Tabs -->

        </div>
    </div>
@endsection
