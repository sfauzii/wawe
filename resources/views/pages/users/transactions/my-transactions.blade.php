@extends('layouts.users')

@section('title')
    My Transactions | {{ ucfirst(Auth::user()->name) }}
@endsection

@section('content')
    <h1>
        Transaction</h1>
    <p class="desc-title">Daftar pembelian paket perjalanan anda</p>
    <!-- start recent order -->
    <div class="recent_order">
        <div class="table-responsive">
            <table id="order-table" class="order-table">
                <thead>
                    <tr>
                        <th class="id-number">#</th>
                        <th>Cover</th>
                        <th>Produt Name</th>
                        <th>Price</th>
                        <th class="date-transaction">Date</th>
                        <th class="status">Status</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        @if ($item->user->id === Auth::id() && $item->transaction_status != 'IN_CART')
                            <tr>
                                @php
                                    $uuidParts = explode('-', $item->id);
                                    $shortUuid = $uuidParts[0];
                                @endphp
                                <td class="id-number" style="font-weight: bold;">{{ $shortUuid }}</td>
                                <td>
                                    @if ($item->travel_package->galleries->isNotEmpty())
                                        @php
                                            $firstImage = $item->travel_package->galleries->first()->image; // Get the first image array
                                            $firstImagePath = is_array($firstImage) ? $firstImage[0] : ''; // Get the first image from the array
                                        @endphp
                                        @if ($firstImagePath)
                                            <img src="{{ asset('storage/' . $firstImagePath) }}"
                                                alt="{{ $item->travel_package->title }}" class="cover"
                                                style="width: 100px; height: auto; border-radius: 8px;">
                                        @else
                                            <!-- Fallback content if there is no image -->
                                            <p>No image available.</p>
                                        @endif
                                    @else
                                        <!-- Fallback content if there are no galleries -->
                                        <p>No image available.</p>
                                    @endif
                                </td>
                                <td class="product-name">{{ $item->travel_package->title }}</td>
                                <td class="price">{{ number_format($item->transaction_total, 0, ',') }}</td>
                                <td class="date-transaction">{{ $item->created_at->format('M d, Y H:i:s') }}</td>
                                <td class="status success">{{ $item->transaction_status }}</td>
                                <td>
                                    <div class="action">
                                        @if ($item->transaction_status == 'PENDING')
                                            <button class="paynow-button"
                                                onclick="window.open('{{ $item->payment_url }}', '_blank');">Pay
                                                Now</button>
                                        @elseif ($item->transaction_status == 'SUCCESS')
                                            <button class="detail-button"
                                                onclick="window.open('{{ route('invoice', ['id' => $item->id]) }}', '_blank');">Invoice</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @else
                        @endif
                    @endforeach

                </tbody>
            </table>
        </div>
        <div id="pagination-container" class="pagination"></div>
    </div>
@endsection
