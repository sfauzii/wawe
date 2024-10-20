<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Your Transactions | {{ ucfirst(Auth::user()->name) }}</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Assistant:wght@200..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
            rel="stylesheet" />

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="{{ url('frontend/styles/invoice.css') }}" />

    </head>

    <body>
        <div class="title-section">
            <h1>Invoice</h1>
            <p>Unduh bukti pembayaran kelas Premium <br>sebagai dokumentasi
                pribadi</p>
        </div>

        <div class="background-container">
            <div class="invoice-card">
                <div class="invoice-header">
                    <div class="left">
                        <img src="{{ url('frontend/svg/images/logo.svg') }}" alt="Company Logo" />
                        @php
                            // Pisahkan UUID menjadi bagian-bagian dengan delimiter '-'
                            $uuidParts = explode('-', $transaction->id);
                            // Bagian pertama dari UUID
                            $shortUuid = $uuidParts[0];
                            // Bagian kedua dan seterusnya dari UUID
                            $remainingUuid = implode('-', array_slice($uuidParts, 1));
                        @endphp
                        <h3>#{{ $transaction->order_id }}</h3>
                        <p>Product Name: <strong>{{ ucwords($transaction->travel_package->title) }}</strong></p>
                    </div>
                    <div class="right">
                        <p>Issued: {{ $transaction->created_at }}</p>
                        <p>Status: <strong>{{ $transaction->transaction_status }}</strong></p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="billing-info">
                    <div class="bill-from">
                        <p class="b-color">Bill From:</p>
                        <h3>WaWe Tour and Travel</h3>
                        <p>Address Line 1</p>
                        <p>City, State, ZIP</p>
                        <p>Country</p>
                    </div>
                    <div class="bill-to">
                        <p class="b-color">Bill To:</p>
                        <h3>{{ ucfirst($transaction->user->name) }}</h3>
                        <p>Address Line 1</p>
                        <p>City, State, ZIP</p>
                        <p>Country</p>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Package</th>
                            <th>Payment Method</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ ucwords($transaction->travel_package->title) }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $transaction->payment_method)) }}</td>
                            <td>IDR {{ number_format($transaction->travel_package->price, 0, ',') }}</td>
                            <td>{{ $transactionDetails->count() }}</td>
                            <td>IDR
                                {{ number_format($transaction->grand_total, 0, ',') }}
                            </td>
                        </tr>

                    </tbody>

                    @if ($remainingFullPayment)
                        <tr>
                            <th width="50%">Remaining Full Payment</th>
                            <td width="50%" class="text-right text-green" style="font-weight: bold">
                                Rp {{ number_format($remainingFullPayment, 0, ',',) }}
                            </td>
                        </tr>
                    @endif
                </table>

                <div class="divider"></div>
                <div class="thank-you">
                    <p>Terima kasih telah mempercayai kami. <br />
                        WaWe Tour and Travel.</p>
                </div>
                <div class="button-container">
                    <button onclick="window.location.href='{{ route('invoice.download', $transaction->id) }}';">Print
                        Now</button>
                </div>
            </div>
        </div>
    </body>

</html>
