<div class="float-left">
    <div class="font-weight-bold mb-2">{{ $address->street }}</div>
    <p class="card-text">
        {{ $address->zip_code }} - {{ $address->city }} - {{ $address->state }}
        <br>
        {{ $address->contact }} - {{ $address->phone }}
    </p>
</div>