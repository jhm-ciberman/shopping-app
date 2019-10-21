<div class="card admin-card mb-3">
    <div class="card-body">
        {{ $slot }}
    </div>
    @if ($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
