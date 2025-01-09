<!DOCTYPE html>
<html>

    <head>
        <title>Package Details Report</title>
        <style>
            table.header {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table.header td {
                padding: 0;
                font-size: 12px;
                line-height: 1.5;
            }

            table.header .logo {
                max-width: 100px;
                /* Sesuaikan ukuran logo */
                height: auto;
            }

            table.header .company-name {
                font-size: 18px;
                font-weight: bold;
                color: #333333;
                /* Warna teks untuk nama perusahaan */
            }

            table.header .company-address {
                font-size: 12px;
                color: #555555;
                /* Warna teks untuk alamat */
                margin-top: 5px;
            }

            .container {
                padding: 20px;
            }

            .info-table,
            .details-table {
                width: 100%;
                margin-bottom: 20px;
                border-collapse: collapse;
            }

            .info-table th,
            .info-table td,
            .details-table th,
            .details-table td {
                padding: 8px;
                border: 1px solid #ddd;
            }

            .info-table th {
                width: 200px;
                background-color: #f5f5f5;
            }

            .details-table th {
                background-color: #f5f5f5;
            }

            .profit {
                color: green;
            }

            .loss {
                color: red;
            }
        </style>
    </head>

    <body>
        <table class="header" cellpadding="0" cellspacing="0">
            <tr>
                <td width="25%" style="vertical-align: top; padding-right: 15px; padding-bottom: 10px">
                    <img src="https://i.imgur.com/3BoHMWF.png" alt="Logo Perusahaan" class="logo">
                </td>
                <td width="75%" style="vertical-align: top;">
                    <div class="company-name">WaWe Tour and Travel</div>
                    <div class="company-address">
                        Kutasari RT05 RW03, Kutasari, Purbalingga, Jawa Tengah 53361<br>
                        Telp: 085786192909
                    </div>
                </td>
            </tr>
        </table>
        <div class="container">
            {{-- <h1>Transaction Details Report</h1> --}}
            <div class="transaction-info">
                <h2>Transaction Information</h2>
                <table class="info-table">
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $transaction['transaction_id'] }}</td>
                    </tr>
                    <tr>
                        <th>Transaction Date</th>
                        <td>{{ $transaction['transaction_date']->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td>{{ $transaction['customer_name'] }}</td>
                    </tr>
                </table>
            </div>

            <div class="package-info">
                <h2>Package Details</h2>
                <table class="info-table">
                    <tr>
                        <th>Package Name</th>
                        <td>{{ $package->title }}</td>
                    </tr>
                    <tr>
                        <th>Package Price</th>
                        <td>{{ number_format($package->price, 2) }}</td>
                    </tr>
                </table>
            </div>

            <div class="financial-details">
                <h2>Financial Details</h2>
                <table class="info-table">
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ $transaction['payment_method'] }}</td>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <td>{{ number_format($transaction['grand_total'], 2) }}</td>
                    </tr>
                    <tr>
                        <th>Cost</th>
                        <td>{{ number_format($transaction['cost'], 2) }}</td>
                    </tr>
                    <tr>
                        <th>Profit/Loss</th>
                        <td class="{{ $transaction['profit_or_loss'] >= 0 ? 'profit' : 'loss' }}">
                            {{ $transaction['profit_or_loss'] >= 0 ? '+' : '-' }}{{ number_format(abs($transaction['profit_or_loss']), 2) }}
                        </td>
                    </tr>
                    @if ($transaction['payment_method'] === 'down_payment')
                        <tr>
                            <th>Remaining Payment</th>
                            <td>{{ number_format($transaction['remainingFullPayment'], 2) }}</td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="participants">
                <h2>Participant Details</h2>
                <table class="details-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction['details'] as $detail)
                            <tr>
                                <td>{{ $detail['username'] }}</td>
                                <td>{{ $detail['phone'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </body>

</html>
