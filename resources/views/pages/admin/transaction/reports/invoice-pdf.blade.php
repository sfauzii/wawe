<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice {{ ucwords($item->user->name) }}</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                padding: 0;
            }

            .header {
                display: flex;
                align-items: center;
                border-bottom: 1px solid #ddd;
                padding-bottom: 20px;
                margin-bottom: 20px;
            }

            .logo {
                flex: 1;
            }

            .logo img {
                width: 100px;
                /* Adjust logo size */
                height: auto;
            }

            .company-info {
                flex: 2;
                text-align: center;
            }

            .company-info h1 {
                margin: 0;
                font-size: 24px;
            }

            .company-info p {
                margin: 5px 0;
                font-size: 14px;
            }

            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                background-color: #ffffff;
                border: 1px solid #ddd;
            }

            .invoice-table th,
            .invoice-table td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            .invoice-table th {
                background-color: #f2f2f2;
            }

            .nested-table {
                width: 100%;
                border-collapse: collapse;
                margin: 10px 0;
            }

            .nested-table th,
            .nested-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            .nested-table th {
                background-color: #f2f2f2;
            }

            .thank-you {
                text-align: center;
                margin-top: 30px;
                margin-bottom: 20px;
            }

            .thank-you p {
                margin: 0;
            }

            .footer-by {
                text-align: right;
                margin-top: 5px;
            }

            .footer-by h3 {
                margin-bottom: 5px
            }
        </style>
    </head>

    <body>
        <div class="header">
            <!-- Logo Section -->
            <div class="logo">
                <img src="https://i.imgur.com/3BoHMWF.png" title="source: imgur.com" />
                <!-- Replace with actual logo path -->
            </div>

            <!-- Company Information Section -->
            <div class="company-info">
                <h1>Company Name</h1>
                <p>1234 Street Address</p>
                <p>City, State, 56789</p>
                <p>Email: info@company.com</p>
                <p>Phone: (123) 456-7890</p>
            </div>
        </div>

        <h5>Issued: {{ $item->created_at }}</h5>

        <table class="invoice-table">
            <thead>
                
            </thead>
            <tbody>
                <tr>
                    <th>ID Transaction</th>
                    <td>{{ $item->id }}</td>
                </tr>
                <tr>
                    <th>Product Name</td>
                    <td>{{ $item->travel_package->title }}</td>
                </tr>
                <tr>
                    <th>Pembeli</td>
                    <td>{{ $item->user->name }}</td>
                </tr>
                <tr>
                    <th>Price</td>
                    <td>IDR {{ number_format($item->travel_package->price, 0, ',') }}</td>
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
                    <th>Status Transaksi</td>
                    <td>{{ $item->transaction_status }}</td>
                </tr>
                <tr>
                    <th>Total</td>
                    <td>IDR {{ number_format($item->transaction_total, 0, ',') }}</td>
                </tr>
                <tr>
                    <th>Pembelian</th>
                    <td>
                        <!-- Nested Table -->
                        <table class="nested-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->details as $detail)
                                    <tr>
                                        <td>{{ $detail->id }}</td>
                                        <td>{{ $detail->username }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="thank-you">
            <p>Terima kasih telah mempercayai kami. <br />
                WaWe Tour and Travel.</p>
        </div>

        <div class="footer-by">
            <h4 style="margin: 0;">Salam hangat</h4>
            <p>{{ Auth::user()->name }}</p>

        </div>



    </body>

</html>
