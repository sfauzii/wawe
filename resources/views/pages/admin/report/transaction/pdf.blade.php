<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px; /* Sesuaikan dengan ukuran yang diinginkan */
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 14px;
        }
    </style> 
</head>
<body>
    <div class="header">
        {{-- <img src="{{ asset('backend/assets/img/wawe.png') }}" alt="Logo Perusahaan"> --}}
        <h1>Laporan Transaksi</h1>
    </div>
   
    <p class="mt-4">Periode: <strong>{{ \Carbon\Carbon::parse($startDate)->format('d F Y') }}</strong> sampai
        <strong>{{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</strong></p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Transaksi</th>
                <th>Pengguna</th>
                <th>Paket</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $totalTransaction = 0; @endphp
            @foreach ($transactions as $transaction)
            @php $totalTransaction += $transaction->grand_total; @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaction->created_at->format('d-m-Y H:i:s') }}</td>
                <td>Rp {{ number_format($transaction->grand_total, 0, ',') }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ ucwords($transaction->travel_package->title) }}</td>
                <td>
                    @if ($transaction->transaction_status === 'SUCCESS')
                        <span class="badge rounded-pill text-bg-success">{{ $transaction->transaction_status }}</span>
                    @elseif($transaction->transaction_status === 'IN_CART')
                        <span class="badge rounded-pill text-bg-primary">{{ $transaction->transaction_status }}</span>
                    @elseif($transaction->transaction_status === 'PENDING')
                        <span class="badge rounded-pill text-bg-warning">{{ $transaction->transaction_status }}</span>
                    @elseif($transaction->transaction_status === 'CANCEL')
                        <span class="badge rounded-pill text-bg-secondary">{{ $transaction->transaction_status }}</span>
                    @elseif($transaction->transaction_status === 'FAILED')
                        <span class="badge rounded-pill text-bg-danger">{{ $transaction->transaction_status }}</span>
                    @else
                        <span class="badge rounded-pill text-bg-dark">{{ $transaction->transaction_status }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">
        Total Keseluruhan: Rp{{ number_format($totalTransaction, 0, ',') }}
    </div>
    <div class="footer">
        Report By: {{ Auth::user()->name }}
    </div>
</body>
</html>
</html>