@if ($item->has_discount)
    <del class="text-muted">{{ ReadableUnit::money($item->total) }}</del>
@endif
<span class="text-success">
    {{ ReadableUnit::money($item->discounted_total) }}
</span>
