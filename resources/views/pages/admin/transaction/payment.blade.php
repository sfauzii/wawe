@extends('layouts.admin')

@section('title', 'Payment Transactions')


@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h3>Transaction Details</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Payment for Transaction #{{ $transaction->id }}</h5>
                <p class="card-text">
                    Below are the details of your transaction. Please review them before proceeding with the payment.
                </p>

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Transaction ID</th>
                            <td>{{ $transaction->id }}</td>
                        </tr>
                        
                        <tr>
                            <th scope="row">Username</th>
                            <td>{{ $transaction->user->username ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Travel Package</th>
                            <td>{{ $transaction->travel_package->title }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Price</th>
                            <td>Rp {{ number_format($transaction->travel_package->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Payment Method</th>
                            <td>{{ ucwords(str_replace('_', ' ', $transaction->payment_method)) }}</td>
                        </tr>

                        {{-- <tr>
                        <th scope="row">Number of Users</th>
                        <td>{{ $transaction->users ? $transaction->users->count() : 'N/A' }}</td>
                    </tr> --}}
                        <tr>
                            <th scope="row">Total Amount</th>
                            <td>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Transaction Status</th>
                            <td>{{ ucfirst($transaction->transaction_status) }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center">
                    <button id="pay-button" class="btn btn-primary"
                        onclick="window.location.href='{{ route('transaction-success', $transaction->id) }}';">
                        Pay Now
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
