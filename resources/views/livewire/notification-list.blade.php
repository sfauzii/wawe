<div>
    <!-- Mark All as Read Button -->
    <button wire:click="markAllAsRead" class="btn btn-primary mb-3">Mark All as Read</button>

    <!-- Notifications List -->
    <ul class="list-group">
        @foreach ($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    @if (isset($notification->data['name']))
                        <!-- Display Testimonial Details -->
                        <strong>{{ $notification->data['name'] }}</strong> memberikan testimoni: <br>
                        "{{ $notification->data['message'] }}" <br>
                        Pada: {{ $notification->data['created_at'] }}
                    @elseif (isset($notification->data['transaction_id']))
                        <!-- Display Transaction Details -->
                        <strong>{{ $notification->data['user_name'] }}</strong> made a transaction: <br>
                        Amount: {{ $notification->data['amount'] }} <br>
                        Status:
                        @if ($notification->data['status'] === 'SUCCESS')
                            <span class="badge bg-success">{{ $notification->data['status'] }}</span>
                        @elseif($notification->data['status'] === 'IN_CART')
                            <span class="badge bg-primary">{{ $notification->data['status'] }}</span>
                        @elseif($notification->data['status'] === 'PENDING')
                            <span class="badge bg-warning">{{ $notification->data['status'] }}</span>
                        @elseif($notification->data['status'] === 'CANCEL')
                            <span class="badge bg-secondary">{{ $notification->data['status'] }}</span>
                        @elseif($notification->data['status'] === 'FAILED')
                            <span class="badge bg-danger">{{ $notification->data['status'] }}</span>
                        @else
                            <span class="badge bg-dark">{{ $notification->data['status'] }}</span>
                        @endif
                    @else
                        {!! $notification->data['message'] !!}
                    @endif
                    <p>{{ $notification->created_at->diffForHumans() }}</p>
                </div>
                @if (!$notification->read_at)
                    <button wire:click="markAsRead('{{ $notification->id }}')" class="btn btn-link p-0">Mark as Done</button>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- Pagination Links -->
    <div class="mt-3">
        {{ $notifications->links() }}
    </div>
</div>
