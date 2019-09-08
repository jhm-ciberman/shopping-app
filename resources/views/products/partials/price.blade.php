@if ($product->has_discount)
    <del class="text-muted">{{ ReadableUnit::money($product->price) }}</del>
@endif
<span class="text-success">
    {{ ReadableUnit::money($product->discounted_price) }}
</span>
