@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Edit Transaction {{ $item->title }}</h1>
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
                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('transaction.update', $item->id) }}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row mb-3">
                                <label for="transaction_status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="transaction_status" class="form-select"
                                        aria-label="Default select example">
                                        <option value="{{ $item->transaction_status }}">Jangan Diubah
                                            {{ $item->transaction_status }} </option>
                                        <option value="IN_CART">In Cart</option>
                                        <option value="PENDING">Pending</option>
                                        <option value="SUCCESS">Success</option>
                                        <option value="CANCEL">Cancel</option>
                                        <option value="FAILED">Failed</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                Edit
                            </button>
                        </form><!-- End General Form Elements -->

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
                                        <span >Created At: <span style="color: #012970; font-weight: bold   ">{{ $item->created_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T')  }}</span></span>
                                        <!-- Tanggal yang sesuai akan ditampilkan di sini -->
                                    </div>
                                </div>
                            </div>

                            <!-- Updated At -->
                            <div class="row mb-5">
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check mr-2"></i> <!-- Icon untuk tanggal -->
                                        <span >Updated At: <span style="color: #012970; font-weight: bold   ">{{ $item->updated_at->setTimezone('Asia/Jakarta')->format('j F Y, H:i T')  }}</span></span>
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
