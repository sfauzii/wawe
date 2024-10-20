<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice Card</title>

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
            }

            .invoice-card {
                background-color: #fff;
                border-radius: 15px;
                padding: 10px;
                /* Reduce padding */
                width: 100%;
                max-width: 750px;
                /* Slightly smaller max-width for better A4 fit */
                margin: auto;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .invoice-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 10px;
                /* Reduce margin */
            }

            .invoice-header .left {
                width: 48%;
            }

            .b-color {
                color: coral;
            }

            .invoice-header .left img {
                width: 80px;
                /* Adjust logo size */
            }

            .invoice-header .left p,
            .invoice-header .right p {
                margin: 1px 0;
                /* Reduce margin */
                font-size: 13px;
                /* Adjust font size */
            }

            .invoice-header .right {
                width: 48%;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }

            .divider {
                border-bottom: 1px solid #e0e0e0;
                margin: 10px 0;
                /* Reduce margin */
            }

            .billing-info {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                /* Reduce margin */
            }

            .billing-info .bill-from,
            .billing-info .bill-to {
                width: 48%;
            }

            .bill-to {
                margin-top: 5px;
            }

            .billing-info .bill-to {
                text-align: left;
            }

            .billing-info h3 {
                margin: 0;
                font-size: 13px;
                margin-bottom: 5px;
                /* Fix margin */
            }

            .billing-info .bill-from p,
            .billing-info .bill-to p {
                margin: 1px 0;
                /* Reduce margin */
                font-size: 13px;
                /* Adjust font size */
            }

            .billing-info .bill-to p {
                text-align: left;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 10px;
                /* Reduce margin */
            }

            table th,
            table td {
                border: none;
                border-top: 1px solid #e0e0e0;
                border-bottom: 1px solid #e0e0e0;
                padding: 5px;
                /* Reduce padding */
                text-align: left;
                font-size: 13px;
                /* Adjust font size */
            }

            table th {
                background-color: #f0f0f0;
                border-top: none;
            }

            .thank-you {
                text-align: center;
                margin-bottom: 10px;
                /* Reduce margin */
            }

            .thank-you p {
                margin: 0;
                font-size: 13px;
                /* Adjust font size */
            }

            @media print {
                body {
                    background-color: #fff;
                }

                .invoice-card {
                    width: 100%;
                    margin: 0;
                    box-shadow: none;
                    page-break-inside: avoid;
                }

                .invoice-header .right {
                    margin-left: auto;
                    text-align: right;
                }

                .invoice-header,
                .billing-info,
                table,
                .thank-you {
                    page-break-inside: avoid;
                }
            }
        </style>
    </head>

    <body>
        <div class="invoice-card">
            <div class="invoice-header">
                <div class="left">
                    <a href="https://imgur.com/3BoHMWF"><img src="https://i.imgur.com/3BoHMWF.png"
                            title="source: imgur.com" /></a>
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
                    <p>Issued: {{ $transaction->created_at }}
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
                    <h3>{{ ucwords($transaction->user->name) }}</h3>
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
                        <td>IDR {{ number_format($transaction->grand_total, 0, ',') }}
                        </td>
                        @if ($remainingFullPayment)
                    <tr>
                        <th>Remaining Full Payment</td>
                        <td style="font-weight: bold;">IDR {{ number_format($remainingFullPayment, 0, ',') }}</td>
                    </tr>
                    @endif
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <th>Pembelian</th>
                        <td>
                            <div>
                                <table>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                    </tr>
                                    @foreach ($transaction->details as $detail)
                                        <tr>
                                            <td>{{ $detail->id }}</td>
                                            <td>{{ '@' . $detail->username }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="divider"></div>
            <div class="thank-you">
                <p>Terima kasih telah mempercayai kami. <br />
                    WaWe Tour and Travel.</p>
            </div>
        </div>
    </body>

</html>
