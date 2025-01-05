<!DOCTYPE html>
<html>

    <head>
        <title>Package Details Report</title>
        <style>
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

        <div class="container">
            <h1>Transaction Details Report</h1>
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
