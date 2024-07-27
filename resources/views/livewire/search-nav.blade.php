<div class="search-container">
    <input type="search" wire:model.live="searchTerm" placeholder="Search...">

    @if ($searchTerm && $transactions->isEmpty())
        <div class="alert alert-warning">
            No results found for "{{ $searchTerm }}"
        </div>
    @elseif($searchTerm)
        <div class="row">
            @foreach ($transactions as $transaction)
                <div class="col-md-4 mb-3">
                    <a href="{{ route('invoice', ['id' => $transaction->id]) }}" target="_blank" class="custom-card-link">
                        <div class="custom-card">
                            <div class="card-body">
                                @php
                                    $uuidParts = explode('-', $transaction->id);
                                    $shortUuid = $uuidParts[0];
                                @endphp
                                <p class="card-text">ID: <span style="font-weight: bold;"> {{ $shortUuid }}</span>
                                </p>
                                <p class="card-text">User: <span
                                        style="font-weight: bold;">{{ $transaction->user->name }}</span></p>
                                <p class="card-text">Travel Package: <span
                                        style="font-weight: bold;">{{ $transaction->travel_package->name }}</span></p>
                                <p class="card-text">Status: <span
                                        style="font-weight: bold;">{{ $transaction->transaction_status }}</span></p>
                                <p class="card-text">Total: <span
                                        style="font-weight: bold;">{{ $transaction->transaction_total }}</span></p><br>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <button>
        <span class="material-icons">search</span>
    </button>


    <style>
        .alert-warning {
            color: #333 !important;
        }


        .custom-card-link {
            text-decoration: none;
            /* Remove underline from link */
        }

        .custom-card {
            height: 160px;
            width: 300px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Add a stronger shadow on hover */
            transform: translateY(-5px);
            /* Slightly move the card up on hover */
        }

        .custom-card .card-body {
            padding: 5px;
        }

        .custom-card {
            margin: 1rem
        }
    </style>
</div>
