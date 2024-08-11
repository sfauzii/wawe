@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h1>Detail Transaction {{ $item->user->name }}</h1>
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

                        <div style="overflow-x: auto;">
                            <table class="table table-bordered mt-4" style="width: 100%; min-width: 100%;">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $item->id }}</td>
                                </tr>

                                <tr>
                                    <th>Paket Travel</th>
                                    <td>{{ $item->travel_package->title }}</td>
                                </tr>
                                <tr>
                                    <th>Pembeli</th>
                                    <td>{{ $item->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Total Transaksi</th>
                                    <td>IDR {{ number_format($item->transaction_total, 0, ',') }}</td>
                                </tr>
                                <tr>
                                    <th>Status Transaksi</th>
                                    <td>{{ $item->transaction_status }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $item->updated_at }}</td>
                                </tr>
                                <tr>
                                    <th>Midtrans Data</th>
                                    <td>
                                        @if ($midtransData->isNotEmpty())
                                            @foreach ($midtransData as $index => $data)
                                                {{-- <h4>Notification {{ $index + 1 }}</h4> --}}
                                                
                                                <!-- Display full JSON data -->
                                                <details>
                                                    <summary>Show Full Midtrans Data</summary>
                                                    <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>
                                                </details>
                                
                                                <!-- Display specific fields -->
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <td>{{ $data['transaction_id'] ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fraud Status</th>
                                                    <td>{{ strtoupper($data['fraud_status'] ?? 'N/A') }}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th>Payment Type</th>
                                                    <td>{{ ucwords(str_replace('_', ' ', $data['payment_type'] ?? 'N/A')) }}</td>
                                                </tr>
                                
                                                @if (isset($data['va_numbers']) && is_array($data['va_numbers']))
                                                    <tr>
                                                        <th>VA Number</th>
                                                        <td>{{ $data['va_numbers'][0]['va_number'] ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Bank</th>
                                                        <td>{{ strtoupper($data['va_numbers'][0]['bank'] ?? 'N/A') }}</td>
                                                    </tr>
                                                @endif
                                               

                                                <tr>
                                                    <th>Expire Time</th>
                                                    <td>{{ $data['expiry_time'] ?? 'N/A' }}</td>
                                                </tr>
                                
                                                <!-- Add more specific fields here as needed -->
                                
                                            @endforeach
                                        @else
                                                <p>No Midtrans data available for this transaction.</p>
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Payment URL</th>
                                    <td>
                                        @if ($item->payment_url)
                                            <a href="{{ $item->payment_url }}" target="_blank" rel="noopener noreferrer">
                                                View Payment URL <br>
                                            </a>
                                            <span>{{ $item->payment_url }}</span>
                                        @else
                                            Not available
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pembelian</th>
                                    <td>
                                        <div style="overflow-x: auto;">
                                            <table class="table table-bordered" style="width: 100%; min-width: 100%;">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    @foreach ($item->details as $detail)
                                                <tr>
                                                    <td>{{ str_pad($detail->id, 10, '0', STR_PAD_LEFT) }}</td>
                                                    <td>{{ $detail->username }}</td>
                                                    {{-- <td>{{ $detail->nationality }}</td>
                                                        <td>{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                                        <td>{{ $detail->doe_passport }}</td> --}}
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>


                    </div>
                </div>

            </div>


            <div class="col-lg-4">
                <div class="card">
                    @if ($item->transaction_status === 'SUCCESS')
                        <div class="ticket-container">
                            <div class="ticket">
                                <div class="ticket-header">
                                    <div class="alert alert-info">This ticket available for download.</div>
                                    <img src="{{ asset('storage/' . $item->travel_package->galleries[0]->image) }}"
                                        alt="Event Image" class="ticket-image">
                                    <h1 class="ticket-title">{{ $item->travel_package->title }}</h1>
                                    <p class="ticket-id">Ticket ID: {{ $item->id }}</p>
                                </div>
                                <div class="ticket-body">
                                    <div class="ticket-info">
                                        <div class="info-item">
                                            <strong>Event:</strong> {{ $item->travel_package->title }}
                                        </div>
                                        <div class="info-item">
                                            <strong>Date:</strong>
                                            {{ \Carbon\Carbon::parse($item->travel_package->departure_date)->format('d F Y') }}
                                        </div>
                                        <div class="info-item">
                                            <strong>Group:</strong> {{ $transactionDetails->count() }} person
                                        </div>
                                        <div class="info-item">
                                            <strong>Location:</strong> {{ $item->travel_package->location }}
                                        </div>
                                        <div class="info-item">
                                            <strong>Attendee:</strong> {{ $item->user->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-footer">
                                    <p class="thank-you">Thank you for your purchase!</p>
                                    <button class="btn btn-primary"
                                        onclick="window.location.href = '{{ route('download-ticket', $item->id) }}';">Download
                                        Ticket</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="tikcet-container">
                            <div class="ticket">
                                <div class="alert alert-danger">This ticket is not available for download.</div>
                            </div>

                        </div>
                    @endif
                </div>
            </div>


        </div>
    </section>
@endsection


@section('style')
    <style>
        .ticket-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .ticket {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 1.5rem;
            box-sizing: border-box;
            overflow: hidden;
            /* Ensure no overflow from the image */
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .ticket-image {
            width: 100%;
            height: auto;
            border-radius: 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 1rem;
        }

        .ticket-title {
            font-size: 1.5rem;
            margin: 0;
        }

        .ticket-id {
            font-size: 0.875rem;
            color: #555;
        }

        .ticket-body {
            margin-bottom: 1.5rem;
        }

        .ticket-info {
            font-size: 1rem;
            color: #333;
        }

        .info-item {
            margin-bottom: 0.5rem;
        }

        .info-item strong {
            color: #007bff;
        }

        .ticket-footer {
            text-align: center;
        }

        .thank-you {
            font-size: 1rem;
            color: #007bff;
            margin-bottom: 1rem;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .ticket {
                padding: 1rem;
            }

            .ticket-title {
                font-size: 1.25rem;
            }

            .btn {
                font-size: 0.875rem;
            }
        }
    </style>
@endsection
