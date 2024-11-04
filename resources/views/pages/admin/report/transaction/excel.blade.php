<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Status</th>
            <th>Total</th>
            <!-- Add other columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->order_id }}</td>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->transaction_status }}</td>
                <td>{{ $transaction->grand_total }}</td>
                <!-- Add other data as needed -->
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Summary Section -->
<table>
    <tr>
        <td>Total Revenue</td>
        <td>{{ $totalTransaction }}</td>
    </tr>
    <tr>
        <td>Number of Transactions</td>
        <td>{{ $transactionCount }}</td>
    </tr>
    <tr>
        <td>Average Per Transaction</td>
        <td>{{ $averagePerTransaction }}</td>
    </tr>
    <tr>
        <td>Highest Transaction</td>
        <td>{{ $highestTransaction }}</td>
    </tr>
    <tr>
        <td>Lowest Transaction</td>
        <td>{{ $lowestTransaction }}</td>
    </tr>
    <tr>
        <td>Total Packages Sold</td>
        <td>{{ $totalPackagesSold }}</td>
    </tr>
</table>
