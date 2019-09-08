<div class="list-group-item flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
        <div>
            <h4 class="mb-2">{{ __('Order') }} #{{ $order->id }} </h4>
            <small>{{ $order->created_at->format('d/m/y \a \l\a\s H:m') }}</small>  
            <p class="mb-1">{{ Str::limit($order->title, 100) }}</p>
            <small class="text-muted">{{ $order->address->street }} - {{ $order->address->city }}</small>
        </div>
        
        <a href="{{ route('users.orders.show', $order) }}" class="button button-rounded button-reveal button-small button-green tright">
            <i class="icon-angle-right"></i>
            <span>{{ __('Show Order') }}</span>
        </a>
    </div>
    
</div>