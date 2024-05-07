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
            width: 100px;
            /* Sesuaikan dengan ukuran yang diinginkan */
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
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
        <h1>Laporan Package</h1>
    </div>

    <p class="mt-4">Periode: <strong>{{ \Carbon\Carbon::parse($startDate)->format('d F Y') }}</strong> sampai
        <strong>{{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</strong>
    </p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date and Time</th>
                <th>Pakcage</th>
                <th>Location</th>
                <th>Departure Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $package->created_at->format('d F Y, H:i') }} WIB</td>
                    <td>{{ $package->title }}</td>
                    <td>{{ $package->location }}</td>
                    <td>{{ \Carbon\Carbon::parse($package->departure_date)->format('d F Y') }}</td>
                    {{-- <td><img src="{{ $package->travel_package->galleries->count() ? Storage::url($package->travel_package->galleries->first()->image) : '' }}"
                            alt="Package Image" style="width: 100px; height: auto;"></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Report By: {{ Auth::user()->name }}
    </div>
</body>

</html>
