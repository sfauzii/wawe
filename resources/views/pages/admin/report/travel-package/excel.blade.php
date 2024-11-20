<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Date and Time</th>
            <th>Package</th>
            <th>Location</th>
            <th>Departure Date</th>
            <th>Sales Count</th>
            <th>Total Sales (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($packages as $package)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $package->created_at->format('d F Y, H:i') }} WIB</td>
                <td>{{ ucwords($package->title) }}</td>
                <td>{{ ucwords($package->location) }}</td>
                <td>{{ \Carbon\Carbon::parse($package->departure_date)->format('d F Y') }}</td>
                <td>{{ $package->sales }}</td>
                <td>Rp {{ number_format($package->total_sales_rupiah, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
