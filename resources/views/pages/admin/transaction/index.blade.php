@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Data Transaction</h1>
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
                                            <a href="{{ $item->payment_url }}" class="btn btn-primary"><i
                                                    class="ri-bank-card-line"></i></a>
                                        @endif

                                        <a href="{{ route('transaction_print', ['id' => encrypt($item->id)]) }}"
                                            class="btn btn-secondary">
                                            <i class="ri-file-pdf-2-line"></i>
                                        </a>
                                        <a href="{{ route('transaction.show', encrypt($item->id)) }}"
                                            class="btn btn-success">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a href="{{ route('transaction.edit', encrypt($item->id)) }}" class="btn btn-info">
                                            <i class="ri-edit-line" style="color: white;"></i>
                                        </a>
                                        <form action="{{ route('transaction.destroy', encrypt($item->id)) }}"
                                            method="POST" class="d-inline">

                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger">
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

                <div class="tab-pane fade {{ $selectedStatus === 'CANCEL' ? 'show active' : '' }}" id="transaction-cancel">
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
