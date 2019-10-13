@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <h1>{{ isset($category) ? $category->name : 'Products' }}</h1>
        <div class="row no-gutters">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 px-2 mb-3">
                    @include('products.card')
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center my-5">
                {{ $products->links() }}
        </div>

    </div>
</div>
@endsection
