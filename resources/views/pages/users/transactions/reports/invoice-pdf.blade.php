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
            padding: 20px;
            width: 100%;
            max-width: 800px;
            /* Adjust width for better fit in PDF */
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Optional: Add a shadow for a better visual effect */
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .invoice-header .left {
            width: 48%;
        }

        .b-color {
            color: coral
        }

        .invoice-header .left img {
            width: 120px;
            /* Adjust logo size */
        }

        .invoice-header .left p,
        .invoice-header .right p {
            margin: 5px 0;
        }

        .invoice-header .right {
            width: 48%;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* Align right section to the right */
        }

        .divider {
            border-bottom: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        .billing-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .billing-info .bill-from,
        .billing-info .bill-to {
            width: 48%;
        }

        .bill-to {
            margin-top: 10px;
        }

        .billing-info .bill-to {

            text-align: left;
            /* Align 'Bill To' text to the right */
        }

        .billing-info h3 {
            margin: 0;
            font-size: 16px margin-bottom: 5px;
        }

        .billing-info .bill-from p,
        .billing-info .bill-to p {
            margin: 2px 0;
        }

        .billing-info .bill-to p {
            text-align: left;
            /* Ensure 'Bill To' address is right-aligned */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: none;
            border-top: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f0f0f0;
            border-top: none;
        }

        .thank-you {
            text-align: center;
            margin-bottom: 20px;
        }

        .thank-you p {
            margin: 0;
        }

        @media print {
            body {
                background-color: #fff;
                /* Ensure background is white for print */
            }

            .invoice-card {
                width: 100%;
                margin: 0;
                box-shadow: none;
                /* Remove shadow for print */
                page-break-inside: avoid;
                /* Avoid breaking the card across pages */
            }

            .invoice-header .right {
                margin-left: auto;
                /* Ensure the right section aligns to the right */
                text-align: right;
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
                <h3>#{{ $shortUuid }}</h3>
                <p>Product Name: <strong>{{ $transaction->travel_package->title }}</strong></p>
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
                <h3>{{ $transaction->user->name }}</h3>
                <p>Address Line 1</p>
                <p>City, State, ZIP</p>
                <p>Country</p>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaction->travel_package->title }}</td>
                    <td>IDR {{ number_format($transaction->travel_package->price, 0, ',') }}</td>
                    <td>{{ $transactionDetails->count() }}</td>
                    <td>IDR {{ number_format($transaction->travel_package->price * $transactionDetails->count()) }}
                    </td>
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
                                    <th>Nama</th>
                                    <th>Nationality</th>
                                    <th>Visa</th>
                                    <th>DOE Passport</th>
                                </tr>
                                @foreach ($transaction->details as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>{{ $detail->username }}</td>
                                        <td>{{ $detail->nationality }}</td>
                                        <td>{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                                        <td>{{ $detail->doe_passport }}</td>
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
