<div class="transaction-search-component">
    <div class="search-container">
        <input type="text" placeholder="Search..." wire:click="toggleModal" readonly>
        <button wire:click="toggleModal">
            <span class="material-icons">search</span>
        </button>
    </div>

    <!-- Search Modal -->
    @if ($showModal)
        <div class="modal-overlay">
            <div class="modal-container">
                <div class="modal-header">
                    <h3>Search</h3>
                    <button class="close-button" wire:click="toggleModal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="search-input">
                        <input type="text"
                            placeholder="Search by package name, order ID, or payment method (min. 3 characters)"
                            wire:model.live="search" autofocus>
                    </div>

                    <!-- Search Results -->
                    <div class="search-results">
                        @if ($searchResults && count($searchResults) > 0)
                            @foreach ($searchResults as $transaction)
                                <div class="transaction-item">
                                    <div class="transaction-content">
                                        <div class="transaction-info">
                                            <h4>Package: {{ ucwords($transaction->travel_package->title ?? 'N/A') }}
                                            </h4>
                                            <p>Order ID: <strong>{{ $transaction->order_id }}</strong></p>
                                            <p>Status:
                                                <span
                                                    class="status-badge {{ strtolower($transaction->transaction_status) }}">
                                                    {{ $transaction->transaction_status }}
                                                </span>
                                            </p>
                                            <p>Issue:
                                                {{ $transaction->created_at ?? 'N/A' }}
                                            </p>
                                            <p>Payment Method:
                                                {{ ucwords(str_replace('_', ' ', $transaction->payment_method)) }}</p>
                                            <p class="total">Total: Rp
                                                {{ number_format($transaction->grand_total, 0, ',', '.') }}</p>
                                        </div>

                                        <div class="transaction-actions">
                                            @if ($transaction->transaction_status === 'SUCCESS')
                                                <button
                                                    onclick="window.open('{{ route('ticket-detail', ['id' => $transaction->id]) }}')"
                                                    class="btn btn-ticket">
                                                    Ticket
                                                </button>
                                                <button
                                                    onclick="window.open('{{ route('invoice', ['id' => $transaction->id]) }}')"
                                                    class="btn btn-invoice">
                                                    Invoice
                                                </button>
                                            @else
                                                <button onclick="window.open('{{ $transaction->payment_url }}')"
                                                    class="btn btn-pay">
                                                    Pay Now
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @elseif(strlen($search) >= 3)
                            <p class="no-results">No data found</p>
                        @else
                            <p class="search-hint">Type at least 3 characters to search</p>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="close-btn" wire:click="toggleModal">Close</button>
                </div>
            </div>
        </div>
    @endif
</div>
