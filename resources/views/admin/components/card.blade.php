<div class="card admin-card">
    <div class="card-body">
        {{ $slot }}
    </div>
    @if ($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>
