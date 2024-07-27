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

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        {{-- <p>Add lightweight datatables to your project with using the <a
                                href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple
                                DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to
                            conver to a datatable. Check for <a
                                href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more
                                examples</a>.</p> --}}

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Travel</th>
                                    <th>User</th>
                                    {{-- <th>Visa</th> --}}
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->travel_package->title }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    {{-- <td>IDR{{ $item->additional_visa }}</td> --}}
                                    <td>IDR {{ number_format($item->transaction_total) }}</td>
                                    <td>
                                        @if ($item->transaction_status === 'SUCCESS')
                                            <span class="badge rounded-pill text-bg-success">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'IN_CART')
                                            <span class="badge rounded-pill text-bg-primary">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'PENDING')
                                            <span class="badge rounded-pill text-bg-warning">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'CANCEL')
                                            <span class="badge rounded-pill text-bg-secondary">{{ $item->transaction_status }}</span>
                                        @elseif($item->transaction_status === 'FAILED')
                                            <span class="badge rounded-pill text-bg-danger">{{ $item->transaction_status }}</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-dark">{{ $item->transaction_status }}</span>
                                        @endif
                                    </td>
                                        <td>
                                            <a href="{{ route('transaction_print', ['id' => $item->id]) }}" class="btn btn-secondary">
                                                <i class="fa fa-eye">Print</i>
                                            </a>
                                            <a href="{{ route('transaction.show', $item->id) }}" class="btn btn-success">
                                                <i class="fa fa-eye">Show</i>
                                            </a>
                                            <a href="{{ route('transaction.edit', $item->id) }}" class="btn btn-info">
                                                <i class="fa fa-pencil-alt">Edit</i>
                                            </a>
                                            <form action="{{ route('transaction.destroy', $item->id) }}" method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">
                                                    <i class="fa fas-trash">Delete</i>

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
                </div>

            </div>
        </div>
    </section>
@endsection
