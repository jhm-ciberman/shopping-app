@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="row">
        <div class="col-auto mb-2 px-md-0 col-12 col-md-6">
            <img class="img-fluid rounded w-100" width="430" height="300" src="{{ $product->mediumImage() }}" alt="{{ $product->name }}">
        </div>

        <div class="px-md-4 col-12 col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <div class="text-price-tag mb-3">
                        <span class="text-success">
                            {{ ReadableUnit::money($product->discounted_price) }}
                        </span>
                        @if ($product->has_discount)
                            <del class="text-muted">{{ ReadableUnit::money($product->price) }}</del>
                        @endif
                    </div>



                    <h1 class="card-title mb-3" href="{{ route('products.show', $product) }}">{{ $product->name }}</h1>

                    <p class="card-text">{{ $product->description }}</p>
                    <div class="text-muted">SKU: {{ $product->sku }}</div>
                </div>

                <div class="card-footer">
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-auto mr-3" for="quantity">Quantity</label>
                            <input class="form-control col-5" type="number" name="quantity" id="quantity" value="1" min="0" max="100">
                        </div>
                        <div class="row">
                            <input type="submit" class="col m-2 btn btn-lg btn-primary" value="Buy now">
                            <input type="submit" formaction="{{ route('cart.add', ['product' => $product, 'noshow' => true]) }}" class="col m-2 btn btn-lg btn-outline-primary" value="Add to cart">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="my-4">
        <h2>You may like...</h2>
        <div class="row">
            @foreach($relatedProducts as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 px-2 mb-3">
                    @include('products.card')
                </div>
            @endforeach
        </div>
    </div>



</div>
@endsection
